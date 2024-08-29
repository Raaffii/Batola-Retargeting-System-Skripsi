<?php
class M_customer extends CI_Model
{
    public function cari_customer($cc)
    {
        $this->db->where('no_telp', $cc);
        $query = $this->db->get('tb_pelanggan');
        return $query->result();
    }
}
