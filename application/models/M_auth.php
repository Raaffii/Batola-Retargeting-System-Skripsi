<?php
class M_auth extends CI_Model
{
    public function login($emailorusername = null)
    {

        $this->db->from('tb_user tu');
        $this->db->where('username', $emailorusername);
        $this->db->select('tu.*');
        return $this->db->get_where()->row_array();
    }
}
