<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_formulir extends CI_Model
{
    function get_max($tabel = null, $field = null)
    {
        $this->db->select_max($field);
        return $this->db->get($tabel)->row_array()[$field];
    }

    function tambahdata($no_id)
    {
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $no_telpon = $this->input->post('no_telpon');
        $jumlah = $this->input->post('jumlah');
        $total = $this->input->post('total');
        $harga = 500000;

        $data = [
            'no_id' => $no_id,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'konser' => 'Coldplay',
            'jumlah_tiket' => $jumlah,
            'harga' => $harga,
            'total' => $total
        ];
        $this->db->insert('tb_pemesan', $data);

        $data_checkin = [
            'no_id' => $no_id,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'konser' => 'Coldplay',
            'jumlah_tiket' => $jumlah,
            'harga' => $harga,
            'total' => $total,
            'status' => 'Belum Checkin',
        ];
        $this->db->insert('tb_checkin', $data_checkin);


        $data_laporan = [
            'no_id' => $no_id,
            'nama' => $nama,
            'alamat' => $alamat,
            'no_telpon' => $no_telpon,
            'konser' => 'Coldplay',
            'jumlah_tiket' => $jumlah,
            'harga' => $harga,
            'total' => $total,
            'status' => 'Belum Checkin',
        ];
        $this->db->insert('tb_laporan', $data_laporan);
    }
}
