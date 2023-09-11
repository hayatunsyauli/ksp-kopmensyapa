<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Data Pengajuan Pinjaman</h3>
            <!-- Button trigger modal -->

            <div class="card-tools">
                <a href="<?= base_url('anggota/tambahPengajuan'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Ajukan Pinjaman Baru</a>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo session()->getFlashdata('pesan');
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
                        <th>Kode Pengajuan</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Besar Pengajuan</th>
                        <th>Jenis Pinjaman</th>
                        <th>Status</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    foreach ($pengajuan as $jp) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $jp['id_pengajuan']; ?></td>
                            <td><?= date('d-m-Y', strtotime($jp['tgl_pengajuan'])); ?></td>
                            <td class="text-right">Rp. <?= number_format($jp['bsr_pengajuan']); ?></td>
                            <td><?= $jp['jenis_pinjaman']; ?></td>
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
                                        echo '<span class="badge badge-success">Diterima</a></span><br>';
                                    } else{
                                        echo '<span class="badge badge-danger">Ditolak</a></span>';

                                    
                                    } ?>
                            </td>
                            <td><?php if ($jp['pesan'] == null) { ?>
                                    <i>Pesan belum tersedia</i>
                                <?php } else {
                                    echo $jp['pesan'];
                                } ?>
                            </td>
                            <td class="text-center">
                                <?php
                                    if ($jp['status_pengajuan'] == "Sedang Diverifikasi") {
                                    ?>
                                    <a href=""class="btn btn-xs btn-warning btn-xs" data-placement="bottom" title="Detail"><i class="fas fa-check"></i></a>
                                    <?php
                                    }else if ($jp['status_pengajuan'] == "Menunggu Persetujuan Ketua") { ?>
                                        <p>-</p>
                                    <?php 
                                    }else if ($jp['status_pengajuan'] == "Diterima"){?>
                                    <a href="<?php echo base_url(); ?>anggota/detailPengajuan/<?= $jp['id_pengajuan']?>"class="btn btn-success btn-xs" data-placement="bottom" title="Diterima"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('petugas/cetakPengajuanAngg/'.$jp['id_pengajuan']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"> </i></a>
                                    <?php }
                                     else{ ?>
                                        <button type="button" class="btn btn-xs btn-danger" data-placement="bottom" title="Pinjaman ditolak" ><i class="fas fa-times"></i></button>
                                        <a href="<?= base_url('petugas/cetakPengajuanAngg/'.$jp['id_pengajuan']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>
                                    <?php } ?>
                            </td>
                        </tr>


                        <!-- Modal Terima Pinjaman-->
                <div class="modal fade" id="detail<?= $jp['id_pengajuan'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-warning">
                          <h4 class="modal-title">Detail data Pengajuan Pinjaman</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row mb-3">
                                        <label class="form-control-label">Kode Transaksi</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" value="<?= $jp['id_pengajuan'];?>"required readonly>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-control-label">No Anggota</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" value="<?= $jp['no_anggota'];?>"required readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-control-label">Jumlah</label>
                                      <input type="number"class="form-control" value="Rp. <?= number_format($jp['bsr_pengajuan']);?>" required> 
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-control-label">Tanggal Pengajuan</label>
                                      <input type="text"class="form-control" value="<?= $jp['tgl_pengajuan'];?>" required> 
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-control-label">Jenis Pinjaman</label>
                                      <input type="text"class="form-control" value="Rp. <?= $jp['jenis_pinjaman'];?>" required> 
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-control-label">Lama Angsuran</label>
                                      <input type="number"class="form-control" value="<?= $jp['lama_angsuran'];?>" required> 
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-control-label">Status Pengajuan</label>
                                      <input type="text"class="form-control" value="<?= $jp['status_pengajuan'];?>" required> 
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-control-label">Jumlah Emas</label>
                                      <input type="number"class="form-control" value="<?= $jp['jml_emas'];?>" required> 
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-control-label">Pesan</label>
                                      <input type="text"class="form-control" value="<?= $jp['pesan'];?>" required> 
                                    </div>
                                    <div class="row mb-3">
                                      <label class="form-control-label">Tanggal Verifikasi</label>
                                      <input type="text"class="form-control" value="<?= $jp['tgl_verifikasi'];?>" required> 
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