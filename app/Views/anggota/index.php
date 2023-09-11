<div class="container-fluid">
    <?php 
        if ($anggota['status_anggota'] == 'Tidak Aktif' ) { ?>
        <div class="alert alert-danger" role="alert">
            Status keanggotaan Sudah <b>Dinonaktifkan</b>
        </div>
    <?php } else if($anggota['password'] == htmlspecialchars(md5(session()->get('no_anggota')))){ ?>
       <div class="alert alert-danger" role="alert">
        Password Anda Belum Di Update. <a href="<?php echo base_url() ?>anggota/profile"><b>Klik untuk update password</b></a>
        </div>
    <?php }else{ ?>
      <div class="alert alert-info" role="alert">
        Selamat Datang <?= session()->get('nama');?>
      </div>
   <?php  } ?>
</div>
<div class="col-lg-4 col-6">
<!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <?php 
          if ($jumlahPinjaman == null) {
              $ttlPinjamanBkd[] = 0;
          }else{
              foreach ($jumlahPinjaman as $key => $value) {
                  $ttlPinjaman[] = $value['jml_angsuran']; 
              }
          } 
          if ($jumlahPinjamanPj == null) {
              $ttlPinjamanBkd[] = 0;
          }else{
              foreach ($jumlahPinjamanPj as $key => $value) {
                $ttlPinjamanPj[] = $value['jml_angsuran'];
              }
          } 
          if ($jumlahPinjamanPd == null) {
              $ttlPinjamanBkd[] = 0;
          }else{
              foreach ($jumlahPinjamanPd as $key => $value) {
                $ttlPinjamanPd[] = $value['jml_angsuran']; 
              }
          } 
          if ($jumlahPinjamanBkd == null) {
              $ttlPinjamanBkd[] = 0;
          }else{
              foreach ($jumlahPinjamanBkd as $key => $value) {
                $ttlPinjamanBkd[] = $value['jml_angsuran']; 
              }
          }
         ?>
        <h5>Pinjaman</h5>
        Pjm. Jangka Panjang : Rp <?= $jumlahPinjamanPj == null ? '0' : number_format(array_sum($ttlPinjamanPj),0);?><br>
        Pjm. Jangka Pendek : Rp <?= $jumlahPinjamanPd == null ? '0' : number_format(array_sum($ttlPinjamanPd),0);?><br>
        Pjm. BKD : Rp <?= $jumlahPinjamanBkd == null ? '0' : number_format(array_sum($ttlPinjamanBkd),0);?>
        
        <hr>
        <h5>Total : Rp <?= $jumlahPinjaman == null ? '0' : number_format(array_sum($ttlPinjaman),0);?></h3>
      </div>
      <div class="icon">
        <i class="fas fa-fas fa-money-bill-wave"></i>
      </div>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box bg-warning">
    <div class="inner">
      <?php 
          if ($jumlahSimpanan == null) {
            $ttlSimpananP[] = 0;
            $ttlSimpananW[] = 0;
            $ttlSimpananS[] = 0;
        }else{
            foreach ($jumlahSimpanan as $key => $value) {
            $ttlSimpananP[] = $value['simpanan_pokok']; 
            $ttlSimpananW[] = $value['simpanan_wajib']; 
            $ttlSimpananS[] = $value['simpanan_sukarela']; 
            $totalSimpanan = array_sum($ttlSimpananP) + array_sum($ttlSimpananW) + array_sum($ttlSimpananS);
          }
        }
        ?>
        <h5>Simpanan</h5>
        Simpanan Pokok : Rp <?= $ttlSimpananP == null ? '0' : number_format(array_sum($ttlSimpananP),0);?><br>
        Simpanan Wajib : Rp <?= $ttlSimpananW == null ? '0' : number_format(array_sum($ttlSimpananW),0);?><br>
        Simpanan Sukarela : Rp <?= $ttlSimpananS == null ? '0' : number_format(array_sum($ttlSimpananS),0);?>
        
        <hr>
        <h5>Total : Rp <?= $jumlahSimpanan == null ? '0' : number_format($totalSimpanan,0);?></h3>
    </div>
    <div class="icon">
      <i class="fas fa-wallet"></i>
    </div>
  </div>
</div>
<!-- ./col -->
<div class="col-lg-4 col-6">
  <!-- small box -->
  <div class="small-box bg-info">
    <div class="inner">
      <?php 
          if ($jumlahPengajuan == null) {
            $ttlPengajuan[] = 0;
        }else{
            foreach ($jumlahPengajuan as $key => $value) {
            $ttlPengajuan[] = $value['bsr_pengajuan']; 
            $totalPengajuan = array_sum($ttlPengajuan);
          }
        }
        ?>
        <h5>Pengajuan</h5>
        <br><br><br>
        <hr>
        <h5>Total Pengajuan : Rp <?= $jumlahPengajuan == null ? '0' : number_format($totalPengajuan,0);?></h3>
    </div>
    <div class="icon">
      <i class="fas fa-hand-holding-usd"></i>
    </div>
  </div>
</div>

 <div class="col-md-6">
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-bullhorn"></i>
        Informasi
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="height: 250px; overflow-y: scroll;">
        <?php  foreach ($allNotifikasi as $s) { ?>
      <div class="callout callout-danger">
          <small><?= $s['created_at'];?></small><br>
          <h5><?= $s['judul'];?></h5>
          <p><?= $s['detail'];?></p>
      </div>
        <?php }; ?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.col -->



