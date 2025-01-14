<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Barang Masuk';
        
        $this->db->select('tb_barang_masuk.*, tb_user.*, tb_stok_barang.*');
        $this->db->from('tb_barang_masuk');
        $this->db->join('tb_user', 'tb_barang_masuk.id_user = tb_user.id_user', 'left');
        $this->db->join('tb_stok_barang', 'tb_barang_masuk.id_stok = tb_stok_barang.id_stok', 'left');
        $data['barang_masuk'] = $this->db->get()->result();

        $data['stok'] = $this->db->get('tb_stok_barang')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('karyawan/barang_masuk', $data);
        $this->load->view('template/footer');
    }

    public function generateId() {
        $unik = 'BM';
        $kode = $this->db->query("SELECT MAX(id_barang_masuk) LAST_NO FROM tb_barang_masuk WHERE id_barang_masuk LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
      }

    public function add() {
        $this->form_validation->set_rules('jml_masuk', 'Jumlah barang', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('karyawan/barang_masuk');
        } else {
            $data = [
                'id_barang_masuk' => $this->generateId(),
                'id_user' => $this->session->userdata('id_user'),
                'id_stok' => $this->input->post('id_stok'),
                'jml_masuk' => $this->input->post('jml_masuk'),
                'tgl_masuk' => date('Y-m-d'),
                'keterangan' => $this->input->post('keterangan')
            ];

            $this->db->insert('tb_barang_masuk', $data);

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
    
            $this->db->where('id_barang_masuk', $id_barang_masuk);
            $this->db->update('tb_barang_masuk', $data);
    
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data barang masuk berhasil diperbarui', icon:'success'})</script>");
            redirect('karyawan/barang_masuk');
        }
    }    

    public function delete($id_barang_masuk) {
        $this->db->where('id_barang_masuk', $id_barang_masuk);
        $this->db->delete('tb_barang_masuk');
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Barang masuk berhasil dihapus', icon:'success'})</script>");
        redirect('karyawan/barang_masuk');
    }
}