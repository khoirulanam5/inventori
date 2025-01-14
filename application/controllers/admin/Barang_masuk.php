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
        $this->load->view('admin/barang_masuk', $data);
        $this->load->view('template/footer');
    }

    public function verifikasi($id_barang_masuk) {
        // Ambil data barang masuk berdasarkan ID
        $barang_masuk = $this->db->get_where('tb_barang_masuk', ['id_barang_masuk' => $id_barang_masuk])->row();
    
        // Pastikan data barang masuk ditemukan
        if ($barang_masuk) {
            $id_stok = $barang_masuk->id_stok;
            $jml_masuk = $barang_masuk->jml_masuk;
    
            // Update jumlah stok barang
            $this->db->set('jml_barang', 'jml_barang + ' . (int)$jml_masuk, FALSE);
            $this->db->set('tgl_update', date('Y-m-d'));
            $this->db->where('id_stok', $id_stok);
            $this->db->update('tb_stok_barang');

            $this->db->set('verifikasi', 'sudah verifikasi');
            $this->db->where('id_barang_masuk', $id_barang_masuk);
            $this->db->update('tb_barang_masuk');
    
            // Beri notifikasi berhasil
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data barang masuk berhasil diverifikasi dan stok diperbarui', icon:'success'})</script>");
        } else {
            // Jika data barang masuk tidak ditemukan
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Gagal', text:'Data barang masuk tidak ditemukan', icon:'error'})</script>");
        }
    
        // Redirect kembali ke halaman barang masuk
        redirect('admin/barang_masuk');
    }    
}