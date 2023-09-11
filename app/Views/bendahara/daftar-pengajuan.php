<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Data Pengajuan Pinjaman</h3>
        <!-- Button trigger modal -->
                
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?php 
        if (session()->getFlashdata('pesan')) {
            
            echo session()->getFlashdata('pesan');
        }
        if (session()->getFlashdata('gagal')) {
            // echo '<div class="alert alert-danger">';
            echo session()->getFlashdata('gagal');
            // echo '</div>';
        } ?>
        <table class="table p-0 table-hover table-striped table-bordered" id="example1">
           <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Nama</th>
                    <th>Besar Pinjaman</th>
                    <th>Jenis Pinjaman</th>
                    <th>Status</th>
                    <th>Pesan</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $no = 1;
                foreach ($pengajuan as $jp) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= date('d-m-Y', strtotime($jp['tgl_pengajuan']));?></td>
                    <td><?= $jp['nama'];?><br><small><?= $jp['no_anggota'];?></td>
                    <td class="text-right">Rp <?= number_format($jp['bsr_pengajuan']);?></td>
                    <td><?= $jp['jenis_pinjaman'];?></td>
                    <td class="text-center">
                        <?php
                        if ($jp['status_pengajuan'] == "Sedang Diverifikasi") {
                        ?>
                            <span class="badge badge-warning">Sedang Diverifikasi</a></span>
                        <?php
                        }else if ($jp['status_pengajuan'] == "Menunggu Persetujuan Ketua") { ?>
                            <span class="badge badge-info">Menunggu Persetujuan Ketua</a></span>
                        <?php 
                        }else if ($jp['status_pengajuan'] == "Diterima"){
                            echo '<span class="badge badge-success">Diterima</a></span>';
                        } else{
                            echo '<span class="badge badge-danger">Ditolak</a></span>';
                        } ?>
                    </td>
                    <td>
                        <?php if ($jp['pesan'] == null) { ?>
                        <i>Pesan belum tersedia</i>
                        <?php } else{
                            echo $jp['pesan'];
                        } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
      </div>
  </div>
</div>