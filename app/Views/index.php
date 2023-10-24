<div class="container-fluid">
  <?php 
    if (!empty($dtpetugas['password'])){
      if ($dtpetugas['password'] == htmlspecialchars(md5(session()->get('id_petugas')))) { ?>
        <div class="alert alert-danger" role="alert">
            Password Anda Belum Di Update. <a href="<?php echo base_url() ?>petugas/profile"><b>Klik untuk update password</b></a>
        </div>
        
      <?php
    }
       } else {

      };
  ?>
</div>
<div class="col-lg-4 col-6">
<!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h5>Anggota</h5>
        <p>
        Aktif : <?= $jumlahAnggotaAktif;?><br>
        Tidak Aktif : <?= $jumlahAnggota;?><br><br>
        </p>
        <hr>
        <a href="#myModal" data-target="#myModal" data-toggle="modal" style="color: white;"><h5>Anggota Aktif : <?= $jumlahAnggotaAktif;?></h3></a>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
    </div>
</div>
<div class="col-lg-4 col-6">
<!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <?php 
          if ($jumlahPinjaman == null) {
              $ttlPinjaman[] = 0;
          }else{
              foreach ($jumlahPinjaman as $key => $value) {
                  $ttlPinjaman[] = $value['jml_angsuran']; 
              }
          } 
          if ($jumlahPinjamanPj == null) {
              $ttlPinjamanPj[] = 0;
          }else{
              foreach ($jumlahPinjamanPj as $key => $value) {
                $ttlPinjamanPj[] = $value['jml_angsuran'];
              }
          } 
          if ($jumlahPinjamanPd == null) {
              $ttlPinjamanPd[] = 0;
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
        <?= $pinjamanPj['jenis_pinjaman'];?> : Rp <?= $jumlahPinjamanPj == null ? '0' : number_format(array_sum($ttlPinjamanPj),0);?><br>
        <?= $pinjamanPd['jenis_pinjaman'];?> : Rp <?= $jumlahPinjamanPd == null ? '0' : number_format(array_sum($ttlPinjamanPd),0);?><br>
        <?= $pinjamanBkd['jenis_pinjaman'];?> : Rp <?= $jumlahPinjamanBkd == null ? '0' : number_format(array_sum($ttlPinjamanBkd),0);?>
        
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
    Smp. Pokok : Rp <?= $ttlSimpananP == null ? '0' : number_format(array_sum($ttlSimpananP),0);?><br>
    Smp. Wajib : Rp <?= $ttlSimpananW == null ? '0' : number_format(array_sum($ttlSimpananW),0);?><br>
    Smp. Sukarela : Rp <?= $ttlSimpananS == null ? '0' : number_format(array_sum($ttlSimpananS),0);?>
    
    <hr>
    <h5>Total : Rp <?= $jumlahSimpanan == null ? '0' : number_format($totalSimpanan,0);?></h3>
  </div>
  <div class="icon">
    <i class="fas fa-wallet"></i>
  </div>
</div>
</div>
<!-- ./col -->
<div class="col-lg-6 col-6">
<!-- small box -->
<div class="small-box bg-secondary">
  <div class="inner">
    <?php 
    if ($jumlahKas == null) {
          $debet[] = 0;
          $credit[] = 0;
      }else{
          foreach ($jumlahKas as $key => $value) {
          $ttlkasD[] = $value['kas_debit']; 
          $ttlkasK[] = $value['kas_credit']; 
          $totalKas = array_sum($ttlkasD) - array_sum($ttlkasK);
        }
      }
     ?>
    <h5>Kas</h5>
    Kas Debet : Rp <?= $ttlSimpananP == null ? '0' : number_format(array_sum($ttlkasD),0);?><br>
    Kas Kredit : Rp <?= $ttlSimpananW == null ? '0' : number_format(array_sum($ttlkasK),0);?><br> <br>    
    <hr>
    <h5>Total Kas : Rp <?= $jumlahSimpanan == null ? '0' : number_format($totalKas,0);?></h3>
  </div>
  <div class="icon">
    <i class="fas fa-coins"></i>
  </div>
</div>
</div>
<!-- ./col -->
<div class="col-lg-6 col-6">
  <!-- small box -->
  <div class="small-box bg-danger">
    <div class="inner">
      <?php 
        if ($jumlahPengajuan == null && $jumlahPengajuanDitolak == null) {
            $ttlPengajuan[] = 0;
            $ttlPengajuanDitolak[] = 0;
        }else{
            foreach ($jumlahPengajuan as $key => $value) {
            $ttlPengajuan[] = $value['bsr_pengajuan']; 
            // $;
          }
           foreach ($jumlahPengajuanDitolak as $key => $val) {
            $ttlPengajuanDitolak[] = $val['bsr_pengajuan']; 
            // $totalPengajuanDitolak = array_sum($ttlPengajuan);
          }
        }

      $total = array_sum($ttlPengajuan) + array_sum($ttlPengajuanDitolak);
      ?>
      <h5>Pengajuan</h5>
      Diterima : Rp <?= $jumlahPengajuan == null ? '0' : number_format(array_sum($ttlPengajuan));?><br>
      Ditolak : Rp <?= $jumlahPengajuanDitolak == null ? '0' : number_format(floatval(array_sum($ttlPengajuanDitolak)));?><br><br>
      <hr>
      <h5>Total Pengajuan : Rp <?= $total == null ? '0' : number_format($total,0);?></h3>
    </div>
    <div class="icon">
      <i class="fas fa-hand-holding-usd"></i>
    </div>
  </div>
</div>

<!-- Modal code account-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Data Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <table class="table p-0 table-hover table-striped table-bordered" id="example2">
            <thead>
              <tr>
                  <th>No</th>
                  <th>No Anggota</th>
                  <th>NRP</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>Status Anggota</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($anggota as $ang) : ?>
              <tr>
                 <td><?= $no++;?></td>
                  <td><?= $ang['no_anggota'];?></td>
                  <td><?= $ang['nrp'];?></td>
                  <td><?= $ang['nama'];?></td>
                  <td><?= $ang['alamat'];?></td>
                  <td><?= $ang['email'];?></td>
                  <td class="text-center">
                      <?php
                      if ($ang['status_anggota'] == "Aktif") {
                      ?>
                          <a href="<?= base_url() ?>petugas/verifikasiAnggota/<?= $ang['no_anggota'] ?>" class="badge badge-success">Aktif</a>
                      <?php
                      } else{ ?>
                          <span class="badge badge-danger">Tidak Aktif</span>
                      <?php 
                      }
                      ?>
                  </td>
              </tr>
            <?php endforeach; ?>
              
            </tbody>
          </table>
        </div>
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


    <?php 
/*
  $myArray = [
    ["id" => 1, "value" => 5],
    ["id" => 2, "value" => 10],
    ["id" => 1, "value" => 7],
    ["id" => 3, "value" => 3],
    ["id" => 4, "value" => 0],
    ["id" => 5, "value" => 0],
    ["id" => 5, "value" => 4],
    // tambahkan data lainnya di sini...
  ];

  $idTotals = [];

  foreach ($myArray as $item) {
      $id = $item["id"];
      $value = $item["value"];

      if (!isset($idTotals[$id])) {
          $idTotals[$id] = 0;
      }

      $idTotals[$id] += $value;
  }

  // Menampilkan total berdasarkan ID
  foreach ($idTotals as $id => $total) {
      echo "ID: $id, Total: $total\n <br>";
  }
*/
/*
  $idArray = [1, 2, 3];
  $valueArray = [5, null, 3];

  $idTotals = [];

  for ($i = 0; $i < count($idArray); $i++) {
      $id = $idArray[$i];
      $value = $valueArray[$i] ?? 0; // Menggunakan nilai default 0 jika $valueArray kosong atau null

      if (!isset($idTotals[$id])) {
          $idTotals[$id] = 0;
      }

      $idTotals[$id] += $value;
  }


  // Menampilkan total berdasarkan ID
  foreach ($idTotals as $id => $total) {
      echo "ID: $id, Total: $total\n <br>";
  }
*/
 ?>