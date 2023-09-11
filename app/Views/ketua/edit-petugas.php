<div class="col-md-12">
    <div class="card card-outline card-info">
    <form method="post" action="<?php echo base_url()?>ketua/prosesEditPetugas/<?=$id_petugas['id_petugas'];?>">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <div class="card-tools float-right">
            <button type="submit" value="Simpan" class="btn btn-info btn-sm">Simpan</button> 
            <a href="<?= base_url('ketua/petugas')?>" class="btn btn-warning btn-sm">Kembali</a>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      	<div class="card-body table-responsive">
            <div class="form-group col form-anggota">
                <div class="row mb-3">
                    <label class="col-sm-2">Kode Petugas</label>
                    <div class="col-sm-8">
                      <input type="text" name="id" value="<?=$id_petugas['id_petugas'];?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Email</label>
                    <div class="col-sm-8">
                      <input type="text" name="username" class="form-control" value="<?=$id_petugas['username'];?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Password</label>
                    <div class="col-sm-8">
                      <input type="password" name="password" class="form-control" value="<?= $id_petugas['password'];?>" readonly required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Nama</label>
                    <div class="col-sm-8">
                      <input type="text" name="nama" class="form-control" value="<?= $id_petugas['nama'];?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2">Level</label>
                    <div class="col-sm-8">
                      	<select class="form-control" name="level" required>
							<?php 
								if ($id_petugas['level'] == "1") {?>
									<option value="1" selected>Ketua</option>
									<option value="2">Bendahara</option>
									<option value="3">Sekretaris</option>
								<?php }elseif($id_petugas['level'] == "2"){ ?>
									<option value="1">Ketua</option>
									<option value="2"selected>Bendahara</option>
									<option value="3">Sekretaris</option>
								<?php }else{ ?>
									<option value="1">Ketua</option>
									<option value="2">Bendahara</option>
									<option value="3"selected>Sekretaris</option>
								<?php }
					 		?>
						</select>
                    </div>
                </div>
            </div>
      	</div>
    </form>
  </div>
</div>

