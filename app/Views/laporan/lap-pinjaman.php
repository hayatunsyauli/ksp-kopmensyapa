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
                          <th>No Pinjaman</th>
                          <th>No Anggota</th>
                          <th>Nama Anggota</th>
                          <th>Tanggal Pinjam</th>
                          <th>Jatuh Tempo</th>
                          <th>Jumlah Pinjaman</th>
                          <th>Jasa 3%, 7%</th>
                          <th>Jumlah Angsuran</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 1;
                    foreach ($harian as $value) { 
                        $totalpinjaman[] = $value['jml_angsuran'];
                        ?>
                    <tr>
                        <td><?= $no++;?></td>
                        <td><?= $value['id_pinjaman'];?> </td>
                        <td><?= $value['no_anggota'];?> </td>
                        <td><?= $value['nama'];?> </td>
                        <td><?= date('d-m-Y', strtotime($value['tgl_pinjam']));?> </td>
                        <td><?= date('d-m-Y', strtotime($value['tgl_jth_tempo']));?> </td>
                        <td class="text-right">Rp <?= number_format($value['jml_pinjaman']);?> </td>
                        <td class="text-right">Rp <?= number_format($value['jasa']);?></td>
                        <td class="text-right">Rp <?= number_format($value['jml_angsuran']);?></td>
                    </tr>
                     <?php }; ?>
                    <tr>
                        <th class="text-center" colspan="8">Total</th>
                        <th class="text-right">Rp <?= $harian == null ? '' : number_format(array_sum($totalpinjaman),0);?></th>
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
   
    <script>
        function viewLapBulanPinjaman(){
            let bulan = $('#bulan').val();
            let tahun = $('#tahun').val();
            let jns = $('#jenis_pinjaman').val();
            if (bulan == '') {
                alert('Bulan Belum Dipilih!');
            }else if (tahun == '') {
                alert('Tahun Belum Dipilih!');
            }else if (jns == '') {
                alert('Jenis Pinjaman Belum Dipilih!');
            }else{
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('petugas/viewLapBulanPinjaman');?>",
                    data: {
                        bulan: bulan,
                        tahun: tahun,
                        jns: jns,
                    },
                    dataType: "JSON",
                    success: function(response){
                        if (response.data) {
                            $('.table').html(response.data);
                        }
                    }
                })
            }
        }
        function viewLapTahunPinjaman(){
            let tahun = $('#tahun2').val();
            let jns = $('#jenis_pinjaman2').val();
            if (tahun == '') {
                alert('Tahun Belum Dipilih!');
            }else if (jns == '') {
                alert('Jenis Pinjaman Belum Dipilih!');
            }else{
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('petugas/viewLapTahunPinjaman');?>",
                    data: {
                        // bulan: bulan,
                        tahun: tahun,
                        jns: jns,
                    },
                    dataType: "JSON",
                    success: function(response){
                        if (response.data) {
                            $('.table').html(response.data);
                        }
                    }
                })
            }
        }
        
        function printLaporan(printarea){
            var newstr=document.getElementById("printarea").innerHTML;
                    //You can set height width over here
            var popupWin = window.open('', '_blank', 'width=1100,height=600');
            popupWin.document.open();
            popupWin.document.write('<html><style> th{text-align: left;}</style> <body onload="window.print()">'+ newstr + '</html>');
            popupWin.document.close(); 
            return false;
        }
    </script>