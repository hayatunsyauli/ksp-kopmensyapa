<div class="col-md-12">
    <div class="card card-outline card-success">
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <label class="col-xs-2">Filter Bulanan</label>
        <div class="row mb-3">
            <div class="col-sm-2">
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

            <!-- <label class="col-xs-2 pl-2">Tahun</label> -->
            <div class="col-sm-2">
                <select name="tahun" id="tahun" class="form-control">
                    <option value="">Tahun</option>
                    <?php 
                    $mulai = date('Y') - 10;
                    for ($i=$mulai; $i < $mulai + 11; $i++) { 
                        echo '<option value="'. $i .'">'. $i .'</option>';
                     } ?>
                </select>
            </div>
            <div class="col-sm-1">
                <button type="submit" onclick="viewLapTagihanBulanan()" class="btn btn-info btn-block">View</button>
            </div>
        </div>
        <div class="row col-sm-1 pb-2">
            <button type="submit" onclick="printLaporan()" class="btn btn-info btn-sm">Print</button>&nbsp;
            <button onClick="window.location.href=window.location.href" class="btn btn-warning btn-sm"><i class="fas fa-redo-alt"></i></button>
        </div>
        <div class="table" id="printarea">
                   
        </div>

        
      </div>
  </div>
</div>

   
    <script>
        function viewLapTagihanBulanan(){
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
                    url: "<?= base_url('petugas/viewLapTagihanBulanan');?>",
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