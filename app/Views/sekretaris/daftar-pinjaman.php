<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Daftar Data Pinjaman</h3>
        <!-- Button trigger modal -->
                
        <div class="card-tools">
          
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
                    <th>Kode Pinjaman</th>
                    <th>Nama</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Lama Angsuran</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($pinjaman as $jp) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $jp['id_pinjaman'];?></td>
                    <td><?= $jp['nama'];?><br><small><?= $jp['no_anggota'];?></td>
                    <td class="text-right">Rp. <?= number_format($jp['jml_angsuran']);?></td>
                    <td>
                       <?= $jp['lama_angsuran'];?> Bulan<br>
                       <small><?= $jp['jenis_pinjaman'];?></small>
                    </td>
                    <td>
                        <?= date('d-m-Y', strtotime($jp['tgl_jth_tempo']));?>
                    </td> 
                    <td><?=date('d-m-Y', strtotime($jp['tgl_pinjam']));?></td>
                    <td class="text-center">
                        <?php if ($jp['status_pinjaman'] == "Belum Lunas") { ?>
                        <span class="badge badge-danger">Belum Lunas</span>
                        <?php } else{?>
                        <span class="badge badge-info">Lunas </span>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
      </div>
  </div>
</div>