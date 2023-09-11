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

        <table class="table p-0 table-hover table-striped table-bordered" id="example1">
          <thead>
            <tr>
                <th>No</th>
                <th>No Anggota</th>
                <th>Jumlah Penarikan</th>
                <th>Tanggal Penarikan</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $no = 1;
                foreach ($histori_penarikan as $item) : ?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $item['no_anggota'];?></td>
                    <td class="text-right">Rp <?= number_format($item['nominal_penarikan']);?></td>
                    <td><?= date('d-m-Y',strtotime($item['created_at']));?></td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        </div>
    </div>
</div>