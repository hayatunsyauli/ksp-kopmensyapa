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
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- Table row -->
              <div class="row">
                <div class="col-12">
                  <table class="table-bordered table_pinjaman" id="mauexport">
                    <thead>
                        <tr class="text-center">
                          <th>No</th>
                          <th style="width: 400px">Uraian</th>
                          <th>Code Account/Uraian</th>
                          <th>Dari/ke</th>
                          <th>Tanggal</th>
                          <th>Kas Debet</th>
                          <th>Kas Kredit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach ($harian as $value) {
                        $ttlDebet[] = $value['kas_debit'];
                        $ttlKredit[] = $value['kas_credit'];
                         ?>
                      <tr>
                         <td class="text-center"><?= $no++;?></td>
                          <td><?= $value['uraian'];?></td>
                          <td><?= $value['code_uraian'];?></td>
                          <td><?= $value['ke'];?></td>
                          <td><?= date('d-m-Y', strtotime($value['tanggal_kas']) )?></td>
                          <td style="text-align: right;">Rp. <?= number_format($value['kas_debit']);?></td>
                          <td style="text-align: right;">Rp. <?= number_format($value['kas_credit']);?></td>
                      </tr>
                  <?php } ?>
                      <tr>
                          <th class="text-center" colspan="5">Total</th>
                          <th class="text-right">Rp <?= number_format(array_sum($ttlKredit));?></th>
                          <th class="text-right">Rp <?= number_format(array_sum($ttlDebet));?></th>
                      </tr>
                      <tr>
                          <!-- <th colspan="6" class="text-right"><i>< ?= ucwords(terbilang(array_sum($debet)));?></i></th> -->
                      </tr>
                    <!-- < ?php 
                    $no = 1;
                    foreach ($harian as $value) { 
                        $ttlDebet[] = $value['kas_debit'];
                        $ttlKredit[] = $value['kas_credit'];
                        ?>
                    <tr>
                        <td>< ?= $no++;?></td>
                        <td style="width: 50%">< ?= $value['uraian'];?> </td>
                        <td>< ?= $value['ke'];?> </td>
                        <td class="text-right">< ?= date('d-m-Y', strtotime($value['tanggal_kas']));?></td>
                        <td class="text-right">Rp < ?= number_format($value['kas_credit']);?></td>
                        <td class="text-right">Rp < ?= number_format($value['kas_debit']);?></td>
                    </tr>
                     < ?php }; ?>
                    <tr style="background-color: lightgrey;">
                        <th class="text-center" colspan="4">Total</th>
                        <th class="text-right">Rp < ?= $harian == null ? '' : number_format(array_sum($ttlKredit),0);?></th>
                        <th class="text-right">Rp < ?= $harian == null ? '' : number_format(array_sum($ttlDebet),0);?></th>
                    </tr>  -->
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