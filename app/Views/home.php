<?= $this->extend('/layout/template-frontend');?>
<?= $this->section('content');?>
<!--====== SLIDER PART START ======-->

<section id="slider-part" class="slider-active">
    <div class="single-slider bg_cover pt-150" style="background-image: url(<?php echo base_url("img/".$profilkop['gambar_highlight1']) ?>)" data-overlay="4">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-9">
                    <div class="slider-cont">
                        <h1 data-animation="bounceInLeft" data-delay="1s"></h1>
                        <p data-animation="fadeInUp" data-delay="1.3s"></p>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- single slider -->
    
    <div class="single-slider bg_cover pt-150" style="background-image: url(<?php echo base_url("img/".$profilkop['gambar_highlight2']) ?>)" data-overlay="4">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-9">
                    <div class="slider-cont">
                        <h1 data-animation="bounceInLeft" data-delay="1s"></h1>
                        <p data-animation="fadeInUp" data-delay="1.3s"></p>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- single slider -->
</section>

<!--====== SLIDER PART ENDS ======-->

<!--====== COURSES PART START ======-->

<section id="courses-part" class="pt-120 pb-120 gray-bg">
    <div class="container">
       <!-- row -->
        <div class="tab-content" id="myTabContent">
          	<div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                <div class="row">
                	<div class="col-lg-12 text-center">
                		<h3>BERITA</h3>
                	</div>

                	<?php foreach ($beritaBaru as $key => $bb) { ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="singel-course mt-30">
                            <div class="thum">
                                <div class="image">
                                    <img src="/img/berita/<?= $bb['gambar'];?>" alt="Course">
                                </div>
                            </div>
                            <div class="cont">
                                <a href="/home/berita_single/<?= $bb['slug']; ?>"><h4><?= $bb['judul'];?></h4></a>
                                <div class="course-teacher">
                                    <div class="name">
                                        <a href="#"><h6><?= $bb['nm_petugas'];?></h6></a>
                                    </div>
                                    <div style="float: right;">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-calendar"></i><span>&nbsp;<?= date('d M Y', strtotime($bb['tanggal']) )?></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- singel course -->
                    </div>
                	<?php } ?>
                </div> <!-- row -->
            </div>
        </div> 
    </div> <!-- container -->
</section>

<!--====== COURSES PART ENDS ======-->

<?= $this->endsection('content');?>