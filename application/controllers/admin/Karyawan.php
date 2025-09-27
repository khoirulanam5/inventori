<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['UserModel']);
        isadmin();
    }

    public function index() {
        $data['title'] = 'Data Karyawan';
        $data['karyawan'] = $this->UserModel->getKaryawan()->result();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/karyawan', $data);
        $this->load->view('template/footer');
    }

    public function add() {
        $this->form_validation->set_rules('nm_pengguna', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Maaf', text:'Username sudah digunakan', icon:'warning'})</script>");
            redirect('admin/karyawan');
        } else {
            $data = [
                'id_user' => $this->UserModel->generateId(),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'level' => 'KARYAWAN'
            ];
            $this->UserModel->save($data);

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
            $data = [
                'id_user' => $id_user,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'nm_pengguna' => $this->input->post('nm_pengguna'),
                'level' => 'KARYAWAN'
            ];
            $this->UserModel->edit($id_user, $data);

            $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data karyawan berhasil diupdate', icon:'success'})</script>");
            redirect('admin/karyawan');
        }
    }

    public function delete($id_user) {
        $this->UserModel->delete($id_user);

        $this->session->set_flashdata("pesan", "<script>Swal.fire({title:'Berhasil', text:'Data karyawan berhasil dihapus', icon:'success'})</script>");
        redirect('admin/karyawan');
    }
}