<?= $this->extend('layout/default') ?>


<?= $this->section('content') ?>

<section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  <h3>Tambah User <a href="<?= site_url('/user'); ?>"></a></h3> 
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
                  <form method="POST" class="formuser" action="<?= site_url('user') ?>" onsubmit="return checkForm(this);"  enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-user"></i>
                                        </div>
                                      </div>
                                      <input type="text" value="<?= old('nama'); ?>" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" placeholder="Nama" name="nama" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('nama'); ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label>Username</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-user"></i>
                                        </div>
                                      </div>
                                      <input type="text" value="<?= old('username'); ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" placeholder="Username" name="username" autocomplete="off">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('username'); ?>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <i class="fas fa-lock"></i>
                                        </div>
                                      </div>
                                      <input type="password" value="<?= old('password'); ?>" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" placeholder="Password" name="password">
                                      <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                      </div>
                                    </div>
                                  </div>
                               </div>
                               <div class="col-sm-6">
                                  <div class="form-group">
                                  <label>Konfirmasi Password</label>
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
                                    <label for="id_level" class="form-label">Role</label>
                                    <select class="custom-select" name="id_level" id="id_level" required>
                                    <option selected disabled value="">-: Pilih Role :-</option>
                                      <option value="1">Admin</option>
                                      <option value="2">Kasir</option>
                                      <option value="3">Manajer</option>
                                    </select>
                                    <div class="invalid-feedback">
                                       <?= $validation->getError('id_level'); ?>
                                    </div>
                                  </div>

                                  <button type="submit" name="submit" class="btn btn-simpan btn-success m-t-15 waves-effect">Tambah</button>
                                  <a href="<?= site_url('/user'); ?>" class="btn btn-danger m-t-15 waves-effect">Batal</a>
                                </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>  
            </section>

<?= $this->endSection(); ?>

