<div class="col-md-12">
    <div class="card card-outline card-warning">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <!-- /.card-tools -->
        <div class="card-tools">
            <a href="<?= base_url('bendahara/dataSimpanan');?>" class="btn btn-info btn-sm">Kembali</a>
        </div>
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
                         <input type="hidden" name="jenis_simpanan" class="form-control" value="<?= $simpan_wajib['id'];?>" required readonly>
                         <input type="text" name="jenis_simpanan" class="form-control" value="<?= $simpan_wajib['jenis_simpanan'];?>" required readonly>
                    </div>
                    <div class="mb-3 col-sm-3">
                        <label>Jumlah Setor Simpanan</label>
                            <input type="text" name="jumlah_setor" class="form-control" value="Rp <?= number_format($simpan_wajib['jumlah']);?>" required readonly>
                    </div>
                    <div class="mb-3 col-sm-6">
                        <label>Terbilang</label>
                            <input type="text"class="form-control" value="<?= ucwords(terbilang($simpan_wajib['jumlah']));?>" required readonly>
                    </div>
                <?php
                    }
                 ?>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-warning">
      <div class="card-header">
        <h3 class="card-title">Riwayat Setor Simpanan Wajib</h3>


        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
        <div class="card-body">
            <table class="table p-0 table-hover table-striped table-bordered" id="example1">
          <thead>
            <tr>
                <th>No</th>
                <th>ID Simpanan</th>
                <th>No Anggota</th>
                <th>Jenis Simpanan</th>
                <th>Jumlah Setor Simpanan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $no = 1;
                foreach ($histori_setoran as $item) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $item['id_simpanan'];?></td>
                    <td><?= $item['no_anggota'];?></td>
                    <td><?= $item['jenis_simpanan'];?></td>
                    <td style="text-align: right;">Rp <?= number_format($item['debet'],0);?></td>
                    <td style="text-align: center;"><?= date('d-m-Y', strtotime($item['tanggal']));?></td>
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