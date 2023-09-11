<?= $this->extend('/layout/template-frontend');?>
<?= $this->section('content');?>

    <!--====== EVENTS PART START ======-->

    <section id="event-singel" class="pt-120 pb-120 gray-bg">
        <div class="container col-lg-6">
            <div class="events-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="events-left">
                            <div class="col-sm-12">
                                <h3><?= $post['judul'];?></h3>
                                <span><i class="fa fa-calendar"></i> Posted by <?= $post['nm_petugas'];?> on <?= date('d M Y', strtotime($post['tanggal']) )?></span>
                            </div>
                            <img src="/img/berita/<?= $post['gambar'];?>" alt="Event">
                            <p><?= $post['kontent'];?></p>
                        </div> <!-- events left -->
                    </div>
                </div> <!-- row -->
            </div> <!-- events-area -->
        </div> <!-- container -->
    </section>

    <!--====== EVENTS PART ENDS ======-->
<?= $this->endsection('content');?>
