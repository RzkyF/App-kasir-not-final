<?= $this->extend('layout/default') ?>

<?= $this->section('css') ?>
<!-- Data table Css -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/sweetalert2/sweetalert2.css">
<link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">

<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>Data Log</h3>
            <hr>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('home'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Data log</li>
              </ol>
            </nav>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  foreach ($log as $key => $value) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $value->id_user ?></td>
                      <td><?= $value->nama ?></td>
                      <td><?= $value->username ?></td>
                      <td>
                          <?php if ($value->id_level == 1) {
                            echo "Admin";
                          } elseif($value->id_level == 2) {
                            echo "Kasir";
                          } else {
                            echo "Manajer";
                          }
                          ?>
                    </td>
                      <td><?= $value->waktu ?></td>
                      <td><?= $value->aksi ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('footer') ?>
<!-- JS Libraies -->
<script src="<?= base_url(); ?>/template/assets/bundles/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>/template/assets/bundles/datatables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/template/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
<!-- Page Specific JS File -->
<script src="<?= base_url(); ?>/template/assets/js/page/datatables.js"></script>
<script src="<?= base_url(); ?>/template/assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>/template/assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/template/assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="<?= base_url(); ?>/template/assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>/template/assets/bundles/datatables/export-tables/jszip.min.js"></script>

<?= $this->endSection(); ?>