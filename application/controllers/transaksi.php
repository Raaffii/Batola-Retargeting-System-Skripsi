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
        $data = $this->M_transaksi->ambildata();
        $no = 0;
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
                ];
            } else {
                $grouped_data[$tk->id_barang]['harga'] += $tk->harga;
                $grouped_data[$tk->id_barang]['jumlah']++;
            }
        }
        $data['grouped_data'] = $grouped_data;
        $this->template->load('user/template', 'user/V_pembelian', $data);
    }
}
