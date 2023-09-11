   <?php 
    if ($simpanan == null) {
        $debet[] = 0;
        $wajib[] = 0;
        $sukarela[] = 0;
    }else{
        foreach ($simpanan as $value) {
            $debet[] = $value['debet'];
            $kredit[] = $value['kredit'];
            // $sukarela[] = $value['simpanan_sukarela'];
        }
        $saldoakhir = array_sum($debet) - array_sum($kredit);
    } 
    
    ?>
<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <!-- /.card-tools -->
        <div class="card-tools">
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#codeaccount"><i class="fas fa-search"></i>&nbsp; Filter
          </button>
          <button onClick="window.location.href=window.location.href" class="btn btn-warning btn-sm"><i class="fas fa-redo-alt"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="table" id="printarea">
        <table class="table table-sm" style="width: 25%; border: 0;">
            <tr >
                <th style="border: 1;">Total Debet</th>
                <td class="text-right"><b>Rp <?= number_format(array_sum($debet),0);?></b></td>
            </tr>
            <tr>
                <th style="border: 1;">Total Kredit</th>
                <td class="text-right"><b>Rp <?= number_format(array_sum($kredit),0);?></b></td>
            </tr>
            <tr>
                <th style="border: 1;"><h5 style="margin-bottom: -2px;margin-top: -5px;">Saldo Akhir</h5></th>
                <td class="text-right"><h5 style="margin-bottom: -2px;margin-top: -5px;">Rp <?= number_format($saldoakhir,0);?></h5></td>
            </tr>
        </table>
            <hr>
            <table class="table table-sm table-hover table-striped table-bordered" id="example1">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jenis Simpanan</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $no = 1;
                    foreach ($setoranSaya as $s) : ?>
                    <tr class="<?= $s['status'] == 'Debet' ? 'text-success' : 'text-danger';?>">
                        <td><?= $no++;?></td>
                        <td><?= date('d-m-Y', strtotime($s['tanggal']));?></td>
                        <td><?= $s['jenis_simpanan'];?></td>
                        <td class="text-right">Rp. <?= number_format($s['debet']);?></td>
                        <td class="text-right">Rp. <?= number_format($s['kredit']);?></td>
                    </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
      </div>
  </div>
</div>
<!-- Modal code account-->
<div class="modal fade" id="codeaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter Simpanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="col-xs-2">Filter Bulanan</label>
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="">Bulan</option>
                            <?php 
                            $bln = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                            $mulai = 1;
                            for ($i=$mulai; $i < $mulai + 12; $i++) { 
                                echo '<option value="'. $i .'">'.$bln[$i].'</option>';
                             } ?>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">Tahun</option>
                            <?php 
                            $mulai = date('Y') - 10;
                            for ($i=$mulai; $i < $mulai + 11; $i++) { 
                                echo '<option value="'. $i .'">'. $i .'</option>';
                             } ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <!-- <button type="submit" >View</button>   -->
                        <button type="button" onclick="viewLapBulanSimpAnggota()" class="btn btn-info btn-block" data-dismiss="modal">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        $.modal.close();

        function viewLapBulanSimpAnggota(){
            let bulan = $('#bulan').val();
            let tahun = $('#tahun').val();
            if (bulan == '') {
                alert('Bulan Belum Dipilih!');
            }else if (tahun == '') {
                alert('Tahun Belum Dipilih!');
            }else{
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('anggota/viewLapBulanSimpAnggota');?>",
                    data: {
                        bulan: bulan,
                        tahun: tahun,
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
