<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{
    function tampil()
    {
        return $this->db->get('tb_laporan')->result_array();
    }
}
