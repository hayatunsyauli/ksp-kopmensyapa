
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul;?></h3>
            <div class="card-tools">
              <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#simpss"><i class="fas fa-search"></i>&nbsp; Filter
              </button>
              <button type="submit" onclick="printLaporan()" class="btn btn-info btn-sm">Print</button>

             <button onClick="window.location.href=window.location.href" class="btn btn-warning btn-sm"><i class="fas fa-redo-alt"></i></button>

            </div>
        </div>
        <div class="card-body table-responsive ">
            <div class="table" id="printarea">
                <table class="table table-sm table-hover table-bordered table_pinjaman" style="font-family: Arial, Helvetica, sans-serif ;border-collapse: collapse;border: 1px solid #dddddd;font-size: 15px;width: 100%; padding-bottom: 10px;">
                  <thead>
                    <tr style="border: 1px solid #dddddd;">
                        <th style="border: 1px solid #dddddd;">No</th>
                        <th style="border: 1px solid #dddddd;">Nama</th>
                        <th style="border: 1px solid #dddddd;">No Anggota</th>
                        <th style="border: 1px solid #dddddd;">Status Anggota</th>
                        <th style="border: 1px solid #dddddd;">Status Simpanan</th>
                        <th style="border: 1px solid #dddddd;">Simpanan Sukarela</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $no = 1;
                        foreach ($simpan as $s) : ?>
                        <tr style="border: 1px solid #dddddd;">
                            <td style="border: 1px solid #dddddd;"><?= $no++;?></td>
                            <td style="border: 1px solid #dddddd;"><?= $s['nama'];?></td>
                            <td style="border: 1px solid #dddddd;"><?= $s['no_anggota'];?></td>
                            <td style="border: 1px solid #dddddd;"><?= $s['status_anggota'];?></td>
                            <td style="border: 1px solid #dddddd;"><?= $s['status_simpanan'];?></td>
                            <td style="text-align: right;">
                                Rp <?= number_format($s['simpanan_sukarela']);?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Modal code account-->
<div class="modal fade" id="simpss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter Simpanan Sukarela</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label class="col-xs-12">Filter Bulanan</label>
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
                        <button type="button" data-dismiss="modal" onclick="viewLapBulanSk()" class="btn btn-info btn-block">View</button>  
                    </div>
                </div>
                    <!-- 
                    <div class="col-md-3 mb-3">
                        <div>
                            <select name="jenis_simpanan" id="jenis_simpanan" class="form-control">
                                <option value="">Jenis Simpanan</option>
                                < ? php 
                                foreach ($jnsSimpan as $key => $value) {
                                    echo '<option value="'. $value['id'] .'">'. $value['jenis_simpanan'] .'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                     -->
                <label class="col-xs-2">Filter Tahunan</label>
                <div class="row mb-3">
                    <div class="col-sm-8">
                        <select name="tahun" id="tahun2" class="form-control">
                            <option value="">Tahun</option>
                            <?php 
                            $mulai = date('Y') - 10;
                            for ($i=$mulai; $i < $mulai + 11; $i++) { 
                                echo '<option value="'. $i .'">'. $i .'</option>';
                             } ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" data-dismiss="modal" onclick="viewLapTahunSk()" class="btn btn-info btn-block">View</button>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function viewLapBulanSk(){
        let bulan = $('#bulan').val();
        let tahun = $('#tahun').val();
        if (bulan == '') {
            alert('Bulan Belum Dipilih!');
        }else if (tahun == '') {
            alert('Tahun Belum Dipilih!');
        }else{
            $.ajax({
                type: "GET",
                url: "<?= base_url('petugas/viewLapBulanSk');?>",
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
    function viewLapTahunSk(){
        let tahun = $('#tahun2').val();
        if (tahun == '') {
            alert('Tahun Belum Dipilih!');
        }else{
            $.ajax({
                type: "GET",
                url: "<?= base_url('petugas/viewLapTahunSk');?>",
                data: {
                    // bulan: bulan,
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