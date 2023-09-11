<div class="col-md-12">
    <div class="card card-outline card-warning">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="<?php echo base_url();?>bendahara/prosesUbahStsSimp/<?= $simpanan['id_simpanan'];?>">
                <?= csrf_field();?>
                <?php 
                    foreach($simpan as $item){
                ?>
                <div class="form-group row">
                    <input type="hidden" name="id_simpanan" class="form-control" value="<?= $item['id_simpanan'];?>" required readonly>
                    <div class="col-sm-6">
                        <label>No Anggota</label>
                         <input type="text" name="no_anggota" class="form-control" value="<?= $item['no_anggota'];?>" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $item['nama'];?>" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Jumlah Simpanan Pokok</label>
                         <input type="text" name="jenis_simpanan" class="form-control" value="Rp <?= number_format($item['simpanan_pokok']);?>" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Jumlah Simpanan Wajib</label>
                         <input type="text" name="jenis_simpanan" class="form-control" value="Rp <?= number_format($item['simpanan_wajib']);?>" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Jumlah Simpanan Sukarela</label>
                         <input type="text" name="jenis_simpanan" class="form-control" value="Rp <?= number_format($item['simpanan_sukarela']);?>" required readonly>
                         
                        <?php $totalSimpanan = $item['simpanan_pokok']+$item['simpanan_wajib']+$item['simpanan_sukarela'] ?>
                        <input type="hidden" name="total_simpanan" class="form-control" value="<?= $totalSimpanan;?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label>Ubah Status Simpanan</label>
                        <select name="status_simpanan" class="form-control">
                            <?php 
                                if ($item['status_simpanan'] == "1") {?>
                                    <option value="1" >Belum Ditarik</option>
                                    <option value="2"selected>Sudah Ditarik</option>
                                <?php }else{ ?>
                                    <option value="1" selected>Belum Ditarik</option>
                                    <option value="2">Sudah Ditarik</option>
                                <?php }
                            ?>
                        </select>
                    </div>
                </div>
                    <?php
                        }
                     ?>
                <button type="submit" class="btn btn-sm btn-warning" data-placement="bottom" title="Ubah Status Simpanan"><i class="fas fa-check"></i> Ubah Status Simpanan</button>
                <a href="<?= base_url('bendahara/dataSimpanan');?>" class="btn btn-sm btn-info">Kembali</a>
            </form>
        </div>
    </div>
</div>
