<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class custom extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_barang");
        $this->load->model("M_transaksi");
        $this->load->model("M_customer");
        $this->load->model('M_pelanggan');
        $this->load->model('M_realtime');
        $this->load->model('M_custom');
    }

    public function index()
    {
        //akses cek
        if ($this->session->userdata('level') != 0 || $this->session->userdata('level') == NULL) {
            redirect("auth/accesDenied");
        };

        $data['data_custom'] = $this->M_custom->ambildata();
        $data['data_lokasi'] = $this->M_custom->ambildatalokasi();
        $this->template->load('admin/template', 'admin/V_custom', $data);
    }

    public function uploadsumbervideo()
    {

        $sumbervideo = $this->input->post("sumbervideo");
        $insert = $this->M_custom->masukansumbervideo($sumbervideo);
        redirect("custom");
    }

    public function delrax()
    {
        $idrax = $this->input->post("idrax");
        $this->db->where('id_rax', $idrax);
        $this->db->delete('tb_rax');

        $this->M_custom->hapusJumlahRax();

        redirect("custom");
    }

    public function tambahRaxbox()
    {
        $raxbox = $this->input->post("raxbox");
        $insert = $this->M_custom->tambahRaxbox($raxbox);
        redirect("custom");
    }

    public function lokasiRax()
    {
        $id_rax = $this->input->post("idrax");
        $xx = $this->input->post("xx");

        // Periksa apakah id_rax sudah ada di database 
        $existing_rax = $this->db->get_where('tb_rax', ['id_rax' => $id_rax])->row();


        // Merubah warna HEX ke rgb
        $hex = $this->input->post("warna_" . $xx);
        $hex2 = str_replace("#", "", $hex);

        $r = hexdec(substr($hex2, 0, 2));
        $g = hexdec(substr($hex2, 2, 2));
        $b = hexdec(substr($hex2, 4, 2));
        $rgb = "($b, $g, $r)";

        if ($existing_rax) {
            // Jika sudah ada, lakukan update
            $data = [
                'lokasi1' => $this->input->post("lokasi1_" . $xx),
                'lokasi2' => $this->input->post("lokasi2_" . $xx),
                'lokasi3' => $this->input->post("lokasi3_" . $xx),
                'lokasi4' => $this->input->post("lokasi4_" . $xx),
                'warna' => $rgb,
                'warnaHex' => $hex
            ];
            $this->db->where('id_rax', $id_rax);
            $this->db->update('tb_rax', $data);
            redirect("custom");
        } else {
            // Jika belum ada, lakukan insert
            $data = [
                'lokasi1' => $this->input->post("lokasi1_" . $xx),
                'lokasi2' => $this->input->post("lokasi2_" . $xx),
                'lokasi3' => $this->input->post("lokasi3_" . $xx),
                'lokasi4' => $this->input->post("lokasi4_" . $xx),
                'warna' => $rgb,
                'warnaHex' => $hex,
                'id_rax' => $id_rax
            ];
            $this->db->insert('tb_rax', $data);
            redirect("custom");
        }
    }

    public function customToko()
    {
        $config['upload_path'] = './aset';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 10048;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')) {
            // Upload gagal, tampilkan pesan kesalahan
            $error = $this->upload->display_errors();
            echo $error;
        } else {
            // Upload berhasil, ambil nama file
            $foto = $this->upload->data('file_name');
            $ext = $this->upload->data('file_ext');

            // Lanjutkan dengan pengolahan data lainnya
        }
        $filePathLama = "./aset/$foto";
        $filePath = "./aset/bg$ext";
        rename($filePathLama, $filePath);

        $namatoko = $this->input->post('namatoko');
        $alamattoko = $this->input->post('alamattoko');
        $notoko = $this->input->post('notoko');
        $foto;

        $insert = $this->M_custom->masukanDataToko($namatoko, $foto, $alamattoko, $notoko);

        require './vendor/autoload.php';

        $serviceAccount = './vendor/ptoko2.json';
        $storage = new Google\Cloud\Storage\StorageClient([
            'projectId' => '3a70f',
            'keyFilePath' => $serviceAccount
        ]);

        // Ganti dengan path menuju file gambar Anda

        // Nama file di Firebase Storage
        $fileName = basename($filePath);

        // Bucket Firebase Storage
        $bucketName = 'ptoko-3a70f.appspot.com';

        // Path di Firebase Storage
        $storagePath = $fileName;

        // Mengunggah file ke Firebase Storage
        $bucket = $storage->bucket($bucketName);
        $uploadedFile = $bucket->upload(
            fopen($filePath, 'r'),
            [
                'name' => $storagePath
            ]
        );
        redirect("barang");
    }

    public function polylines()
    {
        $dc = $this->M_custom->ambildata();
        foreach ($dc as $dcc) {
            $polylines = $dcc->polylines;
        }

        if ($polylines == 1) {
            $this->M_custom->gantiPolylines(0);
        } else {
            $this->M_custom->gantiPolylines(1);
        }
        redirect("custom");
    }

    public function lokasikasir()
    {
        $lokasi1 = $this->input->post("lokasi1_4");
        $lokasi2 = $this->input->post("lokasi2_4");
        $lokasi3 = $this->input->post("lokasi3_4");
        $lokasi4 = $this->input->post("lokasi4_4");

        $kasir = $lokasi1 . $lokasi2;
        echo $kasir;
    }
}
