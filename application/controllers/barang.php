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
    }

    public function index()
    {
        $data['data_barang'] = $this->M_barang->ambildata();
        $this->template->load('admin/template', 'admin/V_penggolahan_barang', $data);
    }
    public function masukan_barang()
    {
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'harga' => $this->input->post('harga'),
            'suplier' => $this->input->post('suplier'),
            'stock' => $this->input->post('stok'),
        ];

        $insert = $this->M_barang->masukan_barang($data);
        echo json_encode($insert);
    }

    public function hapusBarang($id)
    {
        $this->M_barang->hapusBarang($id);
        redirect('barang');
    }

    public function editBarang($id)
    {
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'suplier' => $this->input->post('suplier'),
            'stock' => $this->input->post('stok'),
            'harga' => $this->input->post('harga')
        ];

        $this->M_barang->editBarang($data, $id);
        redirect('barang');
    }

    public function tambah_barang()
    {
        echo "tambah barang";
    }

    public function cariBarang()
    {
        $cari = $_GET['pencarian'];
        $barang = $this->M_barang->caribeli($cari);

        $output2 = ' 
        <li style="list-style-type: none;">
            <h3>tidak ditemukan</h3>
        </li>';

        if ($barang == NULL) {
            echo $output2;
        }
        foreach ($barang as $db) {
            $output = ' 
                    <tr>
                    <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $db->nama_barang  . '</h6>
                            <p class="text-xs text-secondary mb-0">' . $db->id_barang . '</p>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">' . $db->suplier . '</p>
                    <p class="text-xs text-secondary mb-0">Organization</p>
                </td>
                <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">' . $db->harga . '</p>
                </td>
                <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">' . $db->stock . '</p>
                </td>
                <td class="text-center">
                    <div>
                        <button class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#editbarang' . $db->id_barang . '">Edit</button>
                        <div class="modal fade" id="editbarang' . $db->id_barang . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form role="form" method="post" action="' . base_url('barang/editBarang/') . $db->id_barang . '">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Barang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group input-group-outline mb-3">
                                                <label>Nama Barang</label>
                                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="' . $db->nama_barang . '" autofocus>
                                            </div>
                                            <div class="input-group input-group-outline mb-3">
                                                <label>Suplier</label>
                                                <input type="text" class="form-control" name="suplier" id="nama_suplier" value="' . $db->suplier . '">
                                            </div>

                                            <div style="display: flex; gap:1em;">
                                                <div class="input-group input-group-outline mb-3">
                                                    <label>Harga</label>
                                                    <input type="number" class="form-control" name="harga" id="harga" value="' . $db->harga . '">
                                                </div>

                                                <div class="input-group input-group-outline mb-3">
                                                    <label>Stok</label>
                                                    <input type="number" class="form-control" name="stok" id="stok" value="' . $db->stock . '">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#hapusbarang<?= $db->id_barang ?>">Hapus</button>
                        <div class="modal fade" id="hapusbarang<?= $db->id_barang ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form role="form" method="post" action="' . base_url('barang/hapusBarang/') . $db->id_barang . ' ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus</h1>
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
                    </div>
                </td> </tr>';
            echo $output;
        }
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
            <tr style="border: 1px solid #e91e63;">
                <th class="align-middle text-center">Barang</th>
                <th class="align-middle text-center">Hargsa</th>
                <th class="align-middle text-center">Input</th>
            </tr>
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
                            <button class=" border-0  bg-gray-100 border-radius-lg" type="submit">Input</button>
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
}
