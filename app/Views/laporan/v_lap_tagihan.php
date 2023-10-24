      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <?= !empty($tanggal) ? '<small style="font-size: 16px;" class="float-right">Filter Tanggal: '.$tanggal.'</small><br>' : '';?>
                    <?= !empty($bulan) ? '<small style="font-size: 16px;" class="float-right">Filter Bulan: '.$bulan.'</small><br>' : '';?>
                    <?= !empty($tahun) ? '<small style="font-size: 16px;" class="float-right">Filter Tahun: '.$tahun.'</small><br>' : '';?>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- Table row -->
              <div class="row">
                <div class="col-12">
                  <table class="table table-sm table-bordered table_pinjaman" id="mauexport">
                    <thead>
                        <tr class="text-center">
                          <th>No</th>
                          <th>No Anggota</th>
                          <th>Nama</th>
                          <th>Simpanan Wajib</th>
                          <th>Simpanan Sukarela</th>
                          <th>Angsuran Pinjaman Panjang</th>
                          <th>Angsuran Pinjaman Barang</th>
                          <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach ($tagihan as $key => $value) { 
                                $total = 0;
                                ?>
                                <tr>
                                   <td class="text-center"><?= $no++;?></td>
                                    <td><?= $value['no_anggota'];?></td>
                                    <td>
                                      <?= $value['nama'];?> 
                                    </td>
                                    <td style="text-align: right;">Rp. 
                                      <?= number_format($value['simpanan_wajib']);?>
                                        
                                      </td>
                                    <td style="text-align: right;">Rp. 
                                      <?= number_format($value['simpanan_sukarela']);?>
                                        
                                    </td>
                                    
                                    <td class="text-right">Rp. 
                                      <?= number_format($value['pinjaman_panjang']);?>
                                        
                                      </td>
                                    <td class="text-right">Rp. 
                                      <?= number_format($value['pinjaman_barang']);?>
                                        
                                      </td>
                                    
                                    <td class="text-right">Rp. 
                                      <?= number_format($value['pinjaman_barang'] + $value['pinjaman_panjang'] + $value['simpanan_sukarela'] + $value['simpanan_wajib'] );?>
                                      
                                        
                                      </td>
                      </tr>                 
                      <?php } ?>
                      <tr>
                        <?php 
                        if ($tagihan == null) {
                            $wajib[] = 0;
                            $sukarela[] = 0;
                            $panjang[] = 0;
                            $barang[] = 0;
                        }else{
                            foreach ($tagihan as $value2) {
                                // $total = count($tagihan);
                                $wajib[] = $value2['simpanan_wajib'];
                                $sukarela[] = $value2['simpanan_sukarela'];
                                $panjang[] = $value2['pinjaman_panjang'];
                                $barang[] = $value2['pinjaman_barang'];
                            }
                        }
                         ?>
                          <th class="text-center" colspan="3">Total</th>
                          <th class="text-right">Rp. <?= number_format(array_sum($wajib));?></th>
                          <th class="text-right">Rp. <?= number_format(array_sum($sukarela));?></th>
                          <th class="text-right">Rp. <?= number_format(array_sum($panjang));?></th>
                          <th class="text-right">Rp. <?= number_format(array_sum($barang));?></th>
                          <th class="text-right">Rp. <?= number_format(array_sum($wajib) + array_sum($sukarela) + array_sum($panjang) + array_sum($barang));?></th>
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
<?php 
  /*Array( 
    [0] => stdClass Object ( 
      [stock_id] => 501 
      [product_id] => 7 
      [product_pcs] => 1120 
      [price_per_pcs] => 1.17 
      [num] => 1) 
    [1] => stdClass Object ( 
      [stock_id] => 500 
      [product_id] => 7 
      [product_pcs] => 1120 
      [price_per_pcs] => 1.17 
      [num] => 1 ) 
    [2] => stdClass Object ( 
      [stock_id] => 497 
      [product_id] => 3 
      [product_pcs] => 600 
      [price_per_pcs] => 1,1 
      [num] => 1 ) 
    [3] => stdClass Object ( 
      [stock_id] => 496 
      [product_id] => 3 
      [product_pcs] => 600 
      [price_per_pcs] => 1,1 
      [num] => 1 ) 
    [4] => stdClass Object ( 
      [stock_id] => 526 
      [product_id] => 25 
      [product_pcs] => 1120 
      [price_per_pcs] => 1.22 
      [num] => 1 ) 
    [5] => stdClass Object ( 
      [stock_id] => 525 
      [product_id] => 7 
      [product_pcs] => 1120 
      [price_per_pcs] => 1.17 
      [num] => 1 ) )*/
 ?>