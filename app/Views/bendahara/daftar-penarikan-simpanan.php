<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
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
                <th style="width: 10px;">No</th>
                <th>No Anggota</th>
                <th>Nama</th>
                <th>Jumlah Simpanan Sukarela</th>
                <th>Aksi</th>
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
                    <td class="text-center">
                        <a href="<?php echo base_url();?>bendahara/tarikSimpananAnggota/<?= $s['id_simpanan'];?>" class="btn btn-success btn-sm">Tarik</a>
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