<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Stok';
        $data['stok'] = $this->db->get('tb_stok_barang')->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/stok', $data);
        $this->load->view('template/footer');
    }

    public function generateIdStok() {
        $unik = 'S';
        $kode = $this->db->query("SELECT MAX(id_stok) LAST_NO FROM tb_stok_barang WHERE id_stok LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
      }

    public function add() {
        $this->form_validation->set_rules('nm_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('jml_barang', 'Jumlah Barang', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('admin/stok');
        } else {
            // Konfigurasi upload
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/images/';
            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');
            $image = $this->upload->data('file_name');
            
            $data = [
                'id_stok' => $this->generateIdStok(),
                'nm_barang' => $this->input->post('nm_barang'),
                'jenis_barang' => $this->input->post('jenis_barang'),
                'foto' => $image,
                'jml_barang' => $this->input->post('jml_barang'),
                'tgl_update' => date('Y-m-d')
            ];

            $this->db->insert('tb_stok_barang', $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data stok berhasil ditambahkan', icon:'success'})</script>");
            redirect('admin/stok');
        }
    }

    public function edit($id_stok) {
        $this->form_validation->set_rules('nm_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('jenis_barang', 'Jenis Barang', 'required');
        $this->form_validation->set_rules('jml_barang', 'Jumlah Barang', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Kesalahan input data', icon:'warning'})</script>");
            redirect('admin/stok');
        } else {
            $id = $this->input->post('id_stok');

            // Cek jika ada file foto yang diunggah
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/images/';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                // Jika file diunggah, gunakan file baru
                $image = $this->upload->data('file_name');
            } else {
                // Jika tidak ada file baru, ambil foto lama dari database
                $stok = $this->db->get_where('tb_stok_barang', ['id_stok' => $id])->row();
                $image = $stok->foto; // Gunakan foto lama
            }

            $data = [
                'id_stok' => $id,
                'nm_barang' => $this->input->post('nm_barang'),
                'jenis_barang' => $this->input->post('jenis_barang'),
                'foto' => $image,
                'jml_barang' => $this->input->post('jml_barang'),
                'tgl_update' => date('Y-m-d')
            ];

            $this->db->where('id_stok', $id);
            $this->db->update('tb_stok_barang', $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data stok berhasil diupdate', icon:'success'})</script>");
            redirect('admin/stok');
        }
    }

    public function delete($id_stok) {
        $this->db->where('id_stok', $id_stok);
        $this->db->delete('tb_stok_barang');
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data stok berhasil dihapus', icon:'success'})</script>");
        redirect('admin/stok');
    }
}