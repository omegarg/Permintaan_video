<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barangmasuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mbarangmasuk');
        $this->load->model('Mpermintaan');
        $this->load->model('Muser');
        if (!$this->session->userdata("admin")) {
            $this->session->set_flashdata('pesan', 'Anda harus login');
            redirect('', 'refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Video';
        $data['barangmasuk'] = $this->Mbarangmasuk->tampil_barangmasuk();

        $this->load->view('header', $data);
        $this->load->view('admin/navbar', $data);
        $this->load->view('admin/barangmasuk/databarsuk', $data);
        $this->load->view('footer');
    }

	
    public function tambah()
    {
		if (!empty($_FILES['file']['name'])) {
		$config['upload_path'] = './assets/video/';
		$config['allowed_types'] = 'mp4';
		$this->upload->initialize($config);

		#$inputan = $this->input->post();
        //gunakan lib form_validation untuk me required
        $this->form_validation->set_rules('id_user', 'Pembuat', 'required');
        $this->form_validation->set_rules('video', 'Judul Video', 'required');
        $this->form_validation->set_rules('kode_barang', 'Kode Video', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required'); 
        
		$inputan['id_user'] = $this->input->post('id_user');
        $inputan['video'] = $this->input->post('video');
        $inputan['kode_barang'] = $this->input->post('kode_barang');
		
        $this->upload->do_upload("file");

            //mendapatkan nama foto yg diupload
        $inputan["file"] = $this->upload->data("file_name");
        #$inputan["file_video"] = $_FILES['file']['name'];
		$inputan['tanggal'] = $this->input->post('tanggal');
        }
        //jk ada inputan dari formulir
        // jk validation benar 
        if ($this->form_validation->run() == TRUE) {
            //Mbarangmasuk jalankan fungsi simpan_barangmasuk($inputan)
            $this->Mbarangmasuk->simpan_barangmasuk($inputan);
            //tampilkan admin/barangmasuk/index
            $this->session->set_flashdata('pesan', 'Data berhasil ditambah!');
            redirect('admin/barangmasuk', 'refresh');
        }
        else {
            $data['gagal'] = validation_errors();
        }
	
        //tampilkan kode_barangmasuk pada inputan
        $data['kode_barang'] = $this->Mbarangmasuk->kode_barangmasuk();
        $data['permintaan'] = $this->Mbarangmasuk->tampilbarang();
        $data['title'] = 'Tambah Video';

        $this->load->view('header', $data);
        $this->load->view('admin/navbar', $data);
        $this->load->view('admin/barangmasuk/tambahbarsuk', $data);
        $this->load->view('footer');
    }

}
