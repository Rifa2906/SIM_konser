<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_checkin');
    }

    public function index()
    {
        $data['title'] = 'Data Checkin';
        $data['checkin'] = $this->M_checkin->tampil();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('Checkin/index', $data);
        $this->load->view('templates/footer');
    }

    public function cek_noID()
    {
        $this->form_validation->set_rules('no_id', 'no_id', 'required', [
            'required' => 'Tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == true) {
            $no_id = $this->input->post('no_id');
            $checkin = $this->db->get_where('tb_checkin', ['no_id' => $no_id])->row_array();

            if ($checkin) {
                if ($checkin['status'] == 'Sudah Checkin') {
                    $response['status'] = 'sudah digunakan';
                } else {
                    $data = [
                        'status' => 'Sudah Checkin'
                    ];

                    $this->db->where('no_id', $no_id);
                    $this->db->update('tb_checkin', $data);

                    $data_laporan = [
                        'status' => 'Sudah Checkin'
                    ];

                    $this->db->where('no_id', $no_id);
                    $this->db->update('tb_laporan', $data_laporan);

                    $response['status'] = 'berhasil';
                }
            } else {
                $response['status'] = 'tidak ada';
            }
        } else {
            $response['status'] = 0;
            $response['no_id'] = strip_tags(form_error('no_id'));
        }

        echo json_encode($response);
    }
}
