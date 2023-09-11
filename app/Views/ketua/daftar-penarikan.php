<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table p-0 table-hover table-striped table-bordered" id="example1">
          <thead>
            <tr>
                <th style="width: 10px;">No</th>
                <th>No Anggota</th>
                <th>Nama</th>
                <th>Jumlah Simpanan</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $no = 1;
                foreach ($dataPenarikan as $s) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td>
                        <?= $s['no_anggota'];?><br>

                    </td>                                
                    <td><?= $s['nama'];?><br>
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
                    <td class="text-right">Rp. <?= number_format($s['simpanan_sukarela']);?></td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>