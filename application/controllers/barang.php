<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class barang extends CI_Controller
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

    public function receivedata()
    { // Baca isi data.json
        $json_data = $this->input->post();
        // Lakukan sesuatu dengan data yang diterima

        // Misalnya, tampilkan data
        echo 'Data yang diterimas: ';
        print_r($json_data);
    }

    public function index()
    {
        //akses cek
        if ($this->session->userdata('level') != 0 || $this->session->userdata('level') == NULL) {
            redirect("auth/accesDenied");
        };

        $today = date('Y-m-d');
        $dayOfWeek = date('N', strtotime($today));

        $diff = $dayOfWeek - 1;

        $lastMonday = date('Y-m-d', strtotime("-$diff days", strtotime($today)));

        $weeklyData = array();

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', strtotime("$lastMonday +$i days"));

            $datas = $this->M_barang->ambildatatanggal($date);
            $total = 0;
            $jumlahpelanggan = 0;
            $flag = 0;
            foreach ($datas as $dt) {
                $total += $dt->harga;
                if ($flag != $dt->id_pelanggan) {
                    $flag = $dt->id_pelanggan;
                    $jumlahpelanggan++;
                }
            }
            if ($i == 0) {
                $data['senin'] = $total;
                $data['jumlahpelanggansenin'] = $jumlahpelanggan;
            } elseif ($i == 1) {
                $data['selasa'] = $total;
                $data['jumlahpelangganselasa'] = $jumlahpelanggan;
            } elseif ($i == 2) {
                $data['rabu'] = $total;
                $data['jumlahpelangganrabu'] = $jumlahpelanggan;
            } elseif ($i == 3) {
                $data['kamis'] = $total;
                $data['jumlahpelanggankamis'] = $jumlahpelanggan;
            } elseif ($i == 4) {
                $data['jumat'] = $total;
                $data['jumlahpelangganjumat'] = $jumlahpelanggan;
            } elseif ($i == 5) {
                $data['sabtu'] = $total;
                $data['jumlahpelanggansabtu'] = $jumlahpelanggan;
            } elseif ($i == 6) {
                $data['minggu'] = $total;
                $data['jumlahpelangganminggu'] = $jumlahpelanggan;
            }
        }

        $data1 = $this->M_barang->ambildatatanggal(date('Y-m-d'));
        $data2 = $this->M_barang->ambildatatanggal(date('Y-m-d', strtotime('-1 day')));

        $total = 0;
        $flag = 0;
        $pgtoday = 0;
        foreach ($data1 as $dt) {
            $total += $dt->harga;
            if ($flag != $dt->id_pelanggan) {
                $flag = $dt->id_pelanggan;
                $pgtoday++;
            }
        }

        $totalkemarin = 0;
        $flag = 0;
        $pgyesterday = 0;
        foreach ($data2 as $dt) {
            $totalkemarin += $dt->harga;
            if ($flag != $dt->id_pelanggan) {
                $flag = $dt->id_pelanggan;
                $pgyesterday++;
            }
        }

        $data['data_custom'] = $this->M_custom->ambildata();

        $data['total'] = $total;
        $data['margin'] = $total - $totalkemarin;
        $data['pgtoday'] = $pgtoday;
        $data['pgyesterday'] = $pgyesterday;
        $data['jumlahpelangganPekan'] =  $data['jumlahpelanggansenin'] +  $data['jumlahpelangganselasa'] + $data['jumlahpelangganrabu'] + $data['jumlahpelanggankamis'] + $data['jumlahpelangganjumat'] + $data['jumlahpelanggansabtu'] +  $data['jumlahpelangganminggu'];
        $data['totalpekan'] = $data['senin'] + $data['selasa'] + $data['rabu'] + $data['kamis'] + $data['jumat'] + $data['sabtu'] + $data['minggu'];

        $this->template->load('admin/template', 'admin/V_dashboard', $data);
    }

    public function pengolahanDataBarang()
    {
        //akses cek

        if ($this->session->userdata('level') != 0 || $this->session->userdata('level') == NULL) {
            redirect("auth/accesDenied");
        };
        $data['data_rax'] = $this->M_custom->ambildatalokasi();
        $data['data_tipe'] = $this->M_barang->ambildatatipe();
        $data['data_barang'] = $this->M_barang->ambildata();
        $this->template->load('admin/template', 'admin/V_penggolahan_barang', $data);
    }

    public function pengolahanDataRaxBarang()
    {
        //akses cek
        if ($this->session->userdata('level') != 0 || $this->session->userdata('level') == NULL) {
            redirect("auth/accesDenied");
        };
        $data['data_rax'] = $this->M_custom->ambildatalokasi();
        $data['data_barang'] = $this->M_barang->ambildata();
        $data['data_tipe'] = $this->M_barang->ambildatatipe();
        //mencari jumlah lokasi
        $this->db->select('COUNT(DISTINCT(location)) AS total_location');
        $query = $this->db->get('tb_barang');
        $row = $query->row();
        $data['lokasi'] = $row->total_location;

        $this->template->load('admin/template', 'admin/V_penggolahan_raxbarang', $data);
    }

    public function rekomendasi()
    {
        //akses cek
        if ($this->session->userdata('level') != 0 || $this->session->userdata('level') == NULL) {
            redirect("auth/accesDenied");
        };
        $data['data_barang'] = $this->M_barang->ambildata();
        $this->template->load('admin/template', 'admin/V_rekomendasi', $data);
    }
    public function masukan_barang()
    {

        $config['upload_path'] = './aset/upload';
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
            // Lanjutkan dengan pengolahan data lainnya
        }



        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'harga' => $this->input->post('harga'),
            'deskripsi' => $this->input->post('deskripsi'),
            'location' => $this->input->post('lokasi'),
            'tipe' => $this->input->post('jenis'),
            'foto' => $foto
        ];

        $insert = $this->M_barang->masukan_barang($data);
        require './vendor/autoload.php';

        $serviceAccount = './vendor/ptoko2.json';
        $storage = new Google\Cloud\Storage\StorageClient([
            'projectId' => '3a70f',
            'keyFilePath' => $serviceAccount
        ]);

        $filePath = "./aset/upload/$foto"; // Ganti dengan path menuju file gambar Anda

        // Nama file di Firebase Storage
        $fileName = basename($filePath);

        // Bucket Firebase Storage
        $bucketName = 'ptoko-3a70f.appspot.com';

        // Path di Firebase Storage
        $storagePath = 'images/' . $fileName;

        // Mengunggah file ke Firebase Storage
        $bucket = $storage->bucket($bucketName);
        $uploadedFile = $bucket->upload(
            fopen($filePath, 'r'),
            [
                'name' => $storagePath
            ]
        );
        echo json_encode($insert);
    }

    public function hapusBarang($id)
    {
        $this->M_barang->hapusBarang($id);
        redirect('barang/pengolahanDataBarang');
    }

    public function moveRax()
    {
        $idbarang = $this->input->post("idbarang");
        $rax = $this->input->post("rax");

        $this->M_barang->moveRax($idbarang, $rax);

        redirect("barang/pengolahanDataRaxBarang");
    }

    public function editBarang($id)
    {
        $config['upload_path'] = './aset/upload';
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
            // Lanjutkan dengan pengolahan data lainnya
        }


        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'harga' => $this->input->post('harga'),
            'deskripsi' => $this->input->post('deskripsi'),
            'location' => $this->input->post('lokasi'),
            'tipe' => $this->input->post('jenis'),
            'foto' => $foto
        ];

        $this->M_barang->editBarang($data, $id);

        require './vendor/autoload.php';

        $serviceAccount = './vendor/ptoko2.json';
        $storage = new Google\Cloud\Storage\StorageClient([
            'projectId' => '3a70f',
            'keyFilePath' => $serviceAccount
        ]);

        $filePath = "./aset/upload/$foto"; // Ganti dengan path menuju file gambar Anda

        // Nama file di Firebase Storage
        $fileName = basename($filePath);

        // Bucket Firebase Storage
        $bucketName = 'ptoko-3a70f.appspot.com';

        // Path di Firebase Storage
        $storagePath = 'images/' . $fileName;

        // Mengunggah file ke Firebase Storage
        $bucket = $storage->bucket($bucketName);
        $uploadedFile = $bucket->upload(
            fopen($filePath, 'r'),
            [
                'name' => $storagePath
            ]
        );

        redirect('barang/pengolahanDataBarang');
    }

    public function tambah_barang()
    {
        require './vendor/autoload.php';

        $serviceAccount = './vendor/ptoko2.json'; // Ganti dengan path menuju file serviceAccount.json Anda
        $storage = new Google\Cloud\Storage\StorageClient([
            'projectId' => '3a70f',
            'keyFilePath' => $serviceAccount
        ]);

        $filePath = './aset/batolanobg.png'; // Ganti dengan path menuju file gambar Anda

        // Nama file di Firebase Storage
        $fileName = basename($filePath);

        // Bucket Firebase Storage
        $bucketName = 'ptoko-3a70f.appspot.com';

        // Path di Firebase Storage
        $storagePath = 'images/' . $fileName;

        // Mengunggah file ke Firebase Storage
        $bucket = $storage->bucket($bucketName);
        $uploadedFile = $bucket->upload(
            fopen($filePath, 'r'),
            [
                'name' => $storagePath
            ]
        );

        echo 'File berhasil diunggah ke Firebase Storage dengan nama: ' . $fileName;
    }

    public function cariRekomendasi()
    {
        $data = $this->M_barang->ambilrekomendasi();
        $results = array();
        $no = 0;
        if ($data) {
            foreach ($data as $dt) {

                $results['data'][] = array(
                    '<tr>
                <td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;" >' . $dt->nama_pelanggan . '</p>
                </td>', '<td class="align-middle" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">' . $dt->nama_barang_c1 . '</p>
                <p class="text-xs text-secondary mb-0" style="margin-left: 1rem;">' . $dt->C1 . '</p>
                </td>', '<td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">' . $dt->nama_barang_c2 . '</p>
                <p class="text-xs text-secondary mb-0" style="margin-left: 1rem;">' . $dt->C2 . '</p>
                </td>', '<td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">' . $dt->nama_barang_c3 . '</p>
                <p class="text-xs text-secondary mb-0" style="margin-left: 1rem;">' . $dt->C3 . '</p>
                </td>', '<td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">' . $dt->nama_barang_c4 . '</p>
                <p class="text-xs text-secondary mb-0" style="margin-left: 1rem;">' . $dt->C4 . '</p>
                </td>', '<td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">' . $dt->nama_barang_c5 . '</p>
                <p class="text-xs text-secondary mb-0" style="margin-left: 1rem;">' . $dt->C5 . '</p>
                </td>', '<td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">' . $dt->nama_barang_c6 . '</p>
                <p class="text-xs text-secondary mb-0" style="margin-left: 1rem;">' . $dt->C6 . '</p>
                </td>', '<td><div id="loading_' . $dt->id_saw . '" style="display: none;">
                <img src="' . base_url('aset/loading/loading.gif') . '" alt="Loading..." width="50px" height="50px">
                </div><div id="sukses_' . $dt->id_saw . '" style="display: none;">
                <img src="' . base_url('aset/loading/sent.gif') . '" alt="Loading..." width="50px" height="50px">
                </div></td>', '<td class="align-middle text-center" style="text-align: center;"><form role="form" method="post" id="kirimRekomendasi" action="">
                <input type="hidden" name="id_pelanggan" id="" value="' . $dt->id_saw . '" >
                <button type="submit" class="btn btn-primary">Submit</button>
                </form></td></tr>'
                );
            }
        } else {
            $results['data'] = array();
        }
        echo json_encode($results);
    }

    public function cariBarang()
    {
        //crtlz sampai sini
        $data = $this->M_barang->ambildata();
        $results = array();
        $data_rax = $this->M_custom->ambildatalokasi();

        $no = 0;
        if ($data) {
            foreach ($data as $dt) {

                $results['data'][] = array(
                    '<tr>
                <td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;" >' . $dt->nama_barang . '</p>
                </td>', '<td class="align-middle" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">' . $dt->deskripsi . '</p>
                </td>', '<td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">' . $dt->harga . '</p>
                </td>', '<td class="align-middle text-center" style="text-align: center;">
                <p class="text-xs font-weight-bold mb-0" style="margin-left: 1rem;">Rax : ' . $dt->location . '</p>
                <p class="text-xs text-secondary mb-0" style="margin-left: 1rem;">' . $dt->nama_tipe . '</p>
                </td>', ' <td class="text-center">
                <div style="display:flex">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#editbarang_' . $dt->id_barang . '"><lord-icon
                    src="https://cdn.lordicon.com/wuvorxbv.json"
                    trigger="hover"
                    stroke="bold"
                    colors="primary:#121331,secondary:#c71f16"
                    style="width:2rem;height:2rem">
                    </lord-icon>
                    </button>
                     <div class="modal fade" id="editbarang_' . $dt->id_barang . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form role="form" action="' . base_url('barang/editBarang/' . $dt->id_barang . '') . '" id="" enctype="multipart/form-data" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit barang ' . $dt->nama_barang . '</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="' . $dt->nama_barang . '" autofocus>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="text" class="form-control" name="deskripsi" id="nama_suplier" value="' . $dt->deskripsi . '">
                            </div>
                            
                            <div class="input-group input-group-outline mb-3">
                                <input type="number" class="form-control" name="harga" id="harga" value="' . $dt->harga . '">
                            </div>

                            <div style="display: flex; gap:1em;">
                                <div class="input-group input-group-outline mb-3">
                                    <select class="form-select" aria-label=".form-select-sm example" name="lokasi" id="pilihrax2" onchange="updateJenis2()">
                                        <option selected>.Pilih Rax</option>
                                      
                                            <option value="1" style="text-align:center">
                                                <h4> Rax 1</h4>
                                            </option>
                                            <option value="2" style="text-align:center">
                                                <h4> Rax 2</h4>
                                            </option>
                                            <option value="3" style="text-align:center">
                                                <h4> Rax 3</h4>
                                            </option>
                                            
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <select id="jenis2" class="form-select" name="jenis">
                                        <option value="">Pilih jenis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" class="form-control" name="foto" id="foto">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Understood</button>
                        </div>
                </form>
            </div>
        </div>
        </div>
                    
                    <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#hapusbarang' . $dt->id_barang . '"> <lord-icon
                    src="https://cdn.lordicon.com/drxwpfop.json"
                    trigger="hover"
                    stroke="bold"
                    colors="primary:#121331,secondary:#c71f16"
                    style="width:2rem;height:2rem">
                    </lord-icon> </button>

                    <!-- Modal -->
                    <div class="modal fade" id="hapusbarang' . $dt->id_barang . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                            <form role="form" method="post" action="' . base_url('barang/hapusBarang/') . $dt->id_barang . ' ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus ' . $dt->nama_barang . '</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="margin-right: auto;">
                                        <p>Konfirmasi Hapus barang ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary">Ya</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    
            
            </td></tr>'
                );
            }
        } else {
            $results['data'] = array();
        }
        echo json_encode($results);
    }



    public function cariBarangsatu()
    {
        $cari = $_GET['pencarian'];
        $barang = $this->M_barang->caribeli($cari);

        $output2 = ' 
        <li style="list-style-type: none;">
            <h3>tidak ditemukan</h3>
        </li>';


        foreach ($barang as $lm) {
            $output = '<table class="table align-items-center mb-0"  style="background-color:  #f8f9fa>
            <thead>
            </thead>
            <tbody>
                <tr style="background-color: gainsboro;">
                   
                    <td class="align-middle text-center">
                        <h6 class="mb-0 text-sm">' . $lm->nama_barang . '</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6 class="mb-0 text-sm">' . $lm->harga . '</h6>
                        
                    </td>
                    <td>
                        <form id="createForm">
                        <input type="hidden" value="' . $lm->id_barang . ' " name="id_barang">
                            <button class=" border-0  bg-gray-100 border-radius-lg" type="submit">Inputss</button>
                        </form>
                    </td>
                    
        
                </tr>
            </tbody>
        </table>';
        }
        if ($barang == NULL) {
            echo $output2;
        } else {
            echo $output;
        }
    }

    public function movetipe()
    {
        $rax = $this->input->post("rax");
        $idtipe = $this->input->post("idtipe");


        $this->M_barang->updateTipe($idtipe, $rax);
        $this->M_barang->moveBarangtipe($idtipe, $rax);

        redirect('barang/pengolahanDataRaxBarang');
    }

    public function tambahTipe()
    {
        $rax = $this->input->post("rax");
        $namatipe = $this->input->post("namatipe");

        $this->M_barang->tambahTipe($rax, $namatipe);

        redirect('barang/pengolahanDataRaxBarang');
    }

    public function deleteTipe()
    {
        $idtipe = $this->input->post("idtipe");
        $jenis = $this->input->post("jenis");
        $lokasi = $this->input->post("lokasi");



        $this->M_barang->updateTipeBarang($idtipe, $jenis, $lokasi);
        $this->M_barang->deleteTipe($idtipe);

        redirect("barang/pengolahanDataRaxBarang");
    }
}
