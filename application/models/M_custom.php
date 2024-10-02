<?php
class M_custom extends CI_Model
{

    public function ambildata()
    {
        $query = $this->db->get('tb_custom');
        return $query->result();
    }
    public function ambildatalokasi()
    {
        $this->db->where('id_rax !=', 1);
        $query = $this->db->get('tb_rax');
        return $query->result();
    }
    public function masukansumbervideo($sv)
    {
        $this->db->set('sumber_camera', $sv);
        $this->db->where('id_custom', 1);
        return   $this->db->update('tb_custom');
    }
    public function tambahRaxbox($rb)
    {


        $this->db->set('jumlahRaxBox', 'jumlahRaxBox + 1', FALSE);
        $this->db->where('id_custom', 1);
        $this->db->update('tb_custom');

        $this->db->where('id_custom', 1);
        $query = $this->db->get('tb_custom');
        $row = $query->row();
        $jumlahRaxBox = $row->jumlahRaxBox;

        $data = [
            'lokasi1' => "0, 0",
            'lokasi2' => "0, 0",
            'lokasi3' => "0, 0",
            'lokasi4' => "0, 0",
            'warnaHex' => "#000000",
            'warna' => "(0, 0, 0)",



        ];
        return $this->db->insert('tb_rax', $data);
    }
    public function hapusJumlahRax()
    {
        $this->db->set('jumlahRaxBox', 'jumlahRaxBox - 1', FALSE);
        $this->db->where('id_custom', 1);
        return   $this->db->update('tb_custom');;
    }

    public function gantiPolylines($x)
    {
        $this->db->set('polylines', $x);
        $this->db->where('id_custom', 1);
        return   $this->db->update('tb_custom');;
    }

    public function masukanDataToko($namatoko, $foto, $alamattoko, $notoko)
    {
        $this->db->set('nama_toko', $namatoko);
        $this->db->set('logo_toko', $foto);
        $this->db->set('alamat_toko', $alamattoko);
        $this->db->set('no_toko', $notoko);
        $this->db->where('id_custom', 1);
        return   $this->db->update('tb_custom');
    }
}
