<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Detail Setor Angsuran </h3>
        <!-- Button trigger modal -->
        <?php 
        foreach ($angsuran as $key => $value){ } ?>
        <div class="card-tools">
          <a href="<?= base_url('bendahara/daftarPinjaman');?>" class="btn btn-info btn-sm">Kembali</a>
          <a href="<?= base_url('bendahara/cetakPinjamanAnggota/'.$pinjaman['id_pinjaman']);?>" target="_blank" class="btn btn-warning btn-sm" data-placement="bottom" title="Cetak Riwayat Setor Angsuran">Cetak</a>
        </div>
               
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
        <table class="table p-0 table-hover table-striped table-bordered" id="example1">
           <thead>
                <tr>
                    <th>No</th>
                    <th>ID Angsuran</th>
                    <th>ID Pinjaman</th>
                    <th>ID Petugas</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($angsuran as $jp) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $jp['id_angsuran'];?></td>
                    <td><?= $jp['id_pinjaman'];?></td>
                    <td><?= $jp['id_petugas'];?></td>
                    <td><?=date('d-m-Y', strtotime($jp['tgl_pinjam']));?></td>
                    <td class="text-right">Rp. <?= number_format($jp['angsuran_pembayaran']);?></td>
                    <td class="text-center">
                        <a href="<?= base_url('bendahara/cetakInvoiceAngsuran/'.$jp['id_angsuran']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>
                        
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
      </div>
  </div>
</div>