<div class="col-md-12">
   <div class="card card-outline card-success">
      <div class="card-header">
         <h3 class="card-title"><?= $judul; ?></h3>

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
         <div class="row">
            <div class="col-md-4">
               <div class="row">
                  <div class="pt-5 pl-5">
                     <img src="<?php echo base_url('img/anggota/' . $anggota['profil']); ?>" width="290" height="400">
                  </div>
                  <div class="pt-2 pl-5">
                     <a href="<?php echo base_url() ?>anggota/gantiProfile/<?= $anggota['no_anggota']; ?>">Ganti Profile</a> <br>
                     <a href="<?php echo base_url() ?>anggota/gantiPassword/<?= $anggota['no_anggota']; ?>">Ganti Password</a><br>
                     <a href="<?php echo base_url() ?>anggota/pengajuanPengunduran">Ajukan Pengunduran Anggota</a>
                     <br>
                     <a class="btn btn-sm btn-secondary" style="border-radius: 0; height: 30px;" href="" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pen"></i> Sunting</a>
                  </div>
               </div>
               <div class="collapse pl-5 pt-1 text-justify" id="collapseExample">
                  *Hai, <?= $anggota['nama']; ?>. Untuk sementara profil tidak/belum bisa di edit sendiri oleh anggota koperasi. Silahkan hubungi pihak petugas koperasi jika ada data yang tidak sesuai.
               </div>

            </div>

            <div class="col-md-8">
               <div class="card-body">
                  <div class="table-responsive">
                     <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                           <tr>
                              <td>Nomor Anggota</td>
                              <td><b><?= $anggota['no_anggota']; ?></b></td>
                           </tr>
                           <tr>
                              <td>NRP</td>
                              <td><?= $anggota['nrp']; ?></td>
                           </tr>
                           <tr>
                              <td>Nama Lengkap</td>
                              <td><?= $anggota['nama']; ?></td>
                           </tr>
                           <tr>
                              <td>Alamat</td>
                              <td><?= $anggota['alamat']; ?></td>
                           </tr>
                           <tr>
                              <td>Unit Kerja</td>
                              <td><?= $anggota['unit_kerja']; ?></td>
                           </tr>
                           <tr>
                              <td>Jabatan</td>
                              <td><?= $anggota['jabatan']; ?></td>
                           </tr>
                           <tr>
                              <td>No HP</td>
                              <td><?= $anggota['nohp']; ?></td>
                           </tr>
                           <tr>
                              <td>Email</td>
                              <td><?= $anggota['no_anggota']; ?></td>
                           </tr>
                           <tr>
                              <td>Password</td>
                              <td><?= $anggota['email']; ?></td>
                           </tr>
                           <tr>
                              <td>Status Kerja</td>
                              <td><?= $anggota['status_kerja']; ?></td>
                           </tr>
                           <tr>
                              <td>Tanggal Keanggotaan</td>
                              <td><?= date('d-m-Y', strtotime($anggota['created_at'])); ?></td>
                           </tr>
                           <tr>
                              <td>Status Anggota</td>
                              <td style="text-transform:uppercase;"><b><?= $anggota['status_anggota']; ?></b></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
