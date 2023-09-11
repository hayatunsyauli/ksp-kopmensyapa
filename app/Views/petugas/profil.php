<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
          <h3 class="card-title"><?= $judul;?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
         <?php 
           $errors = session()->getFlashdata('errors');
           if (!empty($errors)) { ?>
           <div class=" col-sm-12 alert alert-danger" role="alert">
               <ul>
                   <?php foreach($errors as $error) : ?>
                       <li><?= esc($error)?></li>
                   <?php endforeach ?>
               </ul>
           </div>
           <?php } ?>
           <?php 
           if (session()->getFlashdata('pesan')) {
               echo '<div class="alert alert-info">';
               echo session()->getFlashdata('pesan');
               echo '</div>';
           } ?> 
         <table class="table table-borderless" >
            <tr>
               <td width="40px" style="padding: 30px 0;"><i class="fas fa-user-circle fa-7x"></i></td>
               <td width="70px" style="padding: 70px 0; padding-left: 10px;"><small>Email :</small> <br>
                 <p> <?= $petugas['username'];?></p>
               </td>
               <td width="70px" style="padding: 70px 0;padding-left: 20px;"><small>Level :</small> <br>
                  <?php if (session()->get('level')==1) {
                      echo '<p>Ketua</p>';
                    }else if (session()->get('level')==2) {
                      echo '<p>Bendahara</p>';
                    }else if (session()->get('level')==3) {
                      echo '<p>Sekretaris</p>';
                    }else{
                      echo '<p>Anggota</p>';
                    } ?>
               </td>
               <td class="text-center" style="padding: 70px 0;padding-left: 10px;">
                  <button class="badge badge-warning btn" data-toggle="modal" data-target="#profile<?= $petugas['id_petugas']; ?>">Ganti Password</button>
               </td>
            </tr>
         </table>
      </div>
  </div>
</div>

<!-- Modal Edit Jenis P.-->
            <div class="modal fade" id="profile<?= $petugas['id_petugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form method="post" action="/petugas/prosesGantiPassword/<?= $petugas['id_petugas']; ?>">
                  <?= csrf_field(); ?>
                  <div class="modal-content">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <input type="hidden" name="id_petugas" value="<?= $petugas['id_petugas']; ?>" class="form-control" readonly>
                        <div class="mb-3 col-sm-12">
                          <label>Password Baru</label>
                          <input type="password" name="passwordBaru" class="form-control" autofocus required>
                        </div>
                        <div class="mb-3 col-sm-12">
                          <label>Ulangi Password</label>
                          <input type="password" name="ulangPass" class="form-control" autofocus required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-warning">Ganti</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
