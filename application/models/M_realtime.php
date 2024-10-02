<?php
class M_realtime extends CI_Model
{
    public function ambildata($id_yolo)
    {
        $this->db->where('track_show', $id_yolo);
        $query = $this->db->get('tb_realtime');
        return $query->result();
    }
}
