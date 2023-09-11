<?= $this->extend('/layout/template-frontend');?>
<?= $this->section('content');?>
<!--====== PAGE BANNER PART START ======-->

<section  class="pt-105 pb-110" style="background-color: #285430 !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-banner-cont">
                    <h2>Berita</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home');?>">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Berita</li>
                        </ol>
                    </nav>
                </div>  <!-- page banner cont -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== PAGE BANNER PART ENDS ======-->

<!--====== BLOG PART START ======-->

<section id="blog-page" class="pt-90 pb-120 gray-bg">
    <div class="container">
       <div class="row">
           <div class="col-lg-8">
               <?php foreach ($beritaBaru as $key => $bb) { ?>
               
               <div class="singel-blog mt-30">
                   <div class="blog-thum">
                       <img src="/img/berita/<?= $bb['gambar'];?>" height="300px" alt="Blog">
                   </div>
                   <div class="blog-cont">
                       <a href="/home/berita_single/<?= $bb['slug']; ?>"><h3><?= $bb['judul'];?></h3></a>
                       <ul>
                           <li><a href="#"><i class="fa fa-calendar"></i>&nbsp;<?= date('d M Y', strtotime($bb['tanggal']) )?></a></li>
                           <li><a href="#"><i class="fa fa-user"></i><?= $bb['nm_petugas'];?></a></li>
                       </ul>
                       <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                   </div>
               </div> <!-- singel blog -->
               <?php } ?>

               <nav class="courses-pagination mt-50">
                    <ul class="pagination justify-content-lg-end justify-content-center">
                        <li class="page-item">
                            <a href="#" aria-label="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="page-item"><a class="active" href="#">1</a></li>
                        <li class="page-item"><a href="#">2</a></li>
                        <li class="page-item"><a href="#">3</a></li>
                        <li class="page-item">
                            <a href="#" aria-label="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>  <!-- courses pagination -->
           </div>
<!-- 
           <div class="col-lg-4">
               <div class="saidbar">
                   <div class="row">
                       <div class="col-lg-12 col-md-6">
                           <div class="saidbar-post mt-30">
                               <h4>Popular Posts</h4>
                               <ul>
                                   <li>
                                        <a href="#">
                                            <div class="singel-post">
                                               <div class="thum">
                                                   <img src="images/blog/blog-post/bp-1.jpg" alt="Blog">
                                               </div>
                                               <div class="cont">
                                                   <h6>Introduction to languages</h6>
                                                   <span>20 Dec 2018</span>
                                               </div>
                                           </div> singel post 
                                        </a>
                                   </li>
                                   <li>
                                        <a href="#">
                                            <div class="singel-post">
                                               <div class="thum">
                                                   <img src="images/blog/blog-post/bp-2.jpg" alt="Blog">
                                               </div>
                                               <div class="cont">
                                                   <h6>How to build a game with java</h6>
                                                   <span>10 Dec 2018</span>
                                               </div>
                                           </div>  singel post 
                                        </a>
                                   </li>
                                   <li>
                                        <a href="#">
                                            <div class="singel-post">
                                               <div class="thum">
                                                   <img src="images/blog/blog-post/bp-1.jpg" alt="Blog">
                                               </div>
                                               <div class="cont">
                                                   <h6>Basic accounting from primary</h6>
                                                   <span>07 Dec 2018</span>
                                               </div>
                                           </div> singel post 
                                        </a>
                                   </li>
                               </ul>
                           </div> saidbar post 
                       </div>
                   </div> row 
               </div>  saidbar 
           </div>
            -->
       </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== BLOG PART ENDS ======-->

<?= $this->endsection('content');?>
