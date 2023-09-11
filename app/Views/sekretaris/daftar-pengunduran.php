<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Data Pengajuan Pinjaman</h3>
        <!-- Button trigger modal -->
                
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
                    <th>No Anggota</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Tanggal Verifikasi</th>
                    <th>Status Pengunduran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($pengunduran as $jp) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $jp['no_anggota'];?></td>
                    <td><?= $jp['nama'];?></td>
                    <td><?= date('d-m-Y',strtotime($jp['tanggal']));?></td>
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
                        if ($jp['status_pengunduran'] == "Sedang Diverifikasi") {
                        ?>
                            <span class="badge badge-warning">Sedang Diverifikasi</a></span>
                        <?php
                        }else if ($jp['status_pengunduran'] == "Menunggu Persetujuan Ketua") { ?>
                            <span class="badge badge-info">Menunggu Persetujuan Ketua</a></span>
                        <?php 
                        }else if ($jp['status_pengunduran'] == "Diterima"){
                            echo '<span class="badge badge-success">Diterima</a></span>';
                        } else{
                            echo '<span class="badge badge-danger">Ditolak</a></span>';
                        } ?>
                    </td>
                    <td class="text-center">
                        <?php
                        if ($jp['status_pengunduran'] == "Sedang Diverifikasi") {
                        ?> 
                            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-placement="bottom" title="Verifikasi Pinjaman" data-target="#verifikasi<?= $jp['id_pengunduran'];?>"><i class="fas fa-check"></i></button>
                        <?php
                        }else if ($jp['status_pengunduran'] == "Menunggu Persetujuan Ketua") { ?>
                            <p>-</p>
                        <?php 
                        }else if ($jp['status_pengunduran'] == "Diterima"){
                            echo '<span class="badge badge-success" data-placement="bottom" title="Diterima"><i class="fas fa-check"></i></span>';
                        }
                         else{
                            echo '<span class="badge badge-danger">Ditolak</a></span>';                    
                        } ?>
                    </td>
                </tr>
                
                
                <!-- Modal Verifikasi Pengunduran-->
                <div class="modal fade" id="verifikasi<?= $jp['id_pengunduran'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-warning">
                          <h4 class="modal-title">Serahkan Pengajuan Ke Ketua?</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="post" action="/sekretaris/prosesAlihPengunduranKeKetua/<?= $jp['id_pengunduran'];?>">
                            <?= csrf_field();?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row mb-3">
                                        <label class=" form-control-label">Keterangan</label>
                                        <div class="input-group">
                                            <textarea class="form-control" name="ket"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="">
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