<?= $this->extend('layout/default') ?>

<?= $this->section('css') ?>

<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<section class="section">
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>Tambah Order <a href="<?= site_url('/order'); ?>"></a></h3>
            <hr>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('home'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('/order'); ?>"><i class="fas fa-list"></i> Data order </a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-utensils"></i>Tambah order</li>
              </ol>
            </nav>
          </div>
          <div class="card-body">
            <form method="POST" class="formorder" action="<?= site_url('/order') ?>" onsubmit="return checkForm(this);">
              <?= csrf_field(); ?>
              <?php $user =  userLogin()->id_user ?>

            
              <input type="hidden" value="<?= $user ?>" name="id_user">
              <div class="form-group">
                <label>No Meja</label>
                <div class="input-group">
                 <input type="text" placeholder="Masukkan nomer meja" name="no_meja" class="form-control <?= ($validation->hasError('no_meja')) ? 'is-invalid' : ''; ?>" value="<?= old('no_meja'); ?>"  cols="30" rows="10">
                  <div class="invalid-feedback">
                    <?= $validation->getError('no_meja'); ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Nama Pelanggan</label>
                <div class="input-group">
                 <input type="text" placeholder="Masukkan nama pelanggan" name="nama_pelanggan" class="form-control <?= ($validation->hasError('nama_pelanggan')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_pelanggan'); ?>"  cols="30" rows="10">
                  <div class="invalid-feedback">
                    <?= $validation->getError('nama_pelanggan'); ?>
                  </div>
                </div>
              </div>
              
              <button type="submit" name="submit" class="btn btn-simpan btn-success m-t-15 waves-effect">Tambah</button>
              <a href="<?= site_url('/order'); ?>" class="btn btn-danger m-t-15 waves-effect">Batal</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('footer') ?>
<?= $this->endSection(); ?>