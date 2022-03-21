<?= $this->extend('layout/default') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/img-upload.css">
<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>Tambah menu <a href="<?= site_url('/menu'); ?>"></a></h3>
            <hr>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('home'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('/menu'); ?>"><i class="fas fa-list"></i> Data menu </a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-utensils"></i>Tambah menu</li>
              </ol>
            </nav>
          </div>
          <div class="card-body">
            <form method="POST" class="formmenu" action="<?= site_url('menu') ?>" onsubmit="return checkForm(this);" enctype="multipart/form-data">
              <?= csrf_field(); ?>
              <div class="form-group">
                <label>Nama Menu</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-utensils"></i>
                    </div>
                  </div>
                  <input type="text" value="<?= old('nama_menu'); ?>" class="form-control <?= ($validation->hasError('nama_menu')) ? 'is-invalid' : ''; ?>" placeholder="Nama Menu..." name="nama_menu" autocomplete="off">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama_menu'); ?>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Jenis</label>
                <select class="custom-select <?= ($validation->hasError('jenis')) ? 'is-invalid' : ''; ?>" name="jenis">
                  <option selected disabled value="">-: Pilih Jenis Menu :-</option>
                  <option value="makanan" <?= (old('jenis') == 'makanan') ? "selected" : "" ?> >Makanan</option>
                  <option value="minuman" <?= (old('jenis') == 'minuman') ? "selected" : "" ?> >Minuman</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('jenis'); ?>
                  </div>
              </div>

              <div class="form-group">
                <label>Harga</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      Rp
                    </div>
                  </div>
                  <input type="text" value="<?= old('harga'); ?>" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" name="harga" autocomplete="off">
                  <div class="invalid-feedback">
                    <?= $validation->getError('harga'); ?>
                  </div>
                </div>
              </div>
            
              <div class="form-group">
                <label>Status Menu</label>
                <select class="custom-select <?= ($validation->hasError('status_masakan')) ? 'is-invalid' : ''; ?>" name="status_masakan">
                  <option selected disabled value="">-: Pilih Status Menu :-</option>
                  <option value="tersedia" <?= (old('status_masakan') == 'tersedia') ? "selected" : "" ?>>Tersedia</option>
                  <option value="habis" <?= (old('status_masakan') == 'habis') ? "selected" : "" ?>>Habis</option>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('status_masakan'); ?>
                  </div>
              </div>
              
              
              <!-- <div class="form-group">
                  <div class="section-title">Foto Menu</div>
                  <div class="custom-file">
                      <input type="file" name="gambar" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
              </div> -->

              <div class="form-group">
                      <label>Foto Menu</label>
                      <input type="file" name="gambar" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>">
                      <div class="invalid-feedback">
                        <?= $validation->getError('gambar'); ?>
                       </div>
                  </div>
             

              <button type="submit" name="submit" class="btn btn-simpan btn-success m-t-15 waves-effect">Tambah</button>
              <a href="<?= site_url('/menu'); ?>" class="btn btn-danger m-t-15 waves-effect">Batal</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('footer') ?>
<script src="<?= base_url(); ?>/template/assets/js/upload-img.js"></script>
<?= $this->endSection(); ?>