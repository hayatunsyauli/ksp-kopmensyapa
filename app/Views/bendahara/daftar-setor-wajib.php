<div class="col-md-12">
  <form method="post" action="<?php echo base_url('bendahara/prosesSetorAllWajib') ?>" class="formsetorwajiball">
    <div class="card card-outline card-info">
      <div class="card-header">
        <!-- /.card-tools -->
        <div class="card-tools">
          <button type="submit" class="btn btn-sm btn-info btnsimpanbanyak">
            <i class="fas fa-plus"></i>&nbsp; Setor Simp. Wajib
          </button>
          <a href="<?php echo base_url('');?>bendahara/dataSimpanan" class="btn btn-sm btn-warning">Kembali</a>

        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive ">
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
        <table class="table p-0 table-hover text-nowrap table-bordered" id="example1">
          <thead>
            <tr>
                <th>No</th>
                <th>No Anggota</th>
                <th>Nama</th>
                <th>Jenis Simpanan</th>
                <th>Jumlah</th>
            </tr>
          </thead>
          <tbody>
              <?php 
                  $no = 1;
                  foreach ($simpWajib as $s) : ?>
                  <tr>
                      <td><?= $no++;?></td>
                      <td>
                        <input type="hidden" name="id_simpanan[]" class="form-control" value="<?= $s['id_simpanan'];?>"readonly>
                        <input type="text" name="no_anggota[]" class="form-control" value="<?= $s['no_anggota'];?>"readonly>
                      </td>
                      <td>
                        <input type="text" name="nama[]" class="form-control" value="<?= $s['nama'];?>"readonly>
                      </td>
                      <td>
                        <input type="text" class="form-control" value="<?= $jumlah_setor['jenis_simpanan'];?>"readonly>
                        <input type="hidden" name="id_jenis_simpanan[]" class="form-control" value="<?= $jumlah_setor['id'];?>"readonly>
                      </td>
                      <td>
                        <input type="hidden" name="jumlah_simpanan_wajib[]" value="<?= $s['simpanan_wajib'];?>" readonly>
                        <!-- <input type="text" class="form-control text-right" value="Rp < ?= number_format('50000');?>" 
                        readonly>
                         -->
                        <input type="hidden" name="jumlah_setor[]" value="<?= $jumlah_setor['jumlah'];?>" required readonly>
                        <input type="text" class="form-control" value="Rp <?= number_format($jumlah_setor['jumlah']);?>" required readonly>
                        <input type="hidden" name="status_setor[]" value="Otomatis">
                        <input type="hidden" name="debet[]" value="Debet">
                        <input type="hidden" name="judul[]" value="Setoran Simpanan Wajib.">
                        <input type="hidden" name="detail[]" value="Tranksaksi Simpanan Wajib Anda telah berhasil disetor.">
                      </td>
                  </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </form>
</div>

