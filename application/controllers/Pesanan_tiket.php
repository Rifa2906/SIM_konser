<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_tiket extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_pesanan');
    }

    public function index()
    {
        $data['pesanan'] = $this->M_pesanan->tampil();
        $data['title'] = 'Data Pemesan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('Pemesanan_tiket/index', $data);
        $this->load->view('templates/footer');
    }

    function ambilNo_id()
    {
        $id_pemesan = $this->input->post('id_pemesan');
        $pemesan = $this->M_pesanan->ambil_noID($id_pemesan)->row_array();
        $data = [
            'id_pemesan' => $pemesan['id_pemesan'],
            'nama' => $pemesan['nama'],
            'alamat' => $pemesan['alamat'],
            'no_telpon' => $pemesan['no_telpon'],
            'konser' => $pemesan['konser'],
            'jumlah_tiket' => $pemesan['jumlah_tiket'],
            'harga' => $pemesan['harga'],
            'total' => $pemesan['total'],
        ];

        echo json_encode($data);
    }

    function ubah_data()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required', [
            'required' => 'Tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('no_telpon', 'no_telpon', 'required|numeric', [
            'required' => 'tidak boleh kosong',
            'numeric' => 'Harus angka'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'required', [
            'required' => 'Tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('jumlah_tiket', 'jumlah_tiket', 'required|numeric', [
            'required' => 'tidak boleh kosong',
            'numeric' => 'Harus angka'
        ]);
        $this->form_validation->set_rules('konser', 'konser', 'required', [
            'required' => 'Tidak boleh kosong'
        ]);


        if ($this->form_validation->run() == true) {
            $id_pemesan = $this->input->post('id_pemesan');
            $this->M_pesanan->ubah($id_pemesan);
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
            $response['nama'] = strip_tags(form_error('nama'));
            $response['alamat'] = strip_tags(form_error('alamat'));
            $response['no_telpon'] = strip_tags(form_error('no_telpon'));
            $response['konser'] = strip_tags(form_error('konser'));
            $response['jumlah_tiket'] = strip_tags(form_error('jumlah_tiket'));
        }
    }

    function hapus_data()
    {
        $id_pemesan = $this->input->post('id_pemesan');
        $no_telpon = $this->input->post('no_telpon');
        $this->db->where('id_pemesan', $id_pemesan);
        $this->db->delete('tb_pemesan');

        $this->db->where('no_telpon', $no_telpon);
        $this->db->delete('tb_checkin');

        $this->db->where('no_telpon', $no_telpon);
        $this->db->delete('tb_laporan');
    }
}
