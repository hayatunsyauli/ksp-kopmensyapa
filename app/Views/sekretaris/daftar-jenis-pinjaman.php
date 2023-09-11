<div class="col-md-12">
  <div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title"><?= $judul; ?></h3>

      <div class="card-tools">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#jnsPinjamC">
          <i class="fa fa-plus"></i> Jenis Pinjaman Emas Baru
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <?php
      if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-info">';
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
            <th>Jenis Pinjaman</th>
            <th>Jasa(1) %</th>
            <th>Jasa(2) %</th>
            <th>Jumlah Kurang(Min) Dari</th>
            <th>Jumlah Kurang(Max) Dari</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($jenisPinjam as $jp) : 
            $jasa1 = $jp['jasa1'] * 100;
            $jasa2 = $jp['jasa2'] * 100;
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $jp['jenis_pinjaman']; ?></td>
              <td><?= $jasa1; ?></td>
              <td><?= $jasa2; ?></td>
              <td class="text-right">Rp <?= number_format($jp['kurang1_dari']); ?></td>
              <td class="text-right">Rp <?= number_format($jp['kurang2_dari']); ?></td>
              <td class="text-center">
                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#jnsPinjamU<?= $jp['id']; ?>"><i class="fa fa-pen"></i></button>
                
                <a href="/sekretaris/deleteJns/<?= $jp['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda Yakin?');"><i class="fa fa-trash"></i></a>
                <!-- <a href="" class="btn btn-danger" ><i class="fa fa-trash"></i></a> -->
              </td>
            </tr>

            <!-- Modal Edit Jenis P.-->
            <div class="modal fade" id="jnsPinjamU<?= $jp['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post" action="/sekretaris/prosesJnsPinjamUpdate">
                  <?= csrf_field(); ?>
                  <div class="modal-content">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Pinjaman Emas</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <input type="hidden" name="id" value="<?= $jp['id']; ?>" class="form-control" readonly>
                        <div class="mb-3 col-sm-12">
                          <label>Jenis Pinjaman</label>
                          <input type="text" name="jenis_pinjaman" class="form-control" value="<?= $jp['jenis_pinjaman']; ?>" autofocus required>
                        </div>
                        <div class="mb-3 col-sm-12">
                          <label>Jasa(1) % </label>
                          <input type="number" step="0.01" name="jasa1" class="form-control" value="<?= $jp['jasa1']; ?>" required>
                        </div>
                        <div class="mb-3 col-sm-12">
                          <label>Jasa(2) % </label>
                          <input type="number" step="0.01" name="jasa2" class="form-control" value="<?= $jp['jasa2']; ?>" required>
                        </div>
                        <div class="mb-3 col-sm-12">
                          <label>Jumlah Kurang(Min) Dari</label>
                          <input type="number" name="kurang1_dari" class="form-control" value="<?= $jp['kurang1_dari']; ?>" required>
                        </div>
                        <div class="mb-3 col-sm-12">
                          <label>Jumlah Kurang(Max) Dari</label>
                          <input type="number" name="kurang2_dari" class="form-control" value="<?= $jp['kurang2_dari']; ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-warning">Edit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<!-- Modal Tambah jns Pjm.-->
<div class="modal fade" id="jnsPinjamC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Pinjaman Emas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url('sekretaris/prosesJnsPinjamCreate') ?>">
        <div class="modal-body">
          <?= csrf_field(); ?>
          <div class="form-group row">
            <!-- <input type="text" name="id" value="" class="form-control" readonly> -->
            <div class="mb-3 col-sm-12">
              <label>Jenis Pinjaman</label>
              <input type="text" name="jenis_pinjaman" class="form-control" autofocus required>
            </div>
            <div class="mb-3 col-sm-12">
              <label>Jasa(1) % </label>
              <input type="number" step="0.01" name="jasa1" class="form-control" required>
            </div>
            <div class="mb-3 col-sm-12">
              <label>Jasa(2) % </label>
              <input type="number" step="0.01" name="jasa2" class="form-control" required>
            </div>
            <div class="mb-3 col-sm-12">
              <label>Jumlah Kurang(Min) Dari</label>
              <input type="number" name="kurang1_dari" class="form-control" required>
            </div>
            <div class="mb-3 col-sm-12">
              <label>Jumlah Kurang(Max) Dari</label>
              <input type="number" name="kurang2_dari" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>