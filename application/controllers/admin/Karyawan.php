<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Data Karyawan';
        $data['karyawan'] = $this->db->get_where('tb_user', ['level' => 'KARYAWAN'])->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/karyawan', $data);
        $this->load->view('template/footer');
    }

    public function generateIdUser() {
        $unik = 'U';
        $kode = $this->db->query("SELECT MAX(id_user) LAST_NO FROM tb_user WHERE id_user LIKE '".$unik."%'")->row()->LAST_NO;
        $urutan = (int) substr($kode, 1, 3);
        $urutan++;
        $huruf = $unik;
        $kode = $huruf . sprintf("%03s", $urutan);
        return $kode;
      }

    public function add() {
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Username sudah digunakan', icon:'warning'})</script>");
            redirect('admin/karyawan');
        } else {
            $user = [
                'id_user' => $this->generateIdUser(),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'level' => 'KARYAWAN'
            ];
            $this->db->insert('tb_user', $user);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data karyawan berhasil ditambahkan', icon:'success'})</script>");
            redirect('admin/karyawan');
        }
    }

    public function edit($id_user) {
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Username sudah digunakan', icon:'warning'})</script>");
            redirect('admin/karyawan');
        } else {
            $id = $this->input->post('id_user');

            $user = [
                'id_user' => $id,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'level' => 'KARYAWAN'
            ];
            $this->db->where('id_user', $id);
            $this->db->update('tb_user', $user);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data karyawan berhasil diupdate', icon:'success'})</script>");
            redirect('admin/karyawan');
        }
    }

    public function delete($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');
        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data karyawan berhasil dihapus', icon:'success'})</script>");
        redirect('admin/karyawan');
    }
}