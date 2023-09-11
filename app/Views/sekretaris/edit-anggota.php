<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <div class="card-tools">
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <?php 
        foreach ($anggota as $key => $anggota) {?>

        <form method="post" action="/sekretaris/updateAnggota/<?= $anggota['no_anggota'];?>" enctype="multipart/form-data">
            <?= csrf_field();?>
            <input type="hidden" name="nrp" value="<?= $anggota['nrp'];?>">
            <input type="hidden" name="profilLama" value="<?= $anggota['profil'];?>">

            <div class="form-group col form-anggota">
                <div class="row mb-3">
                    <label class="col-sm-2">No Anggota</label>
                    <div class="col-sm-8">
                      <input type="text" name="no_anggota" value="<?=$anggota['no_anggota'];?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">NRP</label>
                    <div class="col-sm-8">
                      <input type="number" name="nrp" value="<?=$anggota['nrp'];?>" class="form-control" id="nrp" autofocus required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Nama Lengkap</label>
                    <div class="col-sm-8">
                      <input type="text" name="nama" value="<?= $anggota['nama'];?>" class="form-control" id="nama"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Alamat</label>
                    <div class="col-sm-8">
                      <input type="text" name="alamat"value="<?= $anggota['alamat'];?>" class="form-control" id="alamat"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Unit Kerja</label>
                    <div class="col-sm-8">
                      <input type="text" name="unit_kerja" value="<?= $anggota['unit_kerja'];?>" class="form-control" id="unit_kerja"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Jabatan</label>
                    <div class="col-sm-8">
                      <input type="text" name="jabatan" value="<?= $anggota['jabatan'];?>" class="form-control" id="jabatan"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">No HP</label>
                    <div class="col-sm-8">
                      <input type="text" name="nohp" value="<?= $anggota['nohp'];?>" class="form-control" id="nohp"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Email</label>
                    <div class="col-sm-8">
                      <input type="email" name="email" value="<?= $anggota['email'];?>" class="form-control" id="email"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Password</label>
                    <div class="col-sm-8">
                      <input type="password" name="password" value="<?= $anggota['password'];;?>" class="form-control" id="password" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Status Kerja</label>
                    <div class="col-sm-8">
                      <!-- <input type="text" name="status_kerja" class="form-control" id="status_kerja"required> -->
                      <select class="form-control" name="status_kerja" required>
                          <option value="" selected disabled>Pilih</option>
                          <option value="Tetap">Tetap</option>
                          <option value="Kontrak">Kontrak</option>
                          <option value="Percobaan">Percobaan</option>
                      </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Photo</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $anggota['profil'];?>" class="img-thumbnail img-preview" width="200px">
                    </div>
                    <div class="col-sm-6">
                        <div class="custom-files">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('profil')) ? 'is-invalid' : '' ;?>" name="profil" id="profil"  onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('profil');?>
                            </div>
                            <label class="custom-file-label" for="Profil">Pilih Photo..</label>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" value="Simpan" class="btn btn-primary">Simpan</button> 
            <a href="<?php echo base_url()?>sekretaris/anggota" class="btn btn-warning">Kembali</a>
        </form>
        <?php } ?>
      </div>
  </div>
</div>