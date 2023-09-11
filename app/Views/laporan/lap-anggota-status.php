<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-globe"></i> <?= $judul .' '. $status;?></h3>
            <small style="font-size: 12px;" class="float-right">Dicetak pada tanggal: <?= date('d-m-Y');?></small><br>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table_content table table-sm" id="mauexport">
              <thead>
                  <tr>
                    <th>No</th>
                    <th>No Anggota</th>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Unit Kerja</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>Status Kerja</th>
                    <th>Status Anggota</th>
                    <th>Tanggal Keanggotaan</th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($harian as $value) { ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $value['no_anggota'];?> </td>
                    <td><?= $value['nrp'];?> </td>
                    <td><?= $value['nama'];?> </td>
                    <td><?= $value['alamat'];?> </td>
                    <td><?= $value['unit_kerja'];?> </td>
                    <td><?= $value['nohp'];?></td>
                    <td><?= $value['email'];?></td>
                    <td><?= $value['status_kerja'];?></td>
                    <td><?= $value['status_anggota'];?></td>
                    <td><?= date('d-m-Y',strtotime($value['created_at']));?></td>
                </tr>
                 <?php }; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>