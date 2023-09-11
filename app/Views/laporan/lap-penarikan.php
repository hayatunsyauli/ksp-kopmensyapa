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
                          <th>No Anggota</th>
                          <th style="width: 15%;">Nama</th>
                          <th>Tanggal Penarikan</th>
                          <th>Jumlah Penarikan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 1;
                    foreach ($harian as $value) { 
                        $ttlPenarikan[] = $value['nominal_penarikan'];
                        ?>
                    <tr>
                        <td><?= $no++;?></td>
                        <td><?= $value['no_anggota'];?> </td>
                        <td><?= $value['nama'];?> </td>
                        <td class="text-right"><?= date('d-m-Y', strtotime($value['tanggal_penarikan']));?></td>
                        <td class="text-right">Rp <?= number_format($value['nominal_penarikan']);?></td>
                    </tr>
                     <?php }; ?>
                    <tr>
                        <th class="text-center" colspan="4">Total</th>
                        <th class="text-right"><b>Rp <?= $harian == null ? '' : number_format(array_sum($ttlPenarikan),0);?></b></th>
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
