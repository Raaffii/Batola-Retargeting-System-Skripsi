<?php
class M_saw extends CI_Model
{
    public function inputsaw($data)
    {
        $this->db->insert('tb_saw', $data);
    }
    public function masukan_rekomendasi($id_pelanggan, $id_barang, $c)
    {
        if ($c == 1) {
            $this->db->set('C1', $id_barang);
        } elseif ($c == 2) {
            $this->db->set('C2', $id_barang);
        } elseif ($c == 3) {
            $this->db->set('C3', $id_barang);
        } elseif ($c == 4) {
            $this->db->set('C4', $id_barang);
        } elseif ($c == 5) {
            $this->db->set('C5', $id_barang);
        } elseif ($c == 6) {
            $this->db->set('C6', $id_barang);
        }

        $this->db->where('id_user', $id_pelanggan);
        return   $this->db->update('tb_saw');
    }

    public function cariBarangRekomendasi($id_barang, $id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->group_start();
        $this->db->or_where('C1', $id_barang);
        $this->db->or_where('C2', $id_barang);
        $this->db->or_where('C3', $id_barang);
        $this->db->or_where('C4', $id_barang);
        $this->db->or_where('C5', $id_barang);
        $this->db->or_where('C6', $id_barang);
        $this->db->group_end();
        $query = $this->db->get('tb_saw');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ambildata($id_saw)
    {
        $this->db->select('tb_saw.*, tb_barang1.nama_barang AS nama_barang_c1, tb_barang2.nama_barang AS nama_barang_c2, tb_barang3.nama_barang AS nama_barang_c3, tb_barang4.nama_barang AS nama_barang_c4, tb_barang5.nama_barang AS nama_barang_c5,tb_barang6.nama_barang AS nama_barang_c6');
        $this->db->from('tb_saw');
        $this->db->join('tb_pelanggan', 'tb_saw.id_user=tb_pelanggan.id_pelanggan');
        $this->db->join('tb_barang AS tb_barang1', 'tb_saw.C1 = tb_barang1.id_barang');
        $this->db->join('tb_barang AS tb_barang2', 'tb_saw.C2 = tb_barang2.id_barang');
        $this->db->join('tb_barang AS tb_barang3', 'tb_saw.C3 = tb_barang3.id_barang');
        $this->db->join('tb_barang AS tb_barang4', 'tb_saw.C4 = tb_barang4.id_barang');
        $this->db->join('tb_barang AS tb_barang5', 'tb_saw.C5 = tb_barang5.id_barang');
        $this->db->join('tb_barang AS tb_barang6', 'tb_saw.C6 = tb_barang6.id_barang');
        if ($id_saw !== NULL) {
            $this->db->where('tb_saw.id_saw', $id_saw);
        }
        $query = $this->db->get();
        return $query->result();
    }
}
