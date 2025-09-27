<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangKeluarModel extends CI_Model {

    private $_table = 'tb_barang_keluar';

    public function generateId() {
        $unik = 'BK';
        $kode = $this->db->query("SELECT MAX(id_barang_keluar) LAST_NO FROM tb_barang_keluar WHERE id_barang_keluar LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        $this->db->select('tb_barang_keluar.*, tb_user.*, tb_stok_barang.*');
        $this->db->from($this->_table);
        $this->db->join('tb_user', 'tb_barang_keluar.id_user = tb_user.id_user', 'left');
        $this->db->join('tb_stok_barang', 'tb_barang_keluar.id_stok = tb_stok_barang.id_stok', 'left');
        return $this->db->get();
    }

    public function getById($id_barang_keluar) {
        return $this->db->get_where($this->_table, ['id_barang_keluar' => $id_barang_keluar]);
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_barang_keluar, $data) {
        $this->db->where('id_barang_keluar', $id_barang_keluar);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_barang_keluar) {
        $this->db->where('id_barang_keluar', $id_barang_keluar);
        return $this->db->delete($this->_table);
    }

    public function verify($id_barang_keluar) {
        $this->db->set('verifikasi', 'sudah verifikasi');
        $this->db->where('id_barang_keluar', $id_barang_keluar);
        return $this->db->update($this->_table);
    }
}