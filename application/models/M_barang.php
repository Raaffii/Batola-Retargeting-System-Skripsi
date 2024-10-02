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
        $this->db->join('tb_tipe', 'tb_barang.tipe=tb_tipe.id_tipe');
        $query = $this->db->get('tb_barang');
        return $query->result();
    }

    public function hapusBarang($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('tb_barang');
    }

    public function masukan_barang($data)
    {
        $query = $this->db->insert('tb_barang', $data);
        return $query;
    }
    public function editBarang($data, $id)
    {
        $this->db->where('id_barang', $id);
        $this->db->update('tb_barang', $data);
    }
}
