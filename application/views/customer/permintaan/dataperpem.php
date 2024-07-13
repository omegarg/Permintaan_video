<!-- breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
    </ol>
</nav>

<!-- Card -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <h4 class="m-0 font-weight-bold text-primary"><?= $title; ?></h4>
            </div>
            <div class="col-md-6 text-md-right mt-2 mt-md-0">
                <a href="<?= base_url('customer/permintaan/tambah') ?>" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Tambah</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Pembuat</th>
                        <th>Video</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($permintaan as $key => $value) : ?>
                        <tr>
                            <td><?= $value['kode_permintaan']; ?></td>
                            <td><?= tanggal($value['tgl_permintaan']); ?></td>
                            <td><?= $value['nama']; ?></td>
                            <td><?= $value['id_video']; ?></td>
                            <td class="text-center">
                                <?php if ($value['status_permintaan'] == 'Setuju') : ?>
                                    <a href="<?= base_url('customer/permintaan/detail/' . $value['id_permintaanpembelian']) ?>" class="btn btn-info btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="btn btn-sm btn-success"></i>
                                    </span>
                                    <span class="text">Lihat</span>
                                </a>
                                <?php elseif ($value['status_permintaan'] == 'Ditolak') : ?>
                                    <button type="button" class="btn btn-sm btn-danger" disabled>
                                        Ditolak
                                    </button>
                                <?php elseif ($value['status_permintaan'] == 'Meminta') : ?>
                                    <button type="button" class="btn btn-sm btn-primary" disabled>
                                        Meminta
                                    </button>
                                <?php else : ?>
                                <?php endif; ?>
                            </td>
                            
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pesan berhasil  -->
<?php if ($this->session->flashdata('pesan')) : ?>
    <script>
        swal({
            icon: "success",
            title: "Berhasil!",
            text: "<?= $this->session->flashdata('pesan') ?>",
            button: false,
            timer: 2000,
        });
    </script>
<?php endif; ?>


<!-- hapus data -->
<script>
    $(document).ready(function() {
        $(".btn-hapus").on("click", function(e) {
            e.preventDefault();
            var idnya = $(this).attr("idnya");
            swal({
                    title: "Apakah kamu yakin ?",
                    text: "untuk menghapus data ini",
                    icon: "warning",
                    buttons: ["Batal", "Hapus Data!"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        //disini ajax hapus data
                        $.ajax({
                            type: 'post',
                            url: "<?= base_url("customer/permintaan/hapus"); ?>",
                            data: 'id=' + idnya,
                            success: function() {
                                swal("Data berhasil terhapus!", {
                                    icon: "success",
                                    button: true
                                }).then((oke) => {
                                    if (oke) {
                                        location = "<?= base_url("customer/permintaan"); ?>"
                                    }
                                });
                            }
                        })
                    }
                });
        })
    })
</script>