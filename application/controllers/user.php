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
        $this->load->model('M_saw');
    }

    public function index()
    {
        $this->template->load('user/template', 'user/V_user');
        #redirect('http://127.0.0.1:5000/webcam', 'refresh');
    }
    public function pembelian()
    {

        $this->template->load('user/template', 'user/V_pembelian');
        #redirect('http://127.0.0.1:5000/webcam', 'refresh');
    }

    public function rekomendasi()
    {
        $this->template->load('user/template', 'user/V_rekomendasi');
    }

    public function masukan_yolo_ongo()
    {
        $id = $this->input->post('id_yolo');
        $insert = $this->M_transaksi->input_yolo($id);
        echo json_encode($insert);
    }

    public function masukan_customer_ongo()
    {
        $id = $this->input->post('id_pelanggan');
        $insert = $this->M_transaksi->input_pelanggan($id);
        echo json_encode($insert);
    }


    public function konfirmasibeli()
    {
        $totaljumlahrax = $this->M_barang->ambiljumlahrax();
        $data_transaksi = $this->M_transaksi->ambildata();

        $v = 1;
        if (!empty($data_transaksi)) {

            while ($v <= $totaljumlahrax) {
                $C2totalbeli[$v] = 0;
                $v++;
            }
            // Iterasi melalui setiap objek transaksi
            foreach ($data_transaksi as $transaksi) {
                $id_pelanggan = $transaksi->id_pelanggan;
                $id_yolo = $transaksi->id_yolo;
                $z = 1;
                while ($z <= $totaljumlahrax) {
                    if ($transaksi->location == $z) {
                        $C2totalbeli[$z]++;
                    }
                    $z++;
                }
            }
        } else {

            echo "Tidak ada data transaksi.";
        }

        //echo $C2totalbeli[1] . " " . $C2totalbeli[2] . " " . $C2totalbeli[3] . "<br>";

        $datawaktu = $this->M_realtime->ambildata($id_yolo);

        $jumlahrax = 1;

        if (!empty($datawaktu)) {
            foreach ($datawaktu as $dw) {
                while ($jumlahrax <= $totaljumlahrax) {
                    $property_name = "location_" . $jumlahrax;
                    $C1[$jumlahrax] = $dw->$property_name;
                    $jumlahrax++;
                }
            }
        } else {
            while ($jumlahrax <= $totaljumlahrax) {
                $property_name = "location_" . $jumlahrax;
                $C1[$jumlahrax] = 0;
                $jumlahrax++;
            }
        }


        $b = 1;
        while ($b <= $totaljumlahrax) {
            if ($C1[$b] != 0) {
                $waktupertotal1 = $C2totalbeli[$b] / $C1[$b];
                if ($waktupertotal1 >= 0.2) {
                    $C2[$b] = 2;
                } elseif ($waktupertotal1 >= 0.1) {
                    $C2[$b] = 3;
                } elseif ($waktupertotal1 >= 0.04) {
                    $C2[$b] = 4;
                } else {
                    $C2[$b] = 5;
                }
            } else {
                $C2[$b] = 0;
            }
            $b++;
        }


        $sejarah_user = $this->M_transaksi->ambildatasejarahbeli($id_pelanggan);

        $data_tipe = $this->M_barang->ambildatatipe();
        foreach ($data_tipe as $dt) {
            $C4[$dt->id_tipe] = 0;
            $C3[$dt->lokasi] = 0;
        }

        $x = 1;
        foreach ($sejarah_user as $sj) {
            $C3[$sj->location] = 1;
            $x++;
        }


        $data_tipe = $this->M_barang->ambildatatipe();

        foreach ($data_tipe as $dt) {
            $C4[$dt->id_tipe] = 0;
        }

        foreach ($sejarah_user as $sj) {
            $C4[$sj->tipe] = 1;
        }
        function tambahData($data, $alternatif, $C1, $C2, $C3, $C4)
        {
            $new_data = array(
                'alternatif' => $alternatif,
                'C1' => $C1,
                'C2' => $C2,
                'C3' => $C3,
                'C4' => $C4
            );
            $data[] = $new_data;
            return $data;
        }
        //ctrlz sampai siniyaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        $data_barang = $this->M_barang->ambildata();
        $data = array();
        foreach ($data_barang as $db) {

            foreach ($sejarah_user as $sj) {
                if ($db->id_barang == $sj->id_barang) {
                    $xyz = 1;
                    break;
                } else {
                    $xyz = 0;
                }
            }

            echo $db->nama_barang . " a. " . $C1[$db->location] . " b. " . $C2[$db->location] . " c. " . $C3[$db->location] . " d. " . $C4[$db->id_tipe] . " e. " . $xyz . "<br>";
            $data = tambahData($data, $db->id_barang, $C1[$db->location], $C2[$db->location], $C3[$db->location], $C4[$db->id_tipe]);
        }


        $max_C1 = max(array_column($data, 'C1'));
        $max_C2 = max(array_column($data, 'C2'));
        $max_C3 = max(array_column($data, 'C3'));
        $max_C4 = max(array_column($data, 'C4'));

        $bobot = array('C1' => 0.4, 'C2' => 0.3, 'C3' => 0.2, 'C4' => 0.1);
        $normalisasi = array('C1' => $max_C1, 'C2' => $max_C2, 'C3' => $max_C3, 'C4' => $max_C4);

        $datan = array();
        foreach ($data as $alternatif) {
            $hasilNormalisasiAlternatif = array();
            $hasilNormalisasiAlternatif['alternatif'] = $alternatif['alternatif'];

            foreach ($normalisasi as $nr => $kriteria) {

                if ($kriteria == 0) {
                    $hasilNormalisasiAlternatif[$nr] = $nn;
                } else {
                    $nn = $alternatif[$nr] / $kriteria;
                    $hasilNormalisasiAlternatif[$nr] = $nn;
                }
            }
            $datan[$alternatif['alternatif']] = $hasilNormalisasiAlternatif;
        }


        $saw = array();
        foreach ($datan as $alternatif) {
            $nilai_saw = 0;
            foreach ($bobot as $kriteria => $weight) {
                $nilai_saw += $alternatif[$kriteria] * $weight;
            }
            $saw[$alternatif['alternatif']] = $nilai_saw;
        }

        // Buat array sementara dari kunci-kunci asli
        $temp_keys = array_keys($saw);

        // Acak array sementara tersebut
        shuffle($temp_keys);

        // Buat array baru dari array yang diacak tadi
        $shuffled_saw = array();
        foreach ($temp_keys as $key) {
            $shuffled_saw[$key] = $saw[$key];
        }

        // Urutkan array baru dengan arsort
        arsort($shuffled_saw);

        $c = 0;
        $last_tipe = '';
        foreach ($shuffled_saw as $alternatif => $nilai) {
            $c++;
            $tipe = $this->M_barang->cektipe($alternatif);
            // Jika sudah memasukkan 4 barang, pastikan 2 barang selanjutnya memiliki tipe berbeda
            if ($c > 4) {
                // Jika tipe barang sama dengan tipe barang terakhir yang dimasukkan, cari alternatif
                if ($tipe == $last_tipe) {
                    echo "ga jadi";
                    $c = $c - 1;
                } else {
                    echo $alternatif;
                    echo "-------------";
                    $this->M_saw->masukan_rekomendasi($id_pelanggan, $alternatif, $c);
                }
            } else {
                echo $alternatif;
                echo "-------------";
                $this->M_saw->masukan_rekomendasi($id_pelanggan, $alternatif, $c);
            }

            $last_tipe = $tipe;

            if ($c >= 6) {
                break;
            }
        }

        //$rank = 1;
        //foreach ($saw as $alternatif => $nilai) {
        //    echo "\n";
        //    echo "$rank. Alternatif $alternatif dengan nilai SAW $nilai <br>";
        //    $rank++;
        //}


        $cek = $this->M_transaksi->ubahStatus($id_pelanggan);
        //$rank = 1;
        //foreach ($saw as $alternatif => $nilai) {
        //    echo "\n";
        //    echo "$rank. Alternatif $alternatif dengan nilai SAW $nilai <br>";
        //    $rank++;
        //}


        echo json_encode($cek);
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
        $dataYoloPelanggan = $this->M_transaksi->inputYoloPelanggan();

        if (empty($dataYoloPelanggan)) {
            $idyolo = 0;
            $idpelanggan = 0;
        } else {
            foreach ($dataYoloPelanggan as $dy) {
                $idyolo = $dy->id_yolo;
                $idpelanggan = $dy->id_pelanggan;
            }
        }

        $insert = $this->M_transaksi->input_transaksi($barang, $idyolo, $idpelanggan);
        echo json_encode($insert);
        //redirect('user/pembelian');
    }

    public function hapusKeranjangsatu()
    {
        $barang = $this->input->post("id_barang");
        $insert = $this->M_transaksi->hapusSatu_transaksi($barang);
        echo json_encode($insert);
        //redirect('user/pembelian');
    }
    public function hapusBarang()
    {
        $barang = $this->input->post("id_barang");
        $insert = $this->M_transaksi->hapusTransaksi($barang);
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
