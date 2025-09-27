<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['BarangMasukModel', 'StokBarangModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Barang Masuk';
        $data['barang_masuk'] = $this->BarangMasukModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/barang_masuk', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_barang_masuk) {
        // Ambil data barang masuk berdasarkan ID
        $barang_masuk = $this->BarangMasukModel->getById($id_barang_masuk)->row();
    
        // Pastikan data barang masuk ditemukan
        if ($barang_masuk) {
            $id_stok = $barang_masuk->id_stok;
            $jml_masuk = $barang_masuk->jml_masuk;
    
            // Update jumlah stok barang
            $this->StokBarangModel->up($id_stok, $jml_masuk);
            $this->BarangMasukModel->verify($id_barang_masuk);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data barang masuk berhasil diverifikasi dan stok diperbarui', icon:'success'})</script>");
        } else {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data barang masuk tidak ditemukan', icon:'error'})</script>");
        }
        redirect('admin/barang_masuk');
    }    
}