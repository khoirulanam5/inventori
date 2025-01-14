<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['barang_masuk'] = count($this->db->get('tb_barang_masuk')->result());
        $data['barang_keluar'] = count($this->db->get('tb_barang_keluar')->result());
        $data['stok'] = count($this->db->get('tb_stok_barang')->result());
        $data['user'] = count($this->db->get('tb_user')->result());

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}