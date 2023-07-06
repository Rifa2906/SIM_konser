<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_laporan');
    }

    public function index()
    {
        $data['laporan'] = $this->M_laporan->tampil();
        $data['title'] = 'Laporan Pemesanan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('Laporan/index', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_pdf()
    {
        // panggil library yang kita buat sebelumnya yang bernama pdfgenerator
        $this->load->library('pdfgenerator');

        // title dari pdf
        $this->data['title_pdf'] = 'Data Pemesanan Tiket';
        $this->data['laporan'] = $this->M_laporan->tampil();

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_data_pemesanan_tiket';
        // setting paper
        $paper = 'A4';
        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('Laporan/laporan', $this->data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
