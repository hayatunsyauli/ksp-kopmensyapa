<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
            <table class="table_header table-sm" style="font-family: Arial, Helvetica, sans-serif;width: 100%;">
                <tr>
                    <th style="width:40%">Kode Pinjaman</th>
                    <th>:</th>
                    <td style="width:70%"><?= $pengajuan['id_pinjaman'];?></td>
                </tr>
                <tr>
                    <th>No Anggota</th>
                    <th>:</th>
                    <td><?= $pengajuan['no_anggota'];?></td>
                </tr>
                <tr>
                    <th>Nama Anggota</th>
                    <th>:</th>
                    <td><?= $pengajuan['nama'];?></td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan / Jatuh Tempo</th>
                    <th>:</th>
                    <td><?= date('d-m-Y', strtotime($pengajuan['tgl_pengajuan']));?> / <?= date('d-m-Y', strtotime($pengajuan['tgl_jth_tempo']));?></td>
                </tr>
                <tr>
                    <th>Jenis Pinjaman</th>
                    <th>:</th>
                    <td><?php 
                    if ($pengajuan['id_jenis_pinjaman'] == 1) {
                         echo 'Pinjaman Jangka Pendek';
                     }else if ($pengajuan['id_jenis_pinjaman'] == 2) {
                        echo 'Pinjaman Jangka Panjang';
                     } else{
                         echo 'Pinjaman BKD';
                     } ?>
                    </td>
                </tr>
                <tr>
                    <th>Besar Pinjaman</th>
                    <th>:</th>
                    <td>Rp <?= number_format($pengajuan['bsr_pengajuan']);?></td>
                </tr>
                <tr>
                    <th>Lama Angsuran</th>
                    <th>:</th>
                    <td><?= $pengajuan['lama_angsuran'];?> (Bulan)</td>
                </tr>
                <tr>
                    <th>Jasa 3%,7%</th>
                    <th>:</th>
                    <td>Rp. <?= number_format($pengajuan['jasa']);?></td>
                </tr>
                <tr>
                    <?php 
                    $byrAns = $pengajuan['jml_angsuran'] / $pengajuan['lama_angsuran'];
                    $totalAsr = $pengajuan['bsr_pengajuan'] + $pengajuan['jasa'];
                     ?>
                    <th>Besar Angsuran</th>
                    <th>:</th>
                    <td>Rp. <?= number_format($totalAsr);?></td>
                </tr>
                <tr>
                    <th>Jumlah Bayar Angsuran/Bulan</th>
                    <th>:</th>
                    <td>Rp. <?= number_format($byrAns);?></td>
                </tr>           
            </table>
      </div>
  </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Detail Angsuran Pinjaman</h3>

            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <ul>
             <?php
            if ($status['status_pinjaman'] == 'Lunas') {?>
                <li>Status Pinjaman <b>Sudah Lunas</b></li>
            <?php }else{?>
                <li>Status Pinjaman <b>Belum Lunas!</b> </li>
            <?php }?>
            </ul>

            <table class="table_pinjaman table table-sm" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Angsuran</th>
                        <th>Kode Pinjaman</th>
                        <th>ID Petugas</th>
                        <th>Tanggal Angsuran</th>
                        <th>Jumlah Angsuran</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($angsuran as $key => $value) {
                     ?>
                    <tr>
                        <td><?= $no++;?></td>
                        <td><?= $value['id_angsuran'];?></td>
                        <td><?= $value['id_pinjaman'];?></td>
                        <td><?= $value['id_petugas'];?></td>
                        <td><?= date('d-m-Y',strtotime($value['tgl_angsuran']));?></td>
                        <td class="text-right">Rp. <?= number_format($value['angsuran_pembayaran']);?></td>
                        <td><?= $value['ket'];?></td>
                    </tr>
                   <?php  } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
    <hr>

    <table class="table-borderless" style="margin-top: 30px;">
        <tbody style="">
            <tr>
                <td style=" text-align: right; width: 55%;">Banda Aceh, <?= tanggal() ?></td>

                <td style=" text-align: right; width: 45%; ">Banda Aceh, <?= tanggal() ?></td>
                <!-- <td></td> -->
            </tr>
            <tr style="background-color: #fff;  ">
                <td style="text-align: right;">
                    Anggota
                </td>
                <td style="text-align: right;">
                    Bendahara
                </td>
                <!-- <td></td> -->
            </tr>
            <tr>
                <td style="height: 40px;"></td>
                <td style="text-align: right;">
                    <!-- <img src=" < ?= base_url() ?>assets//stempel.png" width="20%"> -->
                </td>
                <td style="text-align: right; ">
                    <!-- <img src=" < ?= base_url() ?>assets//stempel.png" width="20%"> -->
                </td>
                <!-- <td></td> -->
            </tr>
            <tr style="background-color: #fff;  ">
                <td style="text-align: right;">
                    <?= $pengajuan['nama'];?></td>
                <td style="text-align: right; ">
                    <?= session()->get('nama');?></td>
                <!-- <td></td> -->
            </tr>
        </tbody>
    </table>
