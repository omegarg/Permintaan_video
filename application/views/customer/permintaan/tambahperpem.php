<!-- breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('customer/permintaan'); ?>">Permintaan Video</a></li>
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
<div class="col-lg-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Kode Permintaan Barang</label>
                        <input type="text" class="form-control" id="kode_permintaan" name="kode_permintaan" value="<?= $kodepermintaan; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Pembuat</label>
                        <?php $customer = $this->session->userdata('customer') ?>
                        <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?= $customer['id_user']; ?>" readonly>
                        <input type="text" class="form-control" value="<?= $customer['nama']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tanggal Permintaan</label>
                        <input type="date" class="form-control" name="tgl_permintaan" id="tgl_permintaan" value="<?= date("Y-m-d"); ?>" readonly>
                        <input type="hidden" class="form-control" name="status_permintaan" id="status_permintaan" value="Meminta" readonly>
                    </div>
					<div class="form-group col-md-12">
                        <label>Pilih Video</label>
                        <select class="form-control" name="id_video" id="id_video">
                            <option value="">--Pilih Video--</option>
                            <?php foreach ($video as $key => $value) : ?>
                                <option value="<?= $value['kode_barang'] ?>"> <?= $value['video'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
        </div>
        <div class="card-footer text-md-right">
            <a href="<?= base_url('customer/permintaan'); ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
</div>