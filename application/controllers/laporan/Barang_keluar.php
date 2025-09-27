<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['BarangKeluarModel']);
        pimpinan_or_admin();
    }

    public function index() {
        $data['title'] = 'Data Barang Keluar';
        $data['barang_keluar'] = $this->BarangKeluarModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('laporan/barang_keluar', $data);
        $this->load->view('template/footer');
    }

    public function print() {
        $data['title'] = 'Print Barang Keluar';
        $data['barang_keluar'] = $this->BarangKeluarModel->getAll()->result();
        
        $this->load->view('print/barang_keluar', $data);
    }
}