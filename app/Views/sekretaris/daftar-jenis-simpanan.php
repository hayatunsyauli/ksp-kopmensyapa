<div class="col-md-12">
  <div class="card card-outline card-info">
    <div class="card-header">
      <h3 class="card-title"><?= $judul; ?></h3>

      <div class="card-tools">
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#jnsSimpanC" disabled>
          <i class="fa fa-plus"></i> Jenis Simpanan Baru
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
            <th>Jenis Simpanan</th>
            <th>Jumlah</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($jenisSimpan as $js) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $js['jenis_simpanan']; ?></td>
              <td class="text-right">Rp <?= number_format($js['jumlah']); ?></td>
              <td class="text-center">
                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#jnsSimpan<?= $js['id']; ?>"><i class="fa fa-pen"></i></button>
                
                <a href="/sekretaris/deleteJnsSmp/<?= $js['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda Yakin?');" style="pointer-events: none"><i class="fa fa-trash"></i></a>
                <!-- <a href="" class="btn btn-danger" ><i class="fa fa-trash"></i></a> -->
              </td>
            </tr>

            <!-- Modal Edit Jenis P.-->
            <div class="modal fade" id="jnsSimpan<?= $js['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post" action="<?php echo base_url('/sekretaris/prosesJnsSimpanUpdate') ?>">
                  <?= csrf_field(); ?>
                  <div class="modal-content">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Simpanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <input type="hidden" name="id" value="<?= $js['id']; ?>" class="form-control" readonly>
                        <div class="mb-3 col-sm-12">
                          <label>Jenis Simpanan</label>
                          <input type="text" name="jenis_simpanan" class="form-control" value="<?= $js['jenis_simpanan']; ?>" autofocus readonly>
                        </div>
                        <div class="mb-3 col-sm-12">
                          <label>Jumlah</label>
                          <input type="number" min="0" name="jumlah" class="form-control" value="<?= $js['jumlah']; ?>">
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
<div class="modal fade" id="jnsSimpanC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Pinjaman Emas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?php echo base_url('sekretaris/prosesJnsSimpanCreate') ?>">
        <div class="modal-body">
          <?= csrf_field(); ?>
          <div class="form-group row">
            <!-- <input type="text" name="id" value="" class="form-control" readonly> -->
            <div class="mb-3 col-sm-12">
              <label>Jenis Simpanan</label>
              <input type="text" name="jenis_simpanan" class="form-control" autofocus required>
            </div>
            <div class="mb-3 col-sm-12">
              <label>Jumlah</label>
              <input type="number" min="0" name="jumlah" class="form-control" onkeyup="jmlterbilang(this,'lblterbilang')">
              <span id="lblterbilang"></span>
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