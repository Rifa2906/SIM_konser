<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Halaman_utama extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_pengguna');
    }
    public function index()
    {

        $data = [
            'jml_pengguna' => $this->db->get('tb_pengguna')->num_rows(),
            'jml_pemesan' => $this->db->get('tb_pemesan')->num_rows(),
            'jml_sudah_checkin' => $this->db->get_where('tb_checkin', ['status' => 'Sudah Checkin'])->num_rows(),
            'jml_belum_checkin' => $this->db->get_where('tb_checkin', ['status' => 'Belum Checkin'])->num_rows()
        ];
        $data['title'] = 'Halaman Utama';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('Halaman_utama/index', $data);
        $this->load->view('templates/footer');
    }
}
