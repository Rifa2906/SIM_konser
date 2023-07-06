<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Formulir_pesanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_formulir');
    }

    public function index()
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
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required|numeric', [
            'required' => 'tidak boleh kosong',
            'numeric' => 'Harus angka'
        ]);
        if ($this->form_validation->run() == true) {

            $no_telpon = $this->input->post('no_telpon');
            $no_id = $this->noID_otomatis();
            $this->M_formulir->tambahdata($no_id);
            $this->cetak_pdf($no_telpon);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tiket Berhasil Di Pesan
           </div>');
            redirect('Formulir_pesanan');
        } else {
            $data['title'] = 'Formulir Pesanan Tiket';
            $this->load->view('templates/header_login', $data);
            $this->load->view('Formulir_pesanan/index');
            $this->load->view('templates/footer_login');
        }
    }

    function noID_otomatis()
    {
        $tabel = "tb_pemesan";
        $field = "no_id";

        $lastkode = $this->M_formulir->get_max($tabel, $field);
        //mengambil 4 karakter dari belakang
        $noUrut = (int) substr($lastkode, -4, 4);
        $noUrut++;
        $str = "K";
        $newKode = $str . sprintf('%04s', $noUrut);
        return $newKode;
    }

    public function cetak_pdf($no_telpon)
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Data Pemesanan Tiket';
        $this->data['tiket'] = $this->db->get_where('tb_pemesan', ['no_telpon' => $no_telpon])->row_array();

        // filename dari pdf ketika didownload
        $file_pdf = 'Tiket Konser';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";
        $view_pdf = 1;

        $html = $this->load->view('Formulir_pesanan/tiket', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation, $view_pdf);
    }
}
