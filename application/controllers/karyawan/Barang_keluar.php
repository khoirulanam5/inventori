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
        $this->load->view('karyawan/barang_keluar', $data);
        $this->load->view('template/footer');
    }

    public function generateId() {
        $unik = 'BK';
        $kode = $this->db->query("SELECT MAX(id_barang_keluar) LAST_NO FROM tb_barang_keluar WHERE id_barang_keluar LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
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
            $stok = $this->db->get_where('tb_stok_barang', ['id_stok' => $id_stok])->row();
            if ($stok && $jml_keluar > $stok->jml_barang) {
                // Jika jumlah keluar melebihi stok yang tersedia
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Jumlah barang keluar melebihi stok yang tersedia', icon:'warning'})</script>");
                redirect('karyawan/barang_keluar');
            } else {
                // Jika jumlah keluar valid, tambahkan ke barang keluar
                $data = [
                    'id_barang_keluar' => $this->generateId(),
                    'id_user' => $this->session->userdata('id_user'),
                    'id_stok' => $id_stok,
                    'jml_keluar' => $jml_keluar,
                    'tgl_keluar' => date('Y-m-d'),
                    'keterangan' => $this->input->post('keterangan')
                ];
    
                $this->db->insert('tb_barang_keluar', $data);
    
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
            $barang_keluar_lama = $this->db->get_where('tb_barang_keluar', ['id_barang_keluar' => $id_barang_keluar])->row();
            $jml_keluar_lama = $barang_keluar_lama->jml_keluar;
    
            // Ambil stok barang berdasarkan id_stok
            $stok = $this->db->get_where('tb_stok_barang', ['id_stok' => $id_stok])->row();
    
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
                // Update data barang keluar
                $data = [
                    'id_stok' => $id_stok,
                    'jml_keluar' => $jml_keluar_baru,
                    'keterangan' => $this->input->post('keterangan'),
                    'tgl_keluar' => date('Y-m-d')
                ];
    
                $this->db->where('id_barang_keluar', $id_barang_keluar);
                $this->db->update('tb_barang_keluar', $data);
    
                $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data barang keluar berhasil diperbarui', icon:'success'})</script>");
                redirect('karyawan/barang_keluar');
            }
        }
    }
        

    public function delete($id_barang_keluar) {
        $this->db->where('id_barang_keluar', $id_barang_keluar);
        $this->db->delete('tb_barang_keluar');
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Barang keluar berhasil dihapus', icon:'success'})</script>");
        redirect('karyawan/barang_keluar');
    }
}