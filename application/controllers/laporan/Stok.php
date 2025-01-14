<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Stok';
        $data['stok'] = $this->db->get('tb_stok_barang')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('laporan/stok', $data);
        $this->load->view('template/footer');
    }

    public function print() {
        $data['title'] = 'Print Stok';
        $data['stok'] = $this->db->get('tb_stok_barang')->result();
        $this->load->view('print/stok', $data);
    }
}