<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['BarangMasukModel']);
        pimpinan_or_admin();
    }

    public function index() {
        $data['title'] = 'Data Barang Masuk';
        $data['barang_masuk'] = $this->BarangMasukModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('laporan/barang_masuk', $data);
        $this->load->view('template/footer');
    }
    
    public function print() {
        $data['title'] = 'Print Barang Masuk';
        $data['barang_masuk'] = $this->BarangMasukModel->getAll()->result();

        $this->load->view('print/barang_masuk', $data);
    }
}