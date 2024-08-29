<?php
class M_realtime extends CI_Model
{
    public function ambildata($id_yolo)
    {
        $this->db->where('track_id', $id_yolo); // Gantilah 'nama_event' dengan nama kolom yang ingin Anda cari
        $query = $this->db->get('tb_realtime');
        return $query->result();
    }
}
