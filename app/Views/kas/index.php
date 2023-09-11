<?php 
    if ($kas == null) {
        $debet[] = 0;
        $credit[] = 0;
    }else{
        foreach ($kas as $value) {
            $debet[] = $value['kas_debit'];
            $credit[] = $value['kas_credit'];
        }
    } 
    $saldoakhir = array_sum($debet) - array_sum($credit);
?>
<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#codeaccount"><i class="fas fa-plus"></i>&nbsp; Code Account/Uraian
          </button>
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#kasaccount"><i class="fas fa-search"></i>&nbsp; Filter
          </button>
          <button type="submit" onclick="printLaporan()" class="btn btn-secondary btn-sm">Print</button>

          <button onClick="window.location.href=window.location.href" class="btn btn-warning btn-sm"><i class="fas fa-redo-alt"></i></button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
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
        <div class="table" id="printarea">
            <table class="table table-sm" style="width: 25%; border: 0;">
                <tr >
                    <th style="border: 1;">Total Debet</th>
                    <td class="text-right"><b>Rp <?= number_format(array_sum($debet),0);?></b></td>
                </tr>
                <tr>
                    <th style="border: 1;">Total Kredit</th>
                    <td class="text-right"><b>Rp <?= number_format(array_sum($credit),0);?></b></td>
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
                    <th style="width: 470px;">Uraian</th>
                    <th style="width: 200px;">Code Account/Uraian</th>
                    <th>Dari/ke</th>
                    <th>Kas Debet</th>
                    <th>Kas Kredit</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $no = 1;
                    foreach ($kas as $value) { ?>
                    <tr class="<?= $value['status'] == 'Debet' ? 'text-success' : 'text-danger';?>">
                       <td><?= $no++;?></td>
                       <td><?= date('d-m-Y', strtotime($value['tanggal']) )?></td>
                        <td><?= $value['uraian'];?></td>
                        <td><?= $value['code_uraian'];?></td>
                        <td><?= $value['ke'];?></td>
                        <td style="text-align: right;">Rp. <?= number_format($value['kas_debit']);?></td>
                        <td style="text-align: right;">Rp. <?= number_format($value['kas_credit']);?></td>
                                               
                    </tr>
                <?php } ?>
              </tbody>
            </table>
            
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal code account-->
<div class="modal fade" id="codeaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Code Account/Uraian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('kas/addCodeUraian') ?>">
                    <?= csrf_field();?>
                    <div class="form-group row">
                             <!-- <input type="text" name="id" value="" class="form-control" readonly> -->
                        <div class="col-sm-8">
                            <!-- <label>Uraian</label> -->
                             <input type="text" name="code_uraian" class="form-control" placeholder="Masukkan Code baru" required>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-info inline">Simpan</button>
                        </div>
                    </div>
                </form>

                <table class="table p-0 table-hover table-bordered" id="example2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Code Account/Uraian</th>
                            <th>Aksi</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($uraiann as $value) { ?>
                        <tr>
                           <td style="text-align: center;"><?= $no++;?></td>
                            <td><?= $value['code_uraian'];?></td>
                            <td style="text-align: center;">
                                <form action="/kas/deleteCU/<?= $value['id_uraian'];?>" method="post" class="d-inline">
                                    <?= csrf_field();?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin?');"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>                             
                        </tr>
                        

                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Filter-->
<div class="modal fade" id="kasaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter Kas</h5>
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
                        <button type="button" data-dismiss="modal" onclick="viewLapBulanKas()" class="btn btn-info btn-block">View</button>  
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
                        <button type="button" data-dismiss="modal" onclick="viewLapTahunKas()" class="btn btn-info btn-block">View</button>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function viewLapBulanKas(){
        let bulan = $('#bulan').val();
        let tahun = $('#tahun').val();
        if (bulan == '') {
            alert('Bulan Belum Dipilih!');
        }else if (tahun == '') {
            alert('Tahun Belum Dipilih!');
        }else{
            $.ajax({
                type: "GET",
                url: "<?= base_url('petugas/viewLapBulanKas');?>",
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
    function viewLapTahunKas(){
        let tahun = $('#tahun2').val();
        if (tahun == '') {
            alert('Tahun Belum Dipilih!');
        }else{
            $.ajax({
                type: "GET",
                url: "<?= base_url('petugas/viewLapTahunKas');?>",
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
        // var css = '@page { size: landscape; }';
        // head = document.head || document.getElementsByTagName('head')[0];
        // style = document.createElement('style');
        // style.type = 'text/css';
        // style.media = 'print';
        // if (style.styleSheet){
        //     style.styleSheet.cssText = css;
        // }else{
        //     style.appendChild(document.createTextNode(css));
        // }

        // head.appendChild(style);
        var newstr=document.getElementById("printarea").innerHTML;
                //You can set height width over here
        var popupWin = window.open('', '_blank', 'width=1100,height=600');
        popupWin.document.open();
        popupWin.document.write('<html><style> th{text-align: left;}</style> <body onload="window.print()">'+ newstr + '</html>');
        popupWin.document.close(); 
        return false;
    }
</script>
