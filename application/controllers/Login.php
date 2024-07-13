<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Muser');
    }

    public function index()
    {

        //mendapatkan inputan dr form formulir login
        $inputan = $this->input->post();

        //jk ada inputan maka jalankan
        if ($inputan) {
            //jk ada inputan jalankan model mlogin fungsi login 
            $login = $this->Muser->login($inputan);
            if ($login == "admin") {
                $this->session->set_flashdata('pesan', 'Selamat Datang Di Sistem Informasi Video');
                redirect('admin/beranda', 'refresh');
            } elseif ($login == "customer") {
                $this->session->set_flashdata('pesan', 'Selamat Datang Di Sistem Informasi Video');
                redirect('customer/beranda', 'refresh');
            } elseif ($login == "gagal") {
                $this->session->set_flashdata('pesan', 'Login Gagal, Cek Email dan Password Anda');
                redirect('', 'refresh');
            } else {
                $this->session->set_flashdata('pesan', 'Login Gagal, Cek Email dan Password Anda');
                redirect('', 'refresh');
            }
        }

        $this->session->sess_destroy();
        $data = ['title' => 'Login'];
        $this->load->view('Login', $data);
    }
}
