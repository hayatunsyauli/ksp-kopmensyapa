<div class="col-md-12">
    <div class="card card-outline card-danger">
      <div class="card-header">
        <h3 class="card-title">Riwayat Pengunduran</h3>
        <!-- Button trigger modal -->
         
        <!-- /.card-tools -->
        <div class="card-tools">
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#validasi">Ajukan Pengunduran Anggota</button>
            <a href="<?php echo base_url() ?>anggota/profile" class="btn btn-warning btn-sm">Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <?php 
        if (session()->getFlashdata('pesan')) {
            echo '<div class="alert alert-success">';
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
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Tanggal Verifikasi</th>
                    <th>Status Pengunduran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($pengunduran as $jp) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $jp['no_anggota'];?></td>
                    <td><?= $jp['nama'];?></td>
                    <td><?= date('d-m-Y',strtotime($jp['tanggal']));?></td>
                    <td>
                        <?php if ($jp['tgl_verifikasi'] == null) { ?>
                            <i>Tanggal belum tersedia</i>
                        <?php 
                        }else{
                            echo date('d-m-Y', strtotime($jp['tgl_verifikasi']));
                        } ?>
                    </td>
                    <td class="text-center">
                        <?php
                        if ($jp['status_pengunduran'] == "Sedang Diverifikasi") {
                        ?>
                            <span class="badge badge-warning">Sedang Diverifikasi</span>
                        <?php
                        }else if ($jp['status_pengunduran'] == "Menunggu Persetujuan Ketua") { ?>
                            <span class="badge badge-info">Menunggu Persetujuan Ketua</span>
                        <?php 
                        }else if ($jp['status_pengunduran'] == "Diterima"){
                            echo '<span class="badge badge-success">Diterima</span>';
                        } else{
                            echo '<span class="badge badge-danger">Ditolak</span>';
                        } ?>
                    </td>
                    <td class="text-center">
                        <?php
                        if ($jp['status_pengunduran'] == "Sedang Diverifikasi") {
                        ?>
                            <a href="<?php echo base_url('anggota/deletePengunduran/'.$jp['id_pengunduran']) ?>" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i></a>
                        <?php
                        }else if ($jp['status_pengunduran'] == "Menunggu Persetujuan Ketua") { ?>
                            <span class="badge badge-info">-</a></span>
                        <?php 
                        }else if ($jp['status_pengunduran'] == "Diterima"){ ?>
                            <a href="<?php echo base_url('anggota/cetakPengunduran/'.$jp['id_pengunduran']) ?>" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i></a>
                        <?php } else{ ?>
                            <a href="<?php echo base_url('anggota/cetakPengunduran/'.$jp['id_pengunduran']) ?>" class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i></a>
                        <?php } ?>
                    </td>
                   
                </tr>

               
            <?php endforeach; ?>
            </tbody>
        </table>
      </div>
  </div>
</div>


<div class="modal fade" id="validasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <form method="post" action="<?= base_url('anggota/prosesAjukanPengunduran');?>">
         <?= csrf_field();?>
         <div class="modal-content">
           <div class="modal-header bg-danger">
               <h5 class="modal-title">Ajukan Pengunduran Diri?</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
           <div class="modal-body">
               <h5 class="modal-title">Konfirmasi Ajukan Pengunduran Diri?</h5>
               <input type="hidden" name="no_anggota" value="<?= $anggota;?>">
             </div>
           <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
               <button type="submit" class="btn btn-danger">Ya</button>
             </div>
         </div>
     </form>
   </div>
</div>


