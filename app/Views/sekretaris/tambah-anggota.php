<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

    <form method="post" action="<?php echo base_url()?>sekretaris/simpanAnggota" enctype="multipart/form-data">
        <div class="card-tools float-right">
            <button type="submit" value="Simpan" class="btn btn-info btn-sm">Simpan</button> 
            <a href="<?= base_url('sekretaris/anggota')?>" class="btn btn-warning btn-sm">Kembali</a>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
            <div class="form-group col form-anggota">
                     <!-- <input type="hidden" name="id" value="" class="form-control" readonly> -->
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
                <div class="row mb-3">
                    <label class="col-sm-2">No Anggota</label>
                    <div class="col-sm-8">
                      <input type="text" name="no_anggota" value="<?= $no_anggota;?>" class="form-control" id="no_anggota" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">NRP</label>
                    <div class="col-sm-8">
                      <input type="number" name="nrp" min="0" class="form-control" id="nrp" autofocus required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Nama Lengkap</label>
                    <div class="col-sm-8">
                      <input type="text" name="nama" class="form-control" id="nama"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Alamat</label>
                    <div class="col-sm-8">
                      <input type="text" name="alamat" class="form-control" id="alamat"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Unit Kerja</label>
                    <div class="col-sm-8">
                      <input type="text" name="unit_kerja" class="form-control" id="unit_kerja"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Jabatan</label>
                    <div class="col-sm-8">
                      <input type="text" name="jabatan" class="form-control" id="jabatan"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">No HP</label>
                    <div class="col-sm-8">
                      <input type="number" name="nohp" class="form-control" id="nohp"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Email</label>
                    <div class="col-sm-8">
                      <input type="email" name="email" class="form-control" id="email"required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Password</label>
                    <div class="col-sm-8">
                      <input type="text" name="password" value="<?= $no_anggota;?>" class="form-control" id="password" readonly>
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
                        <img src="/img/default.png" class="img-thumbnail img-preview" width="200px">
                    </div>
                    <div class="col-sm-6">
                        <div class="custom-files">
                            <input type="file" class="custom-file-input" name="profil" id="profil"  onchange="previewImg()">                            
                            <label class="custom-file-label" for="Profil">Pilih Photo..</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Simpanan</label>
                    <div class="col-sm-2">
                      <input type="hidden" name="jns_simpan" value="<?= $simpananPkk['id'];?>" readonly required>
                      <input type="text" class="form-control" value="Simpanan Pokok" readonly required>
                    </div>
                    <div class="col-sm-2">
                      <input type="hidden" name="jmlh_simpanan_pokok"  value="<?= $simpananPkk['jumlah'];?>">
                      <input type="text"class="form-control" id="jmlh_simpanan_pokok" value="Rp <?= number_format($simpananPkk['jumlah']);?>" readonly>
                    </div>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" value="<?= ucwords(terbilang($simpananPkk['jumlah']));?>" readonly>
                      <!-- <span class="form-control" id="terbilang" placeholder="lima puluh ribu" readonly></span> -->
                    </div>
                </div>
            </div>
        
        </form>
      </div>
  </div>
</div>