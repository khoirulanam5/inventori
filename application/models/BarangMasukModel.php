<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangMasukModel extends CI_Model {

    private $_table = 'tb_barang_masuk';

    public function generateId() {
        $unik = 'BM';
        $kode = $this->db->query("SELECT MAX(id_barang_masuk) LAST_NO FROM tb_barang_masuk WHERE id_barang_masuk LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 2, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        $this->db->select('tb_barang_masuk.*, tb_user.*, tb_stok_barang.*');
        $this->db->from($this->_table);
        $this->db->join('tb_user', 'tb_barang_masuk.id_user = tb_user.id_user', 'left');
        $this->db->join('tb_stok_barang', 'tb_barang_masuk.id_stok = tb_stok_barang.id_stok', 'left');
        return $this->db->get();
    }

    public function getById($id_barang_masuk) {
        return $this->db->get_where($this->_table, ['id_barang_masuk' => $id_barang_masuk]);
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_barang_masuk, $data) {
        $this->db->where('id_barang_masuk', $id_barang_masuk);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_barang_masuk) {
        $this->db->where('id_barang_masuk', $id_barang_masuk);
        return $this->db->delete($this->_table);
    }

    public function verify($id_barang_masuk) {
        $this->db->set('verifikasi', 'sudah verifikasi');
        $this->db->where('id_barang_masuk', $id_barang_masuk);
        return $this->db->update($this->_table);
    }
}