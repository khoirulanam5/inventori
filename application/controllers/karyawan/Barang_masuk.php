<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['BarangMasukModel', 'StokBarangModel']);
        iskaryawan();
    }

    public function index() {
        $data['title'] = 'Data Barang Masuk';
        $data['barang_masuk'] = $this->BarangMasukModel->getAll()->result();
        $data['stok'] = $this->StokBarangModel->getAll()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('karyawan/barang_masuk', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('jml_masuk', 'Jumlah barang', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('karyawan/barang_masuk');
        } else {
            $data = [
                'id_barang_masuk' => $this->BarangMasukModel->generateId(),
                'id_user' => $this->session->userdata('id_user'),
                'id_stok' => $this->input->post('id_stok'),
                'jml_masuk' => $this->input->post('jml_masuk'),
                'tgl_masuk' => date('Y-m-d'),
                'keterangan' => $this->input->post('keterangan')
            ];
            $this->BarangMasukModel->save($data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Barang masuk berhasil ditambahkan', icon:'success'})</script>");
            redirect('karyawan/barang_masuk');
        }
    }

    public function edit($id_barang_masuk) {
        $this->form_validation->set_rules('jml_masuk', 'Jumlah Barang', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('karyawan/barang_masuk');
        } else {
            $data = [
                'id_stok' => $this->input->post('id_stok'),
                'jml_masuk' => $this->input->post('jml_masuk'),
                'keterangan' => $this->input->post('keterangan'),
                'tgl_masuk' => date('Y-m-d')
            ];
            $this->BarangMasukModel->edit($id_barang_masuk, $data);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data barang masuk berhasil diperbarui', icon:'success'})</script>");
            redirect('karyawan/barang_masuk');
        }
    }    

    public function delete($id_barang_masuk) {
        $this->BarangMasukModel->delete($id_barang_masuk);

        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Barang masuk berhasil dihapus', icon:'success'})</script>");
        redirect('karyawan/barang_masuk');
    }
}