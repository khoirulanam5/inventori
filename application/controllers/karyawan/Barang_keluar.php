<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['BarangKeluarModel', 'StokBarangModel']);
        iskaryawan();
    }

    public function index() {
        $data['title'] = 'Data Barang Keluar';
        $data['barang_keluar'] = $this->BarangKeluarModel->getAll()->result();
        $data['stok'] = $this->StokBarangModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('karyawan/barang_keluar', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('jml_keluar', 'Jumlah barang', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('karyawan/barang_keluar');
        } else {
            $id_stok = $this->input->post('id_stok');
            $jml_keluar = $this->input->post('jml_keluar');
    
            // Cek jumlah barang di stok
            $stok = $this->StokBarangModel->getById($id_stok)->row();

            if ($stok && $jml_keluar > $stok->jml_barang) {
                // Jika jumlah keluar melebihi stok yang tersedia
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Jumlah barang keluar melebihi stok yang tersedia', icon:'warning'})</script>");
                redirect('karyawan/barang_keluar');
            } else {
                $data = [
                    'id_barang_keluar' => $this->BarangKeluarModel->generateId(),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_stok' => $id_stok,
                    'jml_keluar' => $jml_keluar,
                    'tgl_keluar' => date('Y-m-d'),
                    'keterangan' => $this->input->post('keterangan')
                ];
                $this->BarangKeluarModel->save($data);
    
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Barang keluar berhasil ditambahkan', icon:'success'})</script>");
                redirect('karyawan/barang_keluar');
            }
        }
    }
    
    public function edit($id_barang_keluar) {
        $this->form_validation->set_rules('jml_keluar', 'Jumlah Barang', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('karyawan/barang_keluar');
        } else {
            $id_stok = $this->input->post('id_stok');
            $jml_keluar_baru = $this->input->post('jml_keluar');
    
            // Ambil data barang keluar yang lama
            $barang_keluar_lama = $this->BarangKeluarModel->getById($id_barang_keluar)->row();
            $jml_keluar_lama = $barang_keluar_lama->jml_keluar;
    
            // Ambil stok barang berdasarkan id_stok
            $stok = $this->StokBarangModel->getById($id_stok)->row();
    
            if (!$stok) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data stok tidak ditemukan', icon:'error'})</script>");
                redirect('karyawan/barang_keluar');
            }
    
            // Hitung stok baru (kembalikan stok lama sebelum membandingkan)
            $stok_tersedia = $stok->jml_barang + $jml_keluar_lama;
    
            if ($jml_keluar_baru > $stok_tersedia) {
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Jumlah barang keluar melebihi stok yang tersedia', icon:'warning'})</script>");
                redirect('karyawan/barang_keluar');
            } else {
                $data = [
                    'id_stok' => $id_stok,
                    'jml_keluar' => $jml_keluar_baru,
                    'keterangan' => $this->input->post('keterangan'),
                    'tgl_keluar' => date('Y-m-d')
                ];
                $this->BarangKeluarModel->edit($id_barang_keluar, $data);
    
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data barang keluar berhasil diperbarui', icon:'success'})</script>");
                redirect('karyawan/barang_keluar');
            }
        }
    }
        

    public function delete($id_barang_keluar) {
        $this->BarangKeluarModel->delete($id_barang_keluar);
        
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Barang keluar berhasil dihapus', icon:'success'})</script>");
        redirect('karyawan/barang_keluar');
    }
}