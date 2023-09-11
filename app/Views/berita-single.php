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
   
    <!--====== EVENTS PART START ======-->

    <section id="blog-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="events-area">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="events-left">
                            <div class="col-sm-12">
                                <h3><?= $post['judul'];?></h3>
                                <span><i class="fa fa-calendar"></i> Posted by <?= $post['nm_petugas'];?> on <?= date('d M Y', strtotime($post['tanggal']) )?></span>
                            </div>
                            <img src="/img/berita/<?= $post['gambar'];?>" alt="Event">
                            <p><?= $post['kontent'];?></p>
                        </div> <!-- events left -->
                    </div>
<!-- 
                    <div class="col-lg-4">
                       <div class="saidbar">
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
                                               </div>  singel post 
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
                                               </div> singel post 
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
                       
                       </div>  saidbar 
                    </div>
                     -->
                </div> <!-- row -->
                
            </div>
        </div> <!-- container -->
    </section>

    <!--====== EVENTS PART ENDS ======-->
<?= $this->endsection('content');?>
