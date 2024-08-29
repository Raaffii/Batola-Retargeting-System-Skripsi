<?php
class M_transaksi extends CI_Model
{
    public function input_transaksi($id_barang)
    {
        $data = array(
            'id_barang' => $id_barang

        );
        return $this->db->insert('tb_transaksi', $data);
    }
    public function input_pelanggan($id)
    {
        $this->db->set('id_pelanggan', $id);

        return   $this->db->update('tb_transaksi');;
    }

    public function input_yolo($id)
    {
        $this->db->set('id_yolo', $id);

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
        $this->db->join('tb_realtime', 'tb_transaksi.id_yolo=tb_realtime.id');
        $this->db->where('status', 0);
        $query = $this->db->get('tb_transaksi');
        return $query->result();
    }
}
