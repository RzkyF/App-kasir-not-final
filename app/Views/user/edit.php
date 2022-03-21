<?= $this->extend('layout/default') ?>

<?= $this->section('css') ?>
  <!-- Data table Css -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashData('success')) :?>
  
<?php endif; ?>
<section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <h3>Edit User <a href="<?= site_url('/user'); ?>"></a></h3> 
                    <hr>
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= site_url('home'); ?>"><i class="fas fa-tachometer-alt"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('/user'); ?>"><i class="fas fa-list"></i> Data User </a></li>
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user"></i>Tambah User</li>
                    </ol>
                    </nav>
                  </div>
              <div class="card-body"> 
                <form method="POST" class="formuser" action="<?= site_url('user/update/'.$user->id_user) ?>" onsubmit="return checkForm(this);" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <?php if (session()->get('error')) : ?>
                                  <div class="row">
                                    <div class="col-md">
                                    <div class="alert alert-danger alert-dismissible show fade">
                                                  <div class="alert-body">
                                                    <button class="close" data-dismiss="alert">
                                                      <span>&times;</span>
                                                    </button>
                                                    <?= session()->get('error'); ?>
                                                    <?php session()->remove('error'); ?>
                                                  </div>
                                                </div>
                                          </div>
                                      </div>
                                <?php endif; ?>
                                <input type="hidden" value="<?= $user->gambar ?>" name="gambarOld">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-user"></i>
                                        </div>
                                      </div>
                                      <input type="text" value="<?= (old('nama')) ? old('nama') : $user->nama ; ?>" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama" name="nama" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('nama'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Username</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend"><div class="flash-data" data-flashdata="<?= session()->get('error'); ?>"></div>
                                        <div class="input-group-text">
                                          <i class="fas fa-user"></i>
                                        </div>
                                      </div>
                                      <input type="text" value="<?= (old('username')) ? old('username') : $user->username ; ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder="Username" name="username" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('username'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Password Lama</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-lock"></i>
                                        </div>
                                      </div>
                                      <input type="password" value="<?= (old('oldpass')) ? old('oldpass') : '' ; ?>" class="form-control <?= ($validation->hasError('oldpass')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan password lama.." name="oldpass">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('oldpass'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Password Baru</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-lock"></i>
                                        </div>
                                      </div>
                                      <input type="password" class="form-control <?= ($validation->hasError('newpass')) ? 'is-invalid' : ''; ?>" placeholder="Password" name="newpass">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('newpass'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Password Baru</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-lock"></i>
                                        </div>
                                      </div>
                                      <input type="password" class="form-control <?= ($validation->hasError('confirmpass')) ? 'is-invalid' : ''; ?>" placeholder="Password" name="confirmpass">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('confirmpass'); ?>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="gambar" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>">
                                  <div class="invalid-feedback">
                                      <?= $validation->getError('gambar'); ?>
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label>Role</label>
                                    <select class="custom-select <?= ($validation->hasError('id_level')) ? 'is-invalid' : ''; ?>" name="id_level">
                                      <option selected disabled >-: Pilih Role :-</option>
                                      <option value="1" <?= ($user->id_level == 1) ? 'selected' : ''; ?>>Admin</option>
                                      <option value="2" <?= ($user->id_level == 2) ? 'selected' : ''; ?>>Kasir</option>
                                      <option value="3" <?= ($user->id_level == 3) ? 'selected' : ''; ?>>Manajer</option>
                                    </select>
                                  </div>
                                  <button type="submit" name="submit" class="btn btn-simpan btn-success m-t-15 waves-effect">edit</button>
                                  <a href="<?= site_url('/user'); ?>" class="btn btn-danger m-t-15 waves-effect">Batal</a>
                                </form>
                    </div>
                </div>
              </div>
            </div>
          </div>  
        </section>

<?= $this->endSection(); ?>
