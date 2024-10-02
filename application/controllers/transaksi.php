<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");
class transaksi extends CI_Controller
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
        $this->template->load('user/template', 'user/V_pembelian');
    }

    public function ambilDataTransaksi()
    {
        $data = $this->M_transaksi->ambildata();
        $results = array();
        $no = 0;
        if ($data) {
            foreach ($data as $tk) {
                if (!isset($grouped_data[$tk->id_barang])) {
                    $grouped_data[$tk->id_barang] = [
                        'no' => ++$no,
                        'nama_barang' => $tk->nama_barang,
                        'id_transaksi' => $tk->id_transaksi,
                        'harga' => $tk->harga,
                        'nama_pelanggan' => $tk->nama_pelanggan,
                        'id_yolo' => $tk->id_yolo,
                        'id_pelanggan' => $tk->id_pelanggan,
                        'id_yolo' => $tk->id_yolo,
                        'jumlah' => 1,
                        'thapus' => "<button>hapus</button>",
                        'id_barang' => $tk->id_barang

                    ];
                } else {
                    $grouped_data[$tk->id_barang]['harga'] += $tk->harga;
                    $grouped_data[$tk->id_barang]['jumlah']++;
                }
            }

            foreach ($grouped_data as $gr) {

                $results['data'][] = array(
                    $gr['no'],
                    $gr['nama_barang'],
                    '<form id="plusbarang" style="display: inline-block;">
                <input type="hidden" value="' . $gr['id_barang'] . ' " name="id_barang">
                    <button class=" border-0  bg-gray-100 border-radius-lg" type="submit">+</button>
                </form>' . $gr['jumlah'] . '<form id="minusbarang" style="display: inline-block;">
                <input type="hidden" value="' . $gr['id_barang'] . ' " name="id_barang">
                    <button class=" border-0  bg-gray-100 border-radius-lg" type="submit">-</button>
                </form>',
                    "Rp." . $gr['harga'],
                    '<form id="hapusbarang" style="display: inline-block;">
                <input type="hidden" value="' . $gr['id_barang'] . ' " name="id_barang">
                    <button class=" border-0  bg-gray-100 border-radius-lg" type="submit">Hapus</button>
                </form>'
                );
            }
        } else {
            $results['data'] = array();
        }
        echo json_encode($results);
    }

    public function ambilTotalHarga()
    {
        $data = $this->M_transaksi->ambildata();
        $results = array();
        $totalharga = 0;
        if ($data) {
            foreach ($data as $dt) {
                $totalharga = $dt->harga + $totalharga;
            }

            $results['data'][] = array(
                "<h1> Rp. " . number_format($totalharga, 0, ',', '.') . "</h1>"
            );
        } else {
            $results['data'] = array();
        }
        echo json_encode($results);
    }

    public function ambilPelangganDanYolo()
    {
        $data = $this->M_transaksi->ambildata();
        $results = array();
        $no = 0;
        if ($data) {
            foreach ($data as $tk) {

                if ($tk->id_pelanggan != 0) {
                    $grouped_data[0] = [
                        "yoloDanpelanggan" => '<li style="list-style: none; color:aquamarine; ">' . $tk->nama_pelanggan . '</li>'
                    ];
                } else {
                    $nd = "nodata";
                    $grouped_data[0] = [
                        "yoloDanpelanggan" => '<li style="list-style: none; color:red; ">' . $nd . '</li>'
                    ];
                }
                if ($tk->id_yolo != 0) {
                    $grouped_data[1] = [
                        "yoloDanpelanggan" => '<li style="list-style: none; color:aquamarine; ">' . $tk->id_yolo . ' </i></li>'
                    ];
                } else {
                    $nd = "nodata";
                    $grouped_data[1] = [
                        "yoloDanpelanggan" => '<li style="list-style: none; color:red; ">' . $nd . '</li>'
                    ];
                }
            }

            foreach ($grouped_data as $gr) {

                $results['data'][] = array(
                    $gr['yoloDanpelanggan'],

                );
            }
        } else {
            $results['data'] = array();
        }
        echo json_encode($results);
    }
}
