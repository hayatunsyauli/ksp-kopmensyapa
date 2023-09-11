
<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title><?= $title ;?></title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/slick.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/animate.css">
    
    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/nice-select.css">
    
    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/jquery.nice-number.min.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/magnific-popup.css">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/bootstrap.min.css">
    
    <!--====== Fontawesome css ======-->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/fontawesome-free/css/all.min.css">
    <!-- <link rel="stylesheet" href="<?= base_url();?>/vendor/fontawesome-free/css/all.min.css"> -->
    
    <!--====== Default css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/default.css">
    
    <!--====== Style css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/style.css">
    
    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="<?= base_url();?>/css-berita/responsive.css">

    <link rel="icon" href="<?php echo base_url('/img/'.$profilkop['logo_kop']) ?>" sizes="35x35" />

  <style>
      ul.kontak{
        color: #FFFFFF !important;
      }
      .kontak{
        color: #FFFFFF !important;
      }
  </style>

</head>

<body>    
    <!--====== HEADER PART START ======-->

	<header id="header-part">        
        <div class="header-logo-support pt-10 pb-10">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="logo">
                            <a href="<?= base_url();?>">
                                <img src="<?= base_url('/img/'.$profilkop['logo_brand']);?>" width="130" alt="Logo">
                            </a>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header logo support -->
        
        <div class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                       <a href="<?php echo base_url() ?>" class="<?= $menu == 'home' ? 'active' : '';?>">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                    	<a href="<?php echo base_url('home/berita');?>" class="<?= $menu == 'berita' ? 'active' : '';?>">Berita</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('auth/login');?>">Login</a>
                                    </li>
                                </ul>
                            </div>
                        </nav> <!-- nav -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div>
        
    </header>

    <!--====== HEADER PART ENDS ======-->

    
    <!--====== CONTENT PART START ======-->
        <?= $this->renderSection('content');?>
    <!--====== CONTENT PART ENDS ======-->
    

    <!--====== FOOTER PART START ======-->

    <footer id="footer-part page-banner" style="background-color: #285430 !important;">
        <div class="pt-10 pb-25">
            <div class="container" >
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright text-md-left text-center pt-15">
                            <a href="<?php echo base_url() ?>" target="_blank">
                            <img src="<?php echo base_url("img/".$profilkop['logo_footer']) ?>" alt="logo" width="300px"/>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="copyright text-md-right text-center pt-15">
                            <h6 class="fw-title kontak"><?php echo $profilkop['nama_kop'] ?></h6>
                            <ul class="kontak">
                                <li><i class="fa fa-map-marker"></i>&nbsp;<?php echo $profilkop['alamat_kop'] ?></li>
                                <li><a href="mailto:<?php echo $profilkop['email_kop'] ?>" style="color: white;"> <i class="fa fa-envelope"></i>&nbsp;<?php echo $profilkop['email_kop'] ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer copyright -->
        <hr style="color:white;height:2px; background-color: white;">
        <div class="copyright">
            <div class="container text-center pb-2">
                <p class="kontak">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    <a href="<?php echo base_url() ?>" style="color: white;" target="_blank"><?php echo $profilkop['nama_kop'] ?></a>
                </p>
            </div>      
        </div>
    </footer>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TO TP PART START ======-->
    
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    
    <!--====== BACK TO TP PART ENDS ======-->
    
    <!--====== jquery js ======-->
    <script src="<?= base_url();?>/js-berita/vendor/modernizr-3.6.0.min.js"></script>
    <script src="<?= base_url();?>/js-berita/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="<?= base_url();?>/js-berita/bootstrap.min.js"></script>
    
    <!--====== Slick js ======-->
    <script src="<?= base_url();?>/js-berita/slick.min.js"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="<?= base_url();?>/js-berita/jquery.magnific-popup.min.js"></script>
    
    <!--====== Counter Up js ======-->
    <script src="<?= base_url();?>/js-berita/waypoints.min.js"></script>
    <script src="<?= base_url();?>/js-berita/jquery.counterup.min.js"></script>
    
    <!--====== Nice Select js ======-->
    <script src="<?= base_url();?>/js-berita/jquery.nice-select.min.js"></script>
    
    <!--====== Nice Number js ======-->
    <script src="<?= base_url();?>/js-berita/jquery.nice-number.min.js"></script>
    
    <!--====== Count Down js ======-->
    <script src="<?= base_url();?>/js-berita/jquery.countdown.min.js"></script>
    
    <!--====== Validator js ======-->
    <script src="<?= base_url();?>/js-berita/validator.min.js"></script>
    
    <!--====== Ajax Contact js ======-->
    <script src="<?= base_url();?>/js-berita/ajax-contact.js"></script>
    
    <!--====== Main js ======-->
    <script src="<?= base_url();?>/js-berita/main.js"></script>
    
</body>

</html>
