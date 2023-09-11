<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/dist/css/adminlte.min.css">
  <!-- reCaptcha -->
  <script src="https://www.google.com/recaptcha/api.js?hl=id" async defer></script>
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <nav>
      <div class="nav nav-tabs nav-justified mb-3" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Anggota</button>
        <button class="nav-link " id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Petugas</button>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <div class="card-header text-center">
            <a href="#" class="text-center">
              <img src="/img/logo.jpeg" alt="KOPMENSYAPA logo" class="elevation-1" style="height: 100px;">
            </a>
          </div>
          <div class="card-body">
            <h4 class="text-center pb-2">LOGIN ANGGOTA</h4>
              <?php 
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                if (session()->getFlashdata('gagal')) {
                    echo '<div class="alert alert-danger">';
                    echo session()->getFlashdata('gagal');
                    echo '</div>';
              } ?>

            <form action="<?php echo base_url('auth/cek_login_ang')?>" method="post">
              <div class="input-group mb-3">
                <input type="text" name="email" class="form-control" placeholder="NRP atau Email" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <div class="g-recaptcha" data-sitekey="6LevST4mAAAAAA340-VYD651_UNKsN7QRnfW7NxL"></div>
              </div>
              <div class="row">
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-success btn-block">Log in</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <p class="mb-1">
              <a href="<?= base_url('home');?>" >Kembali ke halaman berita</a>
            </p>
          </div>
          <!-- /.card-body -->
      </div>
      <div class="tab-pane fade " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="card-header text-center">
          <a href="#" class="text-center text-success">
            <img src="/img/logo.jpeg" alt="KOPMENSYAPA logo" class="elevation-1" style="height: 100px;">
          </a>
        </div>
        <div class="card-body">
          <h4 class="text-center pb-2">LOGIN PETUGAS</h4>
            <?php 
              $errors = session()->getFlashdata('errors');
              if (!empty($errors)) { ?>
              <div class="alert alert-danger" role="alert">
                  <ul>
                      <?php foreach($errors as $error) : ?>
                          <li><?= esc($error)?></li>
                      <?php endforeach ?>
                  </ul>
              </div>
            <?php } ?>
            
            <?php 
              if (session()->getFlashdata('pesan')) {
                  echo '<div class="alert alert-success">';
                  echo session()->getFlashdata('pesan');
                  echo '</div>';
              }
              if (session()->getFlashdata('gagal')) {
                echo '<div class="alert alert-danger">';
                echo session()->getFlashdata('gagal');
                echo '</div>';
            } ?>

          <form action="<?=base_url('auth/cek_login_ptg')?>" method="post">
            <div class="input-group mb-3">
              <input type="email" name="username" class="form-control" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <div class="g-recaptcha" data-sitekey="6LevST4mAAAAAA340-VYD651_UNKsN7QRnfW7NxL"></div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-success btn-block">Log in</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <p class="mb-1">
            <a href="<?= base_url('home');?>" >Kembali ke halaman berita</a>
          </p>
        </div>
        <!-- /.card-body -->
      </div>
      
    </div>
    
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('AdminLTE');?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('AdminLTE');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('AdminLTE');?>/dist/js/adminlte.min.js"></script>
</body>
</html>
