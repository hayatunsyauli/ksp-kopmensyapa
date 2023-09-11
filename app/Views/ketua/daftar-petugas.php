<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <div class="card-tools">
          <a href="<?php echo base_url();?>ketua/tambahPetugas" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> Tambah Petugas</a>
        </div>
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
                    <th>No</th>
                    <th>ID Petugas</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
          <tbody>
           <?php 
                $no = 1;
                foreach ($petugas as $p) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $p['id_petugas'];?></td>
                    <td><?= $p['username'];?></td>
                    <td><?= $p['nama'];?></td>
                    <td>
                    <?php if ($p['level'] == 1) {
                      echo 'Ketua';
                    }else if ($p['level'] == 2) {
                      echo 'Bendahara';
                    }else {
                      echo 'Sekretaris';
                    } ?>
                        
                    </td>
                    <td class="text-center">
                        <a href="<?php echo base_url() ?>ketua/editPetugas/<?= $p['id_petugas'];?>" class="btn btn-primary btn-xs"><i class="fa fa-pen"></i></a>
                        
                         <a href="<?php echo base_url();?>ketua/deletePtg/<?= $p['id_petugas'];?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda Yakin?');"><i class="fa fa-trash"></i></a>
                        <!-- <a href="" class="btn btn-danger" ><i class="fa fa-trash"></i></a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>


      </div>
  </div>
</div>