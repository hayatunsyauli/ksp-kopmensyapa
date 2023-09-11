<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>
        <!-- /.card-tools -->
        <div class="card-tools">
            <a href="<?= base_url('anggota/pengajuanSaya'); ?>" class="btn btn-info btn-sm">Kembali</a>
            <a href="<?= base_url('anggota/cetakPinjamanAnggota/').$pengajuan['id_pinjaman'];?>" target="_blank" class="btn btn-sm btn-warning" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i> Cetak</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
                <?= csrf_field();?>
                <div class="form-group row">
                    
                        <!-- <input type="hidden" name="id_simpanan" class="form-control" value="" required readonly> -->
                        <div class="mb-3 col-sm-6">
                            <label>No Anggota</label>
                             <input type="text" name="no_anggota" class="form-control" value="<?= $pengajuan['no_anggota'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Nama Anggota</label>
                                <input type="text" name="nama" class="form-control" value="<?= session()->get('nama');?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Kode Pengajuan</label>
                             <input type="text" name="id_pinjaman" class="form-control" value="<?=$pengajuan['id_pengajuan'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Tanggal Pinjam</label>
                                <input type="text" name="tgl_pinjam" class="form-control" value="<?= date('d-m-Y', strtotime($pengajuan['tgl_pinjam']));?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Lama Angsuran</label>
                                <input type="text" name="lama_angsuran" class="form-control" value="<?=$pengajuan['lama_angsuran'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Besar Pinjam</label>
                             <input type="text" class="form-control" value="Rp. <?= number_format($pengajuan['bsr_pengajuan'])?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Jasa 3%,7%</label>
                            <input type="text" name="lama_angsuran" class="form-control" value="Rp. <?= number_format($pengajuan['jasa']);?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <?php 
                            $byrAns = $pengajuan['jml_angsuran'] / $pengajuan['lama_angsuran'];
                            $totalAsr = $pengajuan['bsr_pengajuan'] + $pengajuan['jasa'];
                             ?>
                            <label>Besar Angsuran</label>
                            <input type="text"class="form-control" value="Rp. <?= number_format($totalAsr);?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Jumlah Bayar Angsuran/Bulan</label>
                            <input type="text"class="form-control" value="Rp. <?= number_format($byrAns);?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Tanggal Setor</label><br>
                            <input type="text" name="tgl_angsuran" class="form-control" value="<?= date('d-m-Y') ?>" required readonly>
                        </div>
                </div>

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
             <?php
            if ($status['status_pinjaman'] == 'Lunas') {?>
                <div class="alert alert-info" role="alert">
                    Status Pinjaman Anda Sudah Lunas
                </div>
            <?php }else{?>
                <div class="alert alert-danger" role="alert">
                    Status Pinjaman Anda Belum Lunas!
                </div>
            <?php }?>
            <table class="table p-0 table-hover table-striped table-bordered" id="example1">
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
                   