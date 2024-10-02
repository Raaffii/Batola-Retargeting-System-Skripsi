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

    public function ambildatatipe()
    {
        $query = $this->db->get('tb_tipe');
        return $query->result();
    }

    public function ambildataid($id)
    {
        $this->db->join('tb_tipe', 'tb_barang.tipe=tb_tipe.id_tipe');
        $this->db->where('id_barang', $id);
        $query = $this->db->get('tb_barang');
        return $query->result();
    }

    public function moveRax($idbarang, $rax)
    {

        $this->db->set('location', $rax);
        $this->db->where('id_barang', $idbarang);
        $this->db->update('tb_barang');
    }

    public function ambildatatanggal($tanggal)
    {
        $this->db->where('DATE(tanggal)', $tanggal);
        $this->db->join('tb_barang', 'tb_barang.id_barang=tb_transaksi.id_barang');
        $query = $this->db->get('tb_transaksi');
        return $query->result();
    }

    public function ambilrekomendasi()
    {
        $this->db->select('tb_saw.*, tb_pelanggan.nama_pelanggan, tb_barang1.nama_barang AS nama_barang_c1, tb_barang2.nama_barang AS nama_barang_c2, tb_barang3.nama_barang AS nama_barang_c3, tb_barang4.nama_barang AS nama_barang_c4, tb_barang5.nama_barang AS nama_barang_c5,tb_barang6.nama_barang AS nama_barang_c6');
        $this->db->from('tb_saw');
        $this->db->join('tb_pelanggan', 'tb_saw.id_user=tb_pelanggan.id_pelanggan');
        $this->db->join('tb_barang AS tb_barang1', 'tb_saw.C1 = tb_barang1.id_barang');
        $this->db->join('tb_barang AS tb_barang2', 'tb_saw.C2 = tb_barang2.id_barang');
        $this->db->join('tb_barang AS tb_barang3', 'tb_saw.C3 = tb_barang3.id_barang');
        $this->db->join('tb_barang AS tb_barang4', 'tb_saw.C4 = tb_barang4.id_barang');
        $this->db->join('tb_barang AS tb_barang5', 'tb_saw.C5 = tb_barang5.id_barang');
        $this->db->join('tb_barang AS tb_barang6', 'tb_saw.C6 = tb_barang6.id_barang');

        $query = $this->db->get();
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

    public function ambiljumlahrax()
    {
        $datajumlahrax = $this->db->get('tb_custom')->result();

        foreach ($datajumlahrax as $dr) {
            $jumlah = $dr->jumlahRaxBox;
        }
        return $jumlah;
    }

    public function updateTipe($id_tipe, $rax)
    {
        $this->db->set('lokasi', $rax);
        $this->db->where('id_tipe', $id_tipe);
        $this->db->update('tb_tipe');
    }

    public function moveBarangtipe($id_tipe, $rax)
    {
        $this->db->set('location', $rax);
        $this->db->where('tipe', $id_tipe);
        $this->db->update('tb_barang');
    }

    public function tambahTipe($rax, $namatipe)
    {
        $data = [
            'nama_tipe' => $namatipe,
            'lokasi' => $rax,

        ];
        $query = $this->db->insert('tb_tipe', $data);
        return $query;
    }

    public function updateTipeBarang($idtipe, $jenis, $lokasi)
    {
        $this->db->set('location', $lokasi);
        $this->db->set('tipe', $jenis);
        $this->db->where('tipe', $idtipe);
        $this->db->update('tb_barang');
    }

    public function deleteTipe($idtipe)
    {
        $this->db->where('id_tipe', $idtipe);
        $this->db->delete('tb_tipe');
    }

    public function cektipe($alternatif)
    {
        $this->db->select('tipe');
        $this->db->from('tb_barang tu');
        $this->db->where('id_barang', $alternatif);

        // Mendapatkan hasil query
        $query = $this->db->get();

        // Memastikan bahwa hasil tidak kosong
        if ($query->num_rows() > 0) {
            // Mengambil baris pertama hasil sebagai objek
            $row = $query->row();
            return $row->tipe;
        } else {
            // Mengembalikan nilai null jika tidak ditemukan
            return null;
        }
    }
}
