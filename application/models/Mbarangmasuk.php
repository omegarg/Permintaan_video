 <?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class Mbarangmasuk extends CI_Model
    {

        function tampil_barangmasuk()
        {
            #$this->db->join('user_petugas', 'user_petugas.id_user = video.id_user', 'left');
            $ambil = $this->db->get('video');
            return $ambil->result_array();
        }

        function kode_barangmasuk()
        {
            $this->db->select('RIGHT(video.kode_barang,2) as kode_barang', FALSE);
			$this->db->where("tanggal", "date_format(NOW(), '%Y-%m-%d')");
            $this->db->order_by('kode_barang', 'DESC');
            $this->db->limit(1);

            $query = $this->db->get('video');
            if ($query->num_rows() <> 0) {
                $data = $query->row();
                $kode = intval($data->kode_barang) + 1;
            } else {
                $kode = 1;
            }

            $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
			$tgl = date("Ymd");
            $kodetampil = "VD" .$tgl. $batas;
            return $kodetampil;
        }

        function tampilbarang()
        {
            $ambil = $this->db->get('video');
            return $ambil->result_array();
        }


        function simpan_barangmasuk($inputan)
        {
				
			$id_user = $inputan['id_user'];
            $video = $inputan['video'];
            $kode_barang = $inputan['kode_barang'];
            $tanggal = $inputan['tanggal'];
            $file = $inputan['file'];
            
            $this->db->where('id_user', $id_user);
            $this->db->where('video', $video);
            $this->db->where('kode_barang', $kode_barang);
            $this->db->where('tanggal', $tanggal);
            $this->db->where('file', $file);

            $barang = $this->db->get('video')->row_array();
            if (empty($barang)) {
                $this->db->insert('video', $inputan);
                return 'sukses';
            } else {
                return 'gagal';
            }
            /*
            $video = $this->db->get('video')->row_array();
            if (!empty($video)) {
                $this->db->insert('video', $inputan);
                return 'sukses';
            } else {
                return 'gagal';
            }
			*/
        }

        function detail_barangmasuk($id_barangmasuk)
        {
            $this->db->join('user_petugas', 'user_petugas.id_user = video.id_user', 'left');
            $this->db->where('id_barangmasuk', $id_barangmasuk);
            $ambil = $this->db->get('video');
            return $ambil->row_array();
        } 
    }
