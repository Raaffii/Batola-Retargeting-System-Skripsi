<?php
class M_pelanggan extends CI_Model
{

    public function input_yolo($data_yolo, $id_pelanggan)
    {
        foreach ($data_yolo as $dy) {
            $lokasi1 = $dy->location_1;
            $lokasi2 = $dy->location_2;
            $lokasi3 = $dy->location_3;
        }

        $this->db->set('lokasi1', $lokasi1);
        $this->db->set('lokasi2', $lokasi2);
        $this->db->set('lokasi3', $lokasi3);
        $this->db->where('id_pelanggan', $id_pelanggan);
        return   $this->db->update('tb_pelanggan');;
    }

    public function ambilpelanggan($id)
    {
        $this->db->where('id_pelanggan', $id);
        $query = $this->db->get('tb_pelanggan');
        return $query->result();
    }



    public function atur_yolo($data_transaksi, $id_pelanggan)
    {

        foreach ($data_transaksi as $dt) {
            $this->db->where('id_pelanggan', $id_pelanggan);
            if ($dt->location == 1) {
                $this->db->set('lokasi1', 'lokasi1 - 100', FALSE);
            } else if ($dt->location == 2) {
                $this->db->set('lokasi1', 'lokasi1 - 100', FALSE);
            } else if ($dt->location == 3) {
                $this->db->set('lokasi1', 'lokasi1 - 100', FALSE);
            }
            $this->db->update('tb_pelanggan');
        }
    }
}
