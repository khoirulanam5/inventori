<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['BarangKeluarModel', 'StokBarangModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Barang Keluar';
        $data['barang_keluar'] = $this->BarangKeluarModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/barang_keluar', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_barang_keluar) {
        // Ambil data barang masuk berdasarkan ID
        $barang_keluar = $this->BarangKeluarModel->getById($id_barang_keluar)->row();
    
        // Pastikan data barang masuk ditemukan
        if ($barang_keluar) {
            $id_stok = $barang_keluar->id_stok;
            $jml_keluar = $barang_keluar->jml_keluar;
    
            // Update jumlah stok barang
            $this->StokBarangModel->down($id_stok, $jml_keluar);
            $this->BarangKeluarModel->verify($id_barang_keluar);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data barang masuk berhasil diverifikasi dan stok diperbarui', icon:'success'})</script>");
        } else {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data barang masuk tidak ditemukan', icon:'error'})</script>");
        }
        redirect('admin/barang_keluar');
    }
}