<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pesanan extends CI_Model
{
    function tampil()
    {

        return $this->db->get('tb_pemesan')->result_array();
    }

    function ambil_noID($id_pemesan)
    {
        return $this->db->get_where('tb_pemesan', ['id_pemesan' => $id_pemesan]);
    }

    function ubah($id_pemesan)
    {
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $no_telpon = $this->input->post('no_telpon');
        $jumlah_tiket = $this->input->post('jumlah_tiket');
        $konser = $this->input->post('konser');
        $harga = $this->input->post('harga');
        $total = $this->input->post('total');

        $data = [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'konser' => $konser,
            'jumlah_tiket' => $jumlah_tiket,
            'harga' => $harga,
            'total' => $total
        ];
        $this->db->where('id_pemesan', $id_pemesan);
        $this->db->update('tb_pemesan', $data);

        $data_checkin = [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'konser' => $konser,
            'harga' => $harga,
            'total' => $total,
            'jumlah_tiket' => $jumlah_tiket
        ];
        $this->db->where('no_telpon', $no_telpon);
        $this->db->update('tb_checkin', $data_checkin);

        $data_laporan = [
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'konser' => $konser,
            'harga' => $harga,
            'total' => $total,
            'jumlah_tiket' => $jumlah_tiket
        ];
        $this->db->where('no_telpon', $no_telpon);
        $this->db->update('tb_laporan', $data_laporan);
    }
}
