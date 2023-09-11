<div class="col-md-12">
    <div class="card card-outline card-success">
        <form method="post" action="<?php echo base_url() ?>anggota/aksiGantiProfile/<?= $anggota['no_anggota'];?>" enctype="multipart/form-data">
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
                        <input type="hidden" name="no_anggota" value="<?= $anggota['no_anggota'];?>">
                        <input type="hidden" name="profilLama" value="<?= $anggota['profil'];?>">
                        <div class="row mb-3">
                            <label class="col-sm-2">Photo</label>
                            <div class="col-sm-2">
                                <img src="/img/anggota/<?= $anggota['profil'];?>" class="img-thumbnail img-preview" width="200px">
                            </div>
                            <div class="col-sm-6">
                                <div class="custom-files">
                                    <input type="file" class="custom-file-input" name="profil" id="profil"  onchange="previewImg()">
                                    <label class="custom-file-label" for="Profil"><?= $anggota['profil'];?></label>
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
                    </div>
                    
        </form>
      </div>
  </div>
</div>
