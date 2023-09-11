<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <i class="fas fa-globe"></i> <?= $judul;?>
            <?= !empty($tanggal) ? '<small style="font-size: 12px;" class="float-right">Filter Tanggal: '.$tanggal.'</small><br>' : '';?>
            <?= !empty($bulan) ? '<small style="font-size: 12px;" class="float-right">Filter Bulan: '.$bulan.'</small><br>' : '';?>
            <?= !empty($tahun) ? '<small style="font-size: 12px;" class="float-right">Filter Tahun: '.$tahun.'</small><br>' : '';?>
            <small style="font-size: 12px;" class="float-right">Dicetak pada tanggal: <?= date('d-m-Y');?></small><br>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table_content table table-sm " id="mauexport">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No Pengajuan</th>
                  <th>No Anggota</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Lama Angsuran</th>
                  <th>Status Pengajuan</th>
                  <th>Jumlah Emas</th>
                  <th>Besar Pinjaman</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($harian as $value) { 
                    $totalpinjaman[] = $value['bsr_pengajuan'];
                    ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $value['id_pengajuan'];?> </td>
                    <td><?= $value['no_anggota'];?> </td>
                    <td><?= $value['tgl_pengajuan'];?> </td>
                    <td><?= $value['lama_angsuran'];?> Bulan</td>
                    <td><?= $value['status_pengajuan'];?> </td>
                    <td><?= $value['jml_emas'];?></td>
                    <td class="text-right">Rp <?= number_format($value['bsr_pengajuan']);?> </td>
                </tr>
                 <?php }; ?>
                <tr>
                    <td class="text-center" colspan="7"><h6>Total</h6></td>
                    <td class="text-right">Rp <?= $harian == null ? '' : number_format(array_sum($totalpinjaman),0);?></td>
                </tr> 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>