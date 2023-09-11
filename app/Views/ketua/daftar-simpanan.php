<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive ">
        <table class="table p-0 table-hover text-nowrap table-bordered" id="example1">
          <thead>
            <tr>
                <th>No</th>
                <th>No Anggota</th>
                <th>Simpanan Pokok</th>
                <th>Simpanan Wajib</th>
                <th>Simpanan Sukarela</th>
                <th>Status Anggota</th>
                <th>Status Simpanan</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $no = 1;
                foreach ($simpan as $s) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $s['nama'];?><br>
                        <small><?= $s['no_anggota'];?></small>
                    </td>
                    <td class="text-right">Rp <?= number_format($s['simpanan_pokok']);?></td>
                    <td class="text-right">Rp <?= number_format($s['simpanan_wajib']);?></td>
                    <td class="text-right">Rp <?= number_format($s['simpanan_sukarela']);?></td>
                    <td class="text-center">
                        <?php
                    if ($s['status_anggota'] == "Aktif") {
                    ?>
                        <span class="badge badge-success">Aktif</span>
                    <?php
                    } else{ ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                    <?php 
                    }
                    ?></td>
                    <td class="text-center">
                        <?php
                        if ($s['status_simpanan'] == "Belum Ditarik") {
                        ?>
                            <span class="badge badge-success">Belum Ditarik</span>
                        <?php
                        } else{ ?>
                            <span class="badge badge-danger">Sudah Ditarik</span>
                        <?php 
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
