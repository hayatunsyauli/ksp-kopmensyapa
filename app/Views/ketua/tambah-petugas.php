<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

    <form method="post" action="<?php echo base_url()?>ketua/prosesTambahPetugas">
        <div class="card-tools float-right">
            <button type="submit" value="Simpan" class="btn btn-info btn-sm">Simpan</button> 
            <a href="<?= base_url('ketua/petugas')?>" class="btn btn-warning btn-sm">Kembali</a>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
            <div class="form-group col form-anggota">
                     <!-- <input type="hidden" name="id" value="" class="form-control" readonly> -->

                <div class="row mb-3">
                    <label class="col-sm-2">Kode Petugas</label>
                    <div class="col-sm-8">
                      <input type="text" name="id" value="<?= $id_petugas;?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Email</label>
                    <div class="col-sm-8">
                      <input type="text" name="username" class="form-control" autofocus required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Password</label>
                    <div class="col-sm-8">
                      <input type="text" name="password" class="form-control" value="<?= $id_petugas;?>" readonly required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Nama</label>
                    <div class="col-sm-8">
                      <input type="text" name="nama" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Level</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="level" required>
							<option value="1">Ketua</option>
							<option value="2">Bendahara</option>
							<option value="3">Sekretaris</option>
						</select>
                    </div>
                </div>
            </div>
        
        </form>
      </div>
  </div>
</div>