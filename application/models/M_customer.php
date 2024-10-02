<?php
class M_customer extends CI_Model
{
    public function ambildata($telp)
    {
        $this->db->where('no_telp', $telp);
        $query = $this->db->get('tb_pelanggan');
        return $query->result();
    }
    public function cari_customer($cc)
    {
        $this->db->where('no_telp', $cc);
        $query = $this->db->get('tb_pelanggan');
        return $query->result();
    }
    public function inputCustomer($data)
    {
        $this->db->insert('tb_pelanggan', $data);
    }
}
