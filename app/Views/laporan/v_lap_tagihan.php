<?php 
  if ($tagihansukarela == null) {
          $debet[] = 0;
          $credit[] = 0;
      }else{
          foreach ($tagihansukarela as $key => $value):
            $debet[] = $value['debet']; 
         endforeach;
      } 
     
    $saldoss = array_sum($debet);

?> 

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
                          <th>Angsuran Pjm Panjang</th>
                          <th>Angsuran Pjm Barang</th>
                          <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach ($tagihanwajib as $key => $value) { 
                            $idAnggota[] = $value['no_anggota'];
                            $valueArray[] = $value['debet'];

                            // $idTotals = [];

                            // for ($i = 0; $i < count($idAnggota); $i++) {
                            //     $id = $idAnggota[$i];
                            //     $value2 = $valueArray[$i] ?? 0; // Menggunakan nilai default 0 jika $valueArray kosong atau null

                            //     if (!isset($idTotals[$id])) {
                            //         $idTotals[$id] = 0;
                            //     }

                            //     $idTotals[$id] += $value2;

                            $idTotals = [];

                            for ($i = 0; $i < count($idAnggota); $i++) {
                                $id = $idAnggota[$i];
                                $value2 = $valueArray[$i] ?? 0; // Menggunakan nilai default 0 jika $valueArray kosong atau null

                                if (!isset($idTotals[$id])) {
                                    $idTotals[$id] = 0;
                                }

                                $idTotals[$id] += $value2;
                            }


                            // Menampilkan total berdasarkan ID
                            foreach ($idTotals as $id => $total) {
                               echo "ID: $id, Total: $total\n <br>";
                            } 
                            ?>
                                
                                <tr>
                                   <td class="text-center"><?= $no++;?></td>
                                    <td><?= $value['no_anggota'];?></td>
                                    <td><?= $value['nama'];?></td>
                                    <td class="text-right">Rp <?= number_format($value['debet']);?></td>
                                    <td>Rp <?= number_format($idTotals);?></td>
                          <td></td>
                          <td style="text-align: right;">
                            </td>
                          <td style="text-align: right;">

                            </td>
                      </tr>                 
                      <?php } ?>
                      <tr>
                          <th class="text-center" colspan="5">Total</th>
                          <th class="text-right"></th>
                          <th class="text-right"></th>
                      </tr>
                      <tr>

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