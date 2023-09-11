<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/dist/css/adminlte.min.css">

    <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/daterangepicker/daterangepicker.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="icon" href="/img/logo.jpeg" sizes="35x35" />
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/summernote/summernote-bs4.min.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?= base_url('AdminLTE');?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('AdminLTE');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url('AdminLTE');?>/plugins/select2/js/select2.full.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('AdminLTE');?>/dist/js/adminlte.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url('AdminLTE');?>/plugins/summernote/summernote-bs4.min.js"></script>
  <style>
    .noneJP{
        display: none;
    }
    .myDiv{
        display:none;
        padding:10px;
    } 

    .ajukanPengunduran:hover{
      color: red;
      text-decoration: none;
    }
    .ajukanPengunduran{
      color: #007bff;
      text-decoration: none;
      background-color: transparent;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini"  data-spy="scroll">
  <div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown list-notifikasi" id="notinumber">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge" ><?= $notif;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="height: 280px; overflow-y: scroll;">
          <span class="dropdown-item dropdown-header">Notifikasi</span>
          <div class="dropdown-divider"></div>
          <?php foreach ($notifikasi as $key => $value) { 
          if (session()->get('level')== 1) { ?>
              <a href="<?php echo base_url('ketua/'.$value['referensi']); ?>" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i><?= $value['judul'];?>
                <p><?= $value['detail'];?></p>
              </a>
          <?php }else if (session()->get('level')==2) { ?>
              <a href="<?php echo base_url('bendahara/'.$value['referensi']) ?>" class="dropdown-item"><i class="fas fa-envelope mr-2"></i> <?= $value['judul'];?>
            <p><?= $value['detail'];?></p></a>
           <?php } else if (session()->get('level')==3){ ?>
              <a href="<?php echo base_url('sekretaris/'.$value['referensi']) ?>" class="dropdown-item"><i class="fas fa-envelope mr-2"></i> <?= $value['judul'];?>
            <p><?= $value['detail'];?></p></a>
           <?php } else{ ?>
              <a href="<?php echo base_url('anggota/'.$value['referensi']) ?>" class="dropdown-item"><i class="fas fa-envelope mr-2"></i> <?= $value['judul'];?>
            <p><?= $value['detail'];?></p></a>
          <?php  } ?>

           <?php } ?>
            <?php if (session()->get('level')== 1) { ?>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('ketua/notifikasi') ?>" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
          <?php }else if (session()->get('level')==2) { ?>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('bendahara/notifikasi') ?>" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
           <?php } else if (session()->get('level')==3){ ?>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('sekretaris/notifikasi') ?>" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
           <?php } else{ ?>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url('anggota/notifikasi') ?>" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
          <?php  } ?>
          
        </div>
      </li>
      <!-- Sidebar user panel (optional) -->
      <li class="nav-item">
        <a class="nav-link">
          <span><b><?= session()->get('nama');?>&nbsp;</b></span>          
          <span><b>
            <?php if (session()->get('level') == 1) {
              echo '| Ketua ';
            }else if (session()->get('level') == 2) {
              echo '| Bendahara';
            }else if (session()->get('level') == 3) {
              echo '| Sekretaris';
            }else{
              echo '| Anggota';
            } ?></b></span>          
        </a>
      </li>
      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown pr-3">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user-circle fa-xl"></i>
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="userDropdown">
              <?php if (session()->get('level') == 1) { ?>
                  <a href="<?php echo base_url();?>petugas/profile" class="dropdown-item">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile 
                  </a>
                <?php }else if (session()->get('level') == 2) { ?>
                  <a href="<?php echo base_url();?>petugas/profile" class="dropdown-item">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile
                  </a>
                <?php }else if (session()->get('level') == 3) { ?>
                  <a href="<?php echo base_url();?>petugas/profile" class="dropdown-item">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Profile
                  </a>
                <?php }else{ ?>
                  <a href="<?php echo base_url();?>anggota/profile" class="dropdown-item">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
              <?php } ?>
              <div class="dropdown-divider"></div>
              <a href="" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
              </a>
          </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->