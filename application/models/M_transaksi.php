<?php
class M_transaksi extends CI_Model
{
    public function input_transaksi($id_barang, $idyolo, $idpelanggan)
    {
        $data = array(
            'id_barang' => $id_barang,
            'id_yolo' => $idyolo,
            'id_pelanggan' => $idpelanggan
        );
        $query = $this->db->insert('tb_transaksi', $data);
        return $query;
    }
    public function hapusSatu_transaksi($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->limit(1);
        $query = $this->db->delete('tb_transaksi');
        return $query;
    }

    public function ubahStatus($id_pelanggan)
    {
        $this->db->set('status', 1);
        $this->db->where('status', 0);
        $this->db->where('id_pelanggan', $id_pelanggan);
        return   $this->db->update('tb_transaksi');;
    }
    public function hapusTransaksi($id_barang)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->where('status', 0);
        $query = $this->db->delete('tb_transaksi');
        return $query;
    }

    public function inputYoloPelanggan()
    {

        $this->db->where('status', 0);
        $this->db->limit(1); // Mengambil satu baris saja
        $query = $this->db->get('tb_transaksi');

        return $query->result();
    }

    public function input_pelanggan($id)
    {
        $this->db->set('id_pelanggan', $id);
        $this->db->where('status', 0);
        return   $this->db->update('tb_transaksi');;
    }


    public function input_yolo($id)
    {
        $this->db->set('id_yolo', $id);
        $this->db->where('status', 0);
        return   $this->db->update('tb_transaksi');;
    }

    public function tandai_terbeli()
    {
        $this->db->set('status', 1);
        return   $this->db->update('tb_transaksi');;
    }

    public function ambildata()
    {
        $this->db->join('tb_pelanggan', 'tb_transaksi.id_pelanggan=tb_pelanggan.id_pelanggan');
        $this->db->join('tb_barang', 'tb_transaksi.id_barang = tb_barang.id_barang');
        $this->db->where('status', 0);
        $query = $this->db->get('tb_transaksi');
        return $query->result();
    }

    public function ambildatasejarahbeli($id_pelanggan)
    {
        $this->db->join('tb_barang', 'tb_transaksi.id_barang = tb_barang.id_barang');
        $this->db->where('status', 1);
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('tb_transaksi');
        return $query->result();
    }
}
