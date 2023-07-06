<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_checkin extends CI_Model
{
    function tampil()
    {
        return $this->db->get('tb_checkin')->result_array();
    }
}
