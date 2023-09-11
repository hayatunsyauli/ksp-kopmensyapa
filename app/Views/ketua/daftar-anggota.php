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
                <th>No</th>
                <th>No Anggota</th>
                <th>NRP</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Status Anggota</th>
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
                        <span class="badge badge-success">Aktif</span>
                    <?php
                    } else{ ?>
                        <span class="badge badge-danger">Tidak Aktif</span>
                    <?php 
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
            
          </tbody>
        </table>


      </div>
  </div>
</div>