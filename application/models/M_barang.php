<?php
class M_barang extends CI_Model
{
    public function caribeli($cari)
    {
        $this->db->like('nama_barang', $cari); // Gantilah 'nama_event' dengan nama kolom yang ingin Anda cari
        $query = $this->db->get('tb_barang');
        return $query->result();
    }

    public function ambildata()
    {

        $query = $this->db->get('tb_barang');
        return $query->result();
    }
}
