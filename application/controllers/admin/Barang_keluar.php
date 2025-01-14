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
        $this->load->view('admin/barang_keluar', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_barang_keluar) {
        // Ambil data barang masuk berdasarkan ID
        $barang_keluar = $this->db->get_where('tb_barang_keluar', ['id_barang_keluar' => $id_barang_keluar])->row();
    
        // Pastikan data barang masuk ditemukan
        if ($barang_keluar) {
            $id_stok = $barang_keluar->id_stok;
            $jml_keluar = $barang_keluar->jml_keluar;
    
            // Update jumlah stok barang
            $this->db->set('jml_barang', 'jml_barang - ' . (int)$jml_keluar, FALSE);
            $this->db->set('tgl_update', date('Y-m-d'));
            $this->db->where('id_stok', $id_stok);
            $this->db->update('tb_stok_barang');

            $this->db->set('verifikasi', 'sudah verifikasi');
            $this->db->where('id_barang_keluar', $id_barang_keluar);
            $this->db->update('tb_barang_keluar');
    
            // Beri notifikasi berhasil
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data barang masuk berhasil diverifikasi dan stok diperbarui', icon:'success'})</script>");
        } else {
            // Jika data barang masuk tidak ditemukan
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data barang masuk tidak ditemukan', icon:'error'})</script>");
        }
    
        // Redirect kembali ke halaman barang masuk
        redirect('admin/barang_keluar');
    }
}