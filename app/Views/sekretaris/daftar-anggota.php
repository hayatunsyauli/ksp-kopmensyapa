<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <div class="card-tools">
          <a href="<?= base_url('sekretaris/tambahAnggota')?>" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Tambah Anggota</a>
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
                <th>No Anggota</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Status Anggota</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach ($anggota as $ang) : ?>
            <tr>
               <td><?= $no++;?></td>
                <td><?= $ang['no_anggota'];?></td>
                <td><?= $ang['nrp'];?></td>
                <td><?= $ang['nama'];?></td>
                <td><?= $ang['alamat'];?></td>
                <td><?= $ang['email'];?></td>
                <td class="text-center">
                    <?php
                    if ($ang['status_anggota'] == "Aktif") {
                    ?>
                        <a href="<?= base_url() ?>petugas/verifikasiAnggota/<?= $ang['no_anggota'] ?>" class="badge badge-success">Aktif</a>
                    <?php
                    } else{ ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                    <?php 
                    }
                    ?>
                </td>
                <td>
                    <a href="<?php echo base_url();?>sekretaris/editAnggota/<?= $ang['no_anggota'];?>" class="btn btn-warning btn-xs"><i class="fa fa-pen"></i></a>
                    
                    <a href="<?php echo base_url();?>sekretaris/delete/<?= $ang['no_anggota'];?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda Yakin?');"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
            
          </tbody>
        </table>


      </div>
  </div>
</div>