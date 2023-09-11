<div class="col-md-12">
    <div class="card card-outline card-success">
        <form method="post" action="<?php echo base_url() ?>anggota/aksiGantiPassword/<?= $anggota['no_anggota'];?>" enctype="multipart/form-data">
              <div class="card-header">
                <h3 class="card-title"><?= $judul;?></h3>
                    
                <!-- /.card-tools -->
                <div class="card-tools">
                    <button type="submit" value="Simpan" class="btn btn-info btn-sm">Ganti</button> 
                    <a href="<?php echo base_url() ?>anggota/profile" class="btn btn-warning btn-sm">Kembali</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group col form-anggota">
                   <!--  <div class="row mb-3">
                        <label class="col-sm-2">Password Lama</label>
                        <div class="col-sm-3">
                          <input type="password" name="passwordLama" value="" class="form-control" id="password">
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <label class="col-sm-2">Password Baru</label>
                        <div class="col-sm-3">
                          <input type="password" name="passwordBaru" value="" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2">Ulangi Password</label>
                        <div class="col-sm-3">
                          <input type="password" name="ulangPass" value="" class="form-control" id="password">
                        </div>
                    </div>
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
                </div>
                    
        </form>
      </div>
  </div>
</div>
