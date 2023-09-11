<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
            <?php 
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-info">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            if (session()->getFlashdata('gagal')) {
                echo '<div class="alert alert-danger">';
                echo session()->getFlashdata('gagal');
                echo '</div>';
            } ?>
        <form method="post" action="<?php echo base_url('bendahara/prosesSetoranSukarela') ?>">
                <?= csrf_field();?>
                <div class="form-group row">
                    <?php 
                        foreach($data_setoran as $item){
                    ?>
                        <input type="hidden" name="id_simpanan" class="form-control" value="<?= $item['id_simpanan'];?>" required readonly>
                        <div class="mb-3 col-sm-6">
                            <label>No Anggota</label>
                             <input type="text" name="no_anggota" class="form-control" value="<?= $item['no_anggota'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?= $item['nama'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-3">
                            <label>Jenis Simpanan</label>
                             <input type="text" class="form-control" value="<?= $simpanSukarela['jenis_simpanan'];?>" required readonly>
                             <input type="hidden" name="jenis_simpanan" class="form-control" value="<?= $simpanSukarela['id'];?>" required readonly>
                        </div>
                        <div class="mb-3 col-sm-3">
                            <label>Jumlah Setor Simpanan</label>
                                <!-- <input type="text" class="form-control" value="Rp 50.000" required readonly> -->
                                <input type="text" name="jumlah_setor" id="rupiah" class="form-control number-format" onkeyup="jmlterbilang(this,'lblterbilang')" required>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Terbilang</label><br>
                            <span id="lblterbilang"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Status Setor</label><br>
                            <!-- <select name="status_setor" class="form-control" required>
                                <option value="" >Pilih</option>
                                <option value="Manual">Manual</option>
                                <option value="Otomatis">Otomatis</option>
                            </select> -->
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" value="Manual" name="status_setor" required />
                              <label class="form-check-label" >Manual</label>
                            </div>

                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" value="Otomatis" name="status_setor" required />
                              <label class="form-check-label">Otomatis</label>
                            </div>
                        </div>
                    <?php
                        }
                     ?>
                </div>
                <input type="submit" name="tmbsimpanwajib" value="Setor" class="btn btn-success">
                <a href="<?php echo base_url('');?>bendahara/dataSimpanan" class="btn btn-info">Kembali</a>
            </form>
      </div>
  </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Riwayat Setor Simpanan Sukarela</h3>

        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table p-0 table-hover table-striped table-bordered" id="example1">
          <thead>
            <tr>
                <th>No</th>
                <!-- <th>ID Simpanan</th> -->
                <th>No Anggota</th>
                <th>Jenis Simpanan</th>
                <th>Tanggal</th>
                <th>Status Setor</th>
                <th>Jumlah Setor Simpanan</th>
                <th>Akski</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $no = 1;
                foreach ($histori_setoran as $item) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <!-- <td>< ?= $item['id_simpanan'];?></td> -->
                    <td><?= $item['no_anggota'];?></td>
                    <td><?= $item['jenis_simpanan'];?></td>
                    <td><?= date('d-m-Y', strtotime($item['tanggal']));?></td>
                    <td><?= $item['sts_setor'];?></td>
                    <td class="text-right">Rp. <?= number_format($item['debet']);?></td>
                    <td class="text-center">
                        <a href="<?= base_url('bendahara/cetakInvoiceSimpanan/'.$item['id_simpan_detail']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
  </div>
</div>