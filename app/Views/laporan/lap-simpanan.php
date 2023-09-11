      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> <?= $judul;?>
                    <?= !empty($tanggal) ? '<small style="font-size: 12px;" class="float-right">Filter Tanggal: '.$tanggal.'</small><br>' : '';?>
                    <?= !empty($bulan) ? '<small style="font-size: 12px;" class="float-right">Filter Bulan: '.$bulan.'</small><br>' : '';?>
                    <?= !empty($tahun) ? '<small style="font-size: 12px;" class="float-right">Filter Tahun: '.$tahun.'</small><br>' : '';?>

                    <small style="font-size: 12px;" class="float-right">Dicetak pada tanggal: <?= date('d-m-Y');?></small><br>


                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- Table row -->
              <div class="row">
                <div class="col-12">
                  <table class="table_content table table-sm" id="mauexport">
                    <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Anggota</th>
                          <th>No Anggota</th>
                          <th>Simpanan Pokok</th>
                          <th>Simpanan Wajib</th>
                          <th>Simpanan Sukarela</th>
                          <th>Status Simpanan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 1;
                    foreach ($harian as $value) { 
                        $ttlPokok[] = $value['simpanan_pokok'];
                        $ttlWajib[] = $value['simpanan_wajib'];
                        $ttlSK[] = $value['simpanan_sukarela'];
                        ?>
                    <tr>
                        <td><?= $no++;?></td>
                        <td><?= $value['nama'];?> </td>
                        <td><?= $value['no_anggota'];?> </td>
                        <td class="text-right">Rp <?= number_format($value['simpanan_pokok']);?> </td>
                        <td class="text-right">Rp <?= number_format($value['simpanan_wajib']);?></td>
                        <td class="text-right">Rp <?= number_format($value['simpanan_sukarela']);?></td>
                        <td><?= $value['status_simpanan'];?></td>
                    </tr>
                     <?php }; ?>
                    <tr>
                        <th class="text-center" colspan="3">Total</th>
                        <th class="text-right"><b>Rp <?= $harian == null ? '' : number_format(array_sum($ttlPokok),0);?></b></th>
                        <th class="text-right"><b>Rp <?= $harian == null ? '' : number_format(array_sum($ttlWajib),0);?></b></th>
                        <th class="text-right"><b>Rp <?= $harian == null ? '' : number_format(array_sum($ttlSK),0);?></b></th>
                    </tr> 
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12">
                  
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
    </div>