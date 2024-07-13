<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Mbarang');
        $this->load->model('Mpermintaan');
        $this->load->model('Muser');
        if (!$this->session->userdata("customer")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Permintaan Video';
        $data['permintaan'] = $this->Mpermintaan->tampil_permintaan();
        $this->load->view('header', $data);
        $this->load->view('customer/navbar', $data);
        $this->load->view('customer/permintaan/dataperpem', $data);
        $this->load->view('footer');
    }


    public function tambah()
    {
        //gunakan lib form_validation untuk me required
        $this->form_validation->set_rules('id_user', 'Pembuat', 'required');
        $this->form_validation->set_rules('kode_permintaan', 'Kode', 'required');
        $this->form_validation->set_rules('tgl_permintaan', 'Tanggal', 'required');
        $this->form_validation->set_rules('status_permintaan', 'Status', 'required');
		$this->form_validation->set_rules('id_video', 'Video', 'required');

        $inputan = $this->input->post();
        //jk ada inputan dari formulir
        // jk validation benar 
        if ($this->form_validation->run() == TRUE) {
            //Mpermintaan jalankan fungsi simpan_permintaan($inputan)
            $this->Mpermintaan->simpan_permintaan($inputan);
            //tampilkan customer/permintaan/index
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('customer/permintaan', 'refresh');
        }
        // selain itu gagal  
        else {
            $data['gagal'] = validation_errors();
        }
        //tampilkan kode permintaan pada inputan
        $data['kodepermintaan'] = $this->Mpermintaan->kode_permintaan();
        $data['title'] = 'Tambah Permintaan Video';
		$data['video'] = $this->Mbarang->tampil_barang();
		
        $this->load->view('header', $data);
        $this->load->view('customer/navbar', $data);
        $this->load->view('customer/permintaan/tambahperpem', $data);
        $this->load->view('footer');
    }


  
 
}
