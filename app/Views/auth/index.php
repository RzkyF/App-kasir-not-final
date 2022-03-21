<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/app.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/template/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='<?= base_url(); ?>/template/assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="<?= site_url('auth/do_login'); ?>" class="needs-validation" novalidate="">
                <?= csrf_field() ?>
                <?php if (session()->get('error')) :?>
                      <div class="row">
                          <div class="col-md">
                          <div class="alert alert-warning alert-dismissible show fade">
                                        <div class="alert-body">
                                          <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                          </button>
                                          <?= session()->get('error'); ?>
                                          <?php session()->remove('error'); ?>
                                        </div>
                                </div>
                <?php endif; ?>
                  <div class="form-group">
                    <label for="username">username</label>
                    <input id="username" value="<?= old('username') ?>" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Username tidak boleh kosong!
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" min-length="4"  class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Password tidak boleh kosong!
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
            &copy; Copyright 2022 Rizky Fadillah
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="<?= base_url(); ?>/template/assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?= base_url(); ?>/template/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="<?= base_url(); ?>/template/assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>