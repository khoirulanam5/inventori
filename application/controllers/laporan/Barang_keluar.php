<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Barang Keluar';
        
        $this->db->select('tb_barang_keluar.*, tb_user.*, tb_stok_barang.*');
        $this->db->from('tb_barang_keluar');
        $this->db->join('tb_user', 'tb_barang_keluar.id_user = tb_user.id_user', 'left');
        $this->db->join('tb_stok_barang', 'tb_barang_keluar.id_stok = tb_stok_barang.id_stok', 'left');
        $data['barang_keluar'] = $this->db->get()->result();

        $data['stok'] = $this->db->get('tb_stok_barang')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('laporan/barang_keluar', $data);
        $this->load->view('template/footer');
    }

    public function print() {
        $data['title'] = 'Print Barang Keluar';

        $this->db->select('tb_barang_keluar.*, tb_user.*, tb_stok_barang.*');
        $this->db->from('tb_barang_keluar');
        $this->db->join('tb_user', 'tb_barang_keluar.id_user = tb_user.id_user', 'left');
        $this->db->join('tb_stok_barang', 'tb_barang_keluar.id_stok = tb_stok_barang.id_stok', 'left');
        $data['barang_keluar'] = $this->db->get()->result();

        $data['stok'] = $this->db->get('tb_stok_barang')->result();
        
        $this->load->view('print/barang_keluar', $data);
    }
}