<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="post" action="<?= base_url('');?>bendahara/prosesSetorAngsuran" class="d-inline">
                <?= csrf_field();?>
                <div class="form-group row">
                    <?php 
                        foreach($pinjaman as $item){
                    ?>
                        <!-- <input type="hidden" name="id_simpanan" class="form-control" value="" required readonly> -->
                        <div class="mb-3 col-sm-6">
                            <label>No Anggota</label>
                             <input type="text" name="no_anggota" class="form-control" value="<?= $item['no_anggota'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Nama Anggota</label>
                                <input type="text" name="nama" class="form-control" value="<?= $item['nama'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Kode Pinjam</label>
                             <input type="text" name="id_pinjaman" class="form-control" value="<?= $item['id_pinjaman'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Tanggal Pinjam</label>
                                <input type="text" name="tgl_pinjam" class="form-control" value="<?= date('d-m-Y', strtotime($item['tgl_pinjam']));?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Besar Pinjam</label>
                             <input type="text" class="form-control" value="Rp. <?= number_format($item['jml_angsuran']);?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Lama Angsuran</label>
                                <input type="text" name="lama_angsuran" class="form-control" value="<?= $item['lama_angsuran'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Jumlah Bayar Angsuran/Bulan</label>
                            <input type="hidden" name="jml_byr_angsuran" class="form-control" value="<?= $item['jml_angsuran'];?>" required readonly>
                            <input type="text"class="form-control" value="Rp. <?= number_format($item['jml_angsuran']);?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Angsuran Ke</label><br>
                            <h5><span class="badge badge-danger">Lunas</span></h5>
                             <input type="hidden" name="ket" class="form-control" value="Setor Lunas" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Petugas</label><br>
                            <input type="text" name="petugas" class="form-control" value="<?= session('id_petugas');?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Tanggal Setor</label><br>
                            <input type="text" name="tgl_angsuran" class="form-control" value="<?= date('d-m-Y') ?>" required readonly>
                        </div>
                    <?php
                       }
                     ?>
                </div>
                <a href="<?= base_url('bendahara/daftarPinjaman');?>" class="btn btn-sm btn-info">Kembali</a>
                <button type="button" value="Submit Lunas" class="btn btn-sm btn-warning"data-toggle="modal" data-target="#validasiSetor<?= $item['id_pinjaman'];?>">Submit Lunas</button>
            </form>
      </div>
  </div>
</div>

    <!-- Modal Create Kas Kredit-->
    <?php 
    foreach ($pinjaman as $key => $value) {?>
        
    <div class="modal fade" id="validasiSetor<?= $value['id_pinjaman'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="<?= base_url('bendahara/prosesSetorLunas/'.$value['id_pinjaman']);?>">
            <?= csrf_field();?>
            <div class="modal-content">
              <div class="modal-header bg-warning">
                  <h5 class="modal-title">Konfirmasi Lunas</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <div class="modal-body">
                  <h5 class="modal-title">Konfirmasi Pinjaman <?= $value['nama'];?> Sebesar Rp. <?= number_format($item['jml_angsuran']);?>  Lunas?</h5>
                    <input type="hidden" name="petugas" value="<?= session('id_petugas');?>">
                    <input type="hidden" name="ket" value="Setor Lunas">
                    <input type="hidden" name="jml_byr_angsuran" value="<?= $value['jml_angsuran'];?>">
                    <input type="hidden" name="no_anggota" value="<?= $value['no_anggota'];?>">
                    <input type="hidden" name="id_jenis_pinjaman" value="<?= $value['id_jenis_pinjaman'];?>">
                    <input type="hidden" name="id_pinjaman" value="<?= $value['id_pinjaman'];?>">
                </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-warning">Ya</button>
                </div>
            </div>
        </form>
      </div>
    </div>
    <?php } ?>