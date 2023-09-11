<?php 
foreach($data_setoran as $item){
?>
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
        <form method="post" action="<?= base_url();?>bendahara/prosesPenarikanSimpanan/<?= $item['id_simpanan'];?>">
                <?= csrf_field();?>
                <div class="form-group row">
                    
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
                            <label>Jumlah Simpanan</label>
                             <input type="text" value="Rp. <?= number_format($item['simpanan_sukarela']);?>" class="form-control jml-simpanan" required readonly>
                             <input type="hidden" name="jumlah_simpanan" id="total_simpanan" value="<?= $item['simpanan_sukarela'];?>" class="form-control" required readonly>
                        </div>
                        <div class="mb-3 col-sm-3">
                            <label>Jumlah Total Penarikan</label>
                            <input type="number" 
                            name="jumlah_tarikSimpanan" min="0" id="total_tarik" 
                            class="form-control jml-penarikan" onkeyup="jmlterbilang(this,'lblterbilang')"  required>
                            <span id="lblterbilang"></span>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label>Sisa Simpanan</label><br>
                            <input type="number" name="jumlah_sisa_simpanan" id="sisa_simpanan" class="form-control" >
                            <input type="hidden" name="jenis_simpanan" value="<?= $simpanSukarela['id'];?>" >

                        </div>
                </div>
                <input type="submit" name="submit" value="Tarik" class="btn btn-success btn-sm btn-tarik" id="btn-tarik">
                <a href="<?php echo base_url('');?>bendahara/penarikan" class="btn btn-warning btn-sm">Kembali</a>
            </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<?php } ?>

<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Riwayat Penarikan Simpanan </h3>

        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        
        <table class="table table-sm table-hover table-striped table-bordered" id="example1">
          <thead>
            <tr class="text-center">
                <th style="width: 10px;">No</th>
                <th>No Anggota</th>
                <th>Jumlah Penarikan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $no = 1;
                foreach ($histori_penarikan as $item) : ?>
                <tr>
                    <td class="text-center"><?= $no++;?></td>
                    <td><?= $item['no_anggota'];?></td>
                    <td><?= number_format($item['kredit']);?></td>
                    <td><?= date('d-m-Y',strtotime($item['tanggal']));?></td>
                    <!-- <td>< ?= $item['ket'];?></td> -->
                    <td class="text-center">                        
                        <a href="<?= base_url('bendahara/cetakInvoicePenarikan/'.$item['id_simpan_detail']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
