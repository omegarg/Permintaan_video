 <?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class Mpermintaan extends CI_Model
    {
         
        function tampil_permintaan()
        {
            $this->db->join('user_petugas', 'user_petugas.id_user = permintaan.id_user', 'left');
            $ambil = $this->db->get('permintaan');
            return $ambil->result_array();
        }

        function kode_permintaan()
        {
            $this->db->select('RIGHT(permintaan.kode_permintaan,3) as kode_permintaan', FALSE);
            $this->db->where("tgl_permintaan = date_format(now(),'%Y-%m-%d')");
            $this->db->order_by('kode_permintaan', 'DESC');
            $this->db->limit(1);

            $query = $this->db->get('permintaan');
            if ($query->num_rows() <> 0) {
                $data = $query->row();
                $kode = intval($data->kode_permintaan) + 1;
            } else {
                $kode = 1;
            }
			$tgl= date("Ymd");
            $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
            $kodetampil = "PP".$tgl . $batas;
            return $kodetampil;
        }

        function simpan_permintaan($inputan)
        {
            $id_user = $inputan['id_user'];
            $kode_permintaan = $inputan['kode_permintaan'];
            $tgl_permintaan = $inputan['tgl_permintaan'];
            $status_permintaan = $inputan['status_permintaan'];

            $this->db->where('id_user', $id_user);
            $this->db->where('kode_permintaan', $kode_permintaan);
            $this->db->where('tgl_permintaan', $tgl_permintaan);
            $this->db->where('status_permintaan', $status_permintaan);

            $permintaan = $this->db->get('permintaan')->row_array();
            if (empty($permintaan)) {
                $this->db->insert('permintaan', $inputan);
                return 'sukses';
            } else {
                return 'gagal';
            }
        }


        function detail_permintaan($id_permintaan)
        {
            $this->db->join('user_petugas', 'user_petugas.id_user = permintaan.id_user', 'left');
            $this->db->where('id_permintaanpembelian', $id_permintaan);
            $ambil = $this->db->get('permintaan');
            return $ambil->row_array();
        }

        function hapus_permintaan($id_permintaan)
        {
            $this->db->where('id_permintaanpembelian', $id_permintaan);
            $this->db->delete('permintaan');
        }

        function tampil_detailpermintaan($id_permintaan)
        {
            $this->db->join('barang', 'barang.id_barang = detail_permintaan.id_barang', 'left');
            $this->db->join('kategori', 'kategori.id_kategori = barang.id_kategori', 'left');
            $this->db->where('id_permintaanpembelian', $id_permintaan);
            $ambil = $this->db->get('detail_permintaan');

            return $ambil->result_array();
        }

        function detail_detailpermintaan($id_detailpermintaan)
        {
            $this->db->join('barang', 'barang.id_barang = detail_permintaan.id_barang', 'left');
            $this->db->join('permintaan', 'permintaan.id_permintaanpembelian = detail_permintaan.id_permintaan', 'left');
            $this->db->join('user_petugas', 'user_petugas.id_user = permintaan.id_user', 'left');
            
            $this->db->where('id_detailpermintaan', $id_detailpermintaan);
            $ambil = $this->db->get('detail_permintaan');
            return $ambil->row_array();
        }

        function simpan_detailpermintaan($inputan)
        {
            $id_permintaan = $inputan['id_permintaan'];
            $id_barang = $inputan['id_barang'];

            $this->db->where('id_permintaanpembelian', $id_permintaan);
            $this->db->where('id_barang', $id_barang);

            $detail_permintaan = $this->db->get('detail_permintaan')->row_array();
            if (empty($detail_permintaan)) {
                $this->db->insert('detail_permintaan', $inputan);
                return 'sukses';
            } else {
                return 'gagal';
            }
        }

        function hapus_detailpermintaan($id_detailpermintaan)
        {
            $this->db->where('id_detailpermintaanpembelian', $id_detailpermintaan);
            $this->db->delete('detail_permintaan');
        }


        function ubah_detailpermintaan($inputan,  $id_detailpermintaan)
        {
            $jumlah_permintaan = $inputan['jumlah_permintaan'];
            $this->db->query("UPDATE detail_permintaan SET jumlah_permintaan = $jumlah_permintaan WHERE detail_permintaan.id_detailpermintaanpembelian=$id_detailpermintaan");
        }


        function konfirmasi_permintaan($inputan, $id_permintaan)
        {
            $status = $inputan['status_permintaan'];
            $this->db->query("UPDATE permintaan SET status_permintaan = '$status' WHERE permintaan.id_permintaanpembelian = $id_permintaan");
        }

        function tampil_permintaansetuju()
        {
            $ambil = $this->db->query("SELECT * FROM permintaan LEFT JOIN user_petugas ON user_petugas.id_user = permintaan.id_user
             WHERE status_permintaan ='Setuju' AND id_permintaan NOT IN (SELECT id_permintaanpembelian FROM po)");
            return $ambil->result_array();
        }

        function tampil_permintaanmeminta()
        {
            $this->db->join('user_petugas', 'user_petugas.id_user = permintaan.id_user', 'left');
            $this->db->where('status_permintaan', "Meminta");
            $ambil = $this->db->get('permintaan');
            return $ambil->result_array();
        }
    }
