<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class StokBarangModel extends CI_Model {

    private $_table = 'tb_stok_barang';

    public function generateId() {
        $unik = 'S';
        $kode = $this->db->query("SELECT MAX(id_stok) LAST_NO FROM tb_stok_barang WHERE id_stok LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
    }

    public function getAll() {
        return $this->db->get($this->_table);
    }

    public function getById($id_stok) {
        return $this->db->get_where($this->_table, ['id_stok' => $id_stok]);
    }

    public function save($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function edit($id_stok, $data) {
        $this->db->where('id_stok', $id_stok);
        return $this->db->update($this->_table, $data);
    }

    public function delete($id_stok) {
        $this->db->where('id_stok', $id_stok);
        return $this->db->delete($this->_table);
    }

    public function up($id_stok, $jml_masuk) {
        $this->db->set('jml_barang', 'jml_barang + ' . (int)$jml_masuk, FALSE);
        $this->db->set('tgl_update', date('Y-m-d'));
        $this->db->where('id_stok', $id_stok);
        return $this->db->update($this->_table);
    }

    public function down($id_stok, $jml_keluar) {
        $this->db->set('jml_barang', 'jml_barang - ' . (int)$jml_keluar, FALSE);
        $this->db->set('tgl_update', date('Y-m-d'));
        $this->db->where('id_stok', $id_stok);
        return $this->db->update($this->_table);
    }
}