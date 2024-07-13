 <!-- breadcrumb -->
 <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= base_url('admin/barangmasuk'); ?>">Video</a></li>
         <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
     </ol>
 </nav>

 <!-- jika ada pesan gagal -->
 <?php if ($gagal) : ?>
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
         <?= $gagal ?>
     </div>

     <script>
         $(".alert").alert();
     </script>
 <?php endif ?>

 <!-- Card Tambah Data  -->
 <div class="card shadow mb-4 col-lg-8 mx-auto">
     <div class="card-header py-3">
         <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
     </div>
     <div class="card-body">
         <form method="post" enctype="multipart/form-data">
             <div class="row">
                 <div class="form-group col-md-6">
                     <label>Kode Video</label>
                     <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $kode_barang; ?>" readonly />
                 </div>
                 <div class="form-group col-md-6">
                     <label>Tanggal</label>
                     <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= date("Y-m-d") ?>" readonly >
                 </div>
                 <div class="form-group col-md-6">
                     <label>Pembuat</label>
                     <?php $admin = $this->session->userdata('admin') ?>
                     <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $admin['id_user']; ?>" readonly>
                     <input type="text" class="form-control" value="<?= $admin['nama']; ?>" readonly />
                 </div>
                 <div class="form-group col-md-6">
                     <label>Judul Video</label>
					 <input type="text" class="form-control" id="video" name="video"  />
					 
                 </div>
				 <div class="form-group col-md-6">
                     <label>File Video</label>
					 <input type="file" class="form-control" id="file" name="file"  />
					 
                 </div>
             </div>
     </div>
     <div class=" card-footer text-md-right">
         <a href="<?= base_url('admin/barangmasuk'); ?>" class="btn btn-secondary">Batal</a>
         <button type="submit" class="btn btn-primary">Simpan</button>
     </div>
     </form>
 </div>