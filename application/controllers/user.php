<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_barang");
        $this->load->model("M_transaksi");
        $this->load->model("M_customer");
        $this->load->model('M_pelanggan');
        $this->load->model('M_realtime');
    }

    public function index()
    {
        $this->template->load('user/template', 'user/V_user');
        #redirect('http://127.0.0.1:5000/webcam', 'refresh');
    }
    public function pembelian()
    {
        $data['transaksi'] = $this->M_transaksi->ambildata();
        $this->template->load('user/template', 'user/V_pembelian', $data);
        #redirect('http://127.0.0.1:5000/webcam', 'refresh');
    }

    public function rekomendasi()
    {
        $this->template->load('user/template', 'user/V_rekomendasi');
    }

    public function masukan_yolo_ongo()
    {
        $id = $this->input->post('yolo');
        $this->M_transaksi->input_yolo($id);
        redirect('user/pembelian');
    }

    public function masukan_customer_ongo()
    {
        $id = $this->input->post('id_pelanggan');
        $insert = $this->M_transaksi->input_pelanggan($id);
        echo json_encode($insert);
    }

    public function konfirmasibeli()
    {

        $data_transaksi = $this->M_transaksi->ambildata();
        $id_yolo = $this->input->post('id_yolo');
        $id_pelanggan = $this->input->post('id_pelanggan');
        $data_yolo = $this->M_realtime->ambildata($id_yolo);


        $this->M_pelanggan->input_yolo($data_yolo, $id_pelanggan); //masukan seluruh yolo
        $this->M_pelanggan->atur_yolo($data_transaksi, $id_pelanggan); //atur yolo berdasarkan pembelian

        $this->M_transaksi->tandai_terbeli();

        redirect('user/pembelian');
    }


    public function cari_customer()
    {
        $cari = $_GET['pencarian'];
        $orang = $this->M_customer->cari_customer($cari);

        foreach ($orang as $or) {
            $output = ' 
            
            <form action="' . base_url("user/masukan_customer_ongo/") . '" method="post" >
        
                <h6 class="text-center mb-0" id="customer_show">' . $or->nama_pelanggan . '</h6>
                <input type="hidden" value="' . $or->id_pelanggan . ' " name="id_pelanggan">
                <button><i class="fa-solid fa-floppy-disk"></i></button>
          
            </form>';
        }

        $output2 = '  <form action="">
        <div>
            <h6 class="text-center mb-0" id="customer_show">tidak terdasftar</h6>
            <button><i class="fa-solid fa-plus"></i></button>
        </div>
        </form>';
        if ($orang != NULL) {
            echo $output;
        } else {
            echo $output2;
        }
    }

    public function cari_barang()
    {
        $cari = $_GET['pencarian'];
        $barang = $this->M_barang->caribeli($cari);



        foreach ($barang as $lm) {
            $output = ' 
            <li style="list-style-type: none;">

            <table style="text-align:center;">
                <thead>
                    <tr>
                        <th>ID |</th>
                        <th>Nama Barang |</th>
                        <th>Harga |</th>
                        <th>Input |</th>
                    </tr>
                </thead>
            <tbody>
                 <tr style="background-color: bg-gradient-primary; color:white;" class=" bg-gradient-primary mt-4 w-100">
                    <td>"' . $lm->id_barang . ' "</td>
                    <br>
                    <td>"' . $lm->nama_barang . ' "</td>
                    <td>"' . $lm->harga . ' "</td>
                    <td>   <form action="' . base_url("user/masukan_keranjang/") . '" method="post" class="card" style="min-width:3rem" >
                    <input type="hidden" value="' . $lm->id_barang . ' " name="id_barang">
                    <button class=" border-0  bg-gray-100 border-radius-lg">Input</button>
                    </form>
                            </td>

                </tr>
            </tbody>
            </table>
              
            </li>';
        }
        $output2 = ' 
            <li style="list-style-type: none;">
                <h3>tidak ditemukan</h3>
            </li>';

        if ($barang != NULL) {
            echo $output;
        } else {
            echo $output2;
        }
    }

    public function masukan_keranjang()
    {
        $barang = $this->input->post("id_barang");
        $insert = $this->M_transaksi->input_transaksi($barang);
        echo json_encode($insert);
        //redirect('user/pembelian');
    }

    public function cari()
    {
        $cari = $this->input->post("pencarian");
        $data['transaksi'] = $this->M_transaksi->ambildata();
        $data['list_cari'] = $this->M_barang->caribeli($cari);
        $this->template->load('user/template', 'user/V_pembelian', $data);
    }

    public function confusebuy()
    {
        $this->template->load('user/template', 'user/V_confusebuy');
    }

    public function bindex()
    {
        // Panggil fungsi untuk melakukan pemanggilan URL Flask di latar belakang
        $this->callFlaskInBackground();

        // Tampilkan pesan ke pengguna
        echo "Permintaan sedang diproses. Halaman akan segera dimuat.";
    }

    private function callFlaskInBackground()
    {
        // Jalankan pemanggilan URL Flask di latar belakang
        // Anda dapat menggunakan CURL atau fungsi file_get_contents() seperti sebelumnya
        // Di sini, saya akan menggunakan file_get_contents() karena lebih sederhana
        ignore_user_abort(true); // Tetap menjalankan proses di latar belakang saat klien menutup koneksi
        set_time_limit(0); // Set batas waktu eksekusi ke tak terbatas

        $flask_url = 'http://localhost:5000/video';

        // Panggil URL Flask
        $response = file_get_contents($flask_url);

        // Anda dapat melakukan apapun dengan respons di sini
        // Misalnya, menyimpannya ke database atau melakukan operasi lainnya
        // Untuk contoh sederhana, saya hanya akan mencetak respons
        echo $response;
    }
}
