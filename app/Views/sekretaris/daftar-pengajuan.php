<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Data Pengajuan Pinjaman</h3>
        <!-- Button trigger modal -->

        <div class="card-tools">
        <a href="<?= base_url('petugas/laporanPengajuan');?>" class="btn btn-warning btn-sm">Cetak Pengajuan</a>
        </div>
                
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <?php 
        if (session()->getFlashdata('pesan')) {
            echo '<div class="alert alert-success">';
            echo session()->getFlashdata('pesan');
            echo '</div>';
        }
        if (session()->getFlashdata('gagal')) {
            echo '<div class="alert alert-danger">';
            echo session()->getFlashdata('gagal');
            echo '</div>';
        } ?>


        <table class="table p-0 table-hover table-striped table-bordered" id="example1">
           <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Jenis Pinjaman</th>
                    <th>Status</th>
                    <th>Tanggal Verifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($pengajuan as $jp) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= date('d-m-Y', strtotime($jp['tgl_pengajuan']));?></td>
                    <td><?= $jp['nama'];?><br>
                        <small><?= $jp['no_anggota'];?></small></td>
                    <td class="text-right">Rp. <?= number_format($jp['bsr_pengajuan']);?></td>
                    <td><?= $jp['jenis_pinjaman'];?></td>
                    <td class="text-center">
                        <?php
                        if ($jp['status_pengajuan'] == "Sedang Diverifikasi") {
                        ?>
                            <span class="badge badge-warning">Sedang Diverifikasi</a></span>
                        <?php
                        }else if ($jp['status_pengajuan'] == "Menunggu Persetujuan Ketua") { ?>
                            <span class="badge badge-info">Menunggu Persetujuan Ketua</a></span>
                        <?php 
                        }else if ($jp['status_pengajuan'] == "Diterima"){
                            echo '<span class="badge badge-success">Diterima</a></span>';
                        } else{
                            echo '<span class="badge badge-danger">Ditolak</a></span>';

                        
                        } ?>
                    </td>

                    <td>
                        <?php if ($jp['tgl_verifikasi'] == null) { ?>
                            <i>Tanggal belum tersedia</i>
                        <?php 
                        }else{
                            echo date('d-m-Y', strtotime($jp['tgl_verifikasi']));
                        } ?>
                            
                    </td>

                    <td class="text-center">
                        <?php
                        if ($jp['status_pengajuan'] == "Sedang Diverifikasi") {
                        ?>
                            <!-- <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"data-placement="bottom" title="Tolak Pinjaman" data-target="#tolak"><i class="fas fa-times"></i></button> -->
                            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-placement="bottom" title="Verifikasi Pinjaman" data-target="#verifikasi<?= $jp['id_pengajuan'];?>"><i class="fas fa-check"></i></button>
                           <a href="<?= base_url('petugas/cetakPengajuanAngg/'.$jp['id_pengajuan']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>

                        <?php
                        }else if ($jp['status_pengajuan'] == "Menunggu Persetujuan Ketua") { ?>
                            <a href="<?= base_url('petugas/cetakPengajuanAngg/'.$jp['id_pengajuan']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>
                        <?php 
                        }else if ($jp['status_pengajuan'] == "Diterima"){?>
                           <a href="<?= base_url('petugas/cetakPengajuanAngg/'.$jp['id_pengajuan']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>
                        <?php  }
                         else{
                            echo '<span class="badge badge-danger">Ditolak</a></span>';                    
                        } ?>
                    </td>
                </tr>
                <!-- Modal Tolak Pinjaman-->
                <div class="modal fade" id="tolak<?= $jp['id_pengajuan'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-danger">
                          <h4 class="modal-title">Tolak Pengajuan Pinjaman</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="post" action="/petugas/prosesTolakPinjaman/<?= $jp['id_pengajuan'];?>">
                            <?= csrf_field();?>
                            <div class="modal-body">
                              <label>Keterangan</label>
                              <textarea class="form-control" name="pesan"></textarea>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-danger">Kirim</button>
                            </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                
                <!-- Modal Terima Pinjaman-->
                <div class="modal fade" id="verifikasi<?= $jp['id_pengajuan'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-warning">
                          <h4 class="modal-title">Serahkan Pengajuan Ke Ketua?</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <form method="post" action="<?php echo base_url('/sekretaris/prosesAlihPengajuanKeKetua/'.$jp['id_pengajuan']) ?>">
                            <?= csrf_field();?>
                            <div class="modal-body">
                                <div class="form-group">
                            <?php  

                                if ($jp['id_jenis_pinjaman'] == $jp['id'] && $jp['bsr_pengajuan'] >= $jp['kurang1_dari'] && $jp['bsr_pengajuan'] <= $jp['kurang2_dari'] ) {
                                    $jasa = $jp['bsr_pengajuan'] *  $jp['jasa2'];
                                    $jml_angsuran = $jp['bsr_pengajuan'] + $jasa;
                                }else if ($jp['id_jenis_pinjaman'] == $jp['id'] && $jp['bsr_pengajuan'] < $jp['kurang1_dari']) {
                                    $jasa = $jp['bsr_pengajuan'] * $jp['jasa1'];
                                    $jml_angsuran = $jp['bsr_pengajuan'] + $jasa;
                                }else{

                                }

                                /*
                                    if ($jp['id_jenis_pinjaman'] == '1' && $jp['bsr_pengajuan'] >= 5000000 && $jp['bsr_pengajuan'] <= 10000000 ) {
                                        $jasa = $jp['bsr_pengajuan'] *  0.07;
                                        $jml_angsuran = $jp['bsr_pengajuan'] + $jasa;
                                    }else if ($jp['id_jenis_pinjaman'] == '1' && $jp['bsr_pengajuan'] < 5000000) {
                                        $jasa = $jp['bsr_pengajuan'] * 0.03;
                                        $jml_angsuran = $jp['bsr_pengajuan'] + $jasa;
                                    }else if ($jp['id_jenis_pinjaman'] == '2' && $jp['bsr_pengajuan'] >= 5000000 && $jp['bsr_pengajuan'] <= 10000000 ) {
                                        $jasa = $jp['bsr_pengajuan'] *  0.07;
                                        $jml_angsuran = $jp['bsr_pengajuan'] + $jasa;
                                    }else if ($jp['id_jenis_pinjaman'] == '2' && $jp['bsr_pengajuan'] < 5000000) {
                                        $jasa = $jp['bsr_pengajuan'] * 0.05;
                                        $jml_angsuran = $jp['bsr_pengajuan'] + $jasa;
                                    }else if ($jp['id_jenis_pinjaman'] == '3' && $jp['bsr_pengajuan'] >= 5000000 && $jp['bsr_pengajuan'] <= 10000000 ) {
                                        $jasa = $jp['bsr_pengajuan'] *  0.07;
                                        $jml_angsuran = $jp['bsr_pengajuan'] + $jasa;
                                    }else if ($jp['id_jenis_pinjaman'] == '3' && $jp['bsr_pengajuan'] < 5000000) {
                                        $jasa = $jp['bsr_pengajuan'] * 0.05;
                                        $jml_angsuran = $jp['bsr_pengajuan'] + $jasa;
                                    }else{

                                    }   
                                */
                             ?>
                                    <div class="row mb-3">
                                        <label class=" form-control-label">Jasa <?= $jp['jasa1'];?>%, <?= $jp['jasa2'];?>%</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" value="Rp. <?= number_format($jasa);?>"required readonly>
                                            <br>
                                            <input class="form-control" type="hidden" value="<?= $jasa;?>" name="jasa" required readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class=" form-control-label">Angsuran Bulanan</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" value="Rp. <?= number_format($jml_angsuran);?>"required readonly>
                                            <br>
                                            <input class="form-control" type="hidden" value="<?= $jml_angsuran;?>" name="angsuran_bulanan" required readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label>Jumlah Emas (Gram)</label>
                                      <input type=number step=0.01 class="form-control" name="emas" min="0" required> 
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_pengajuan" value="<?= $jp['id_pengajuan'];?>">
                            <input type="hidden" name="bsr_pengajuan" value="<?= $jp['bsr_pengajuan'];?>">
                            <input type="hidden" name="lama_angsuran" value="<?= $jp['lama_angsuran'];?>">
                            <input type="hidden" name="no_anggota" value="<?= $jp['no_anggota'];?>">
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-warning">Serahkan ke Ketua</button>
                            </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

            <?php endforeach; ?>
            </tbody>
        </table>
      </div>
  </div>
</div>