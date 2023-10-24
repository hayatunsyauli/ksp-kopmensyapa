<div class="col-md-12">
    <?php 
    if ($kas == null) {
        $credit[] = 0;
        
    }else{
        foreach ($kas as $value) {
            $credit[] = $value['kas_credit'];
            
        }
    } 
    ?>
    <div class="alert alert-danger alert-dismissible">
      <h5>Saldo Kas Kredit Koperasi</h5>     
      <hr>
      <h3>Saldo Akhir Kredit: Rp. <?= number_format(array_sum($credit),0);?></h3>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-danger">
      <div class="card-header">
        <h3 class="card-title"></h3>

        <div class="card-tools">
              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#kasdebet"><i class="fas fa-plus"></i>&nbsp; Tambah
              </button>
              <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#kasaccount"><i class="fas fa-search"></i>&nbsp; Filter
              </button>
              <button type="submit" onclick="printLaporan()" class="btn btn-secondary btn-sm">Print</button>

              <button onClick="window.location.href=window.location.href" class="btn btn-warning btn-sm"><i class="fas fa-redo-alt"></i></button>
              </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?php 
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-danger">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            if (session()->getFlashdata('gagal')) {
                echo '<div class="alert alert-warning">';
                echo session()->getFlashdata('gagal');
                echo '</div>';
            } 
        ?>
        <div class="table" id="printarea">
             <table class="table table-sm table-hover table-bordered" id="example1">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th style="width: 450px">Uraian</th>
                    <th>Code Account/Uraian</th>
                    <th>Dari/ke</th>
                    <th>Kas Kredit</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $no = 1;
                    foreach ($kas as $value) { ?>
                    <tr class="<?= $value['status'] == 'Debet' ? 'text-danger' : 'text-danger';?>">
                       <td><?= $no++;?></td>
                       <td><?= date('d-m-Y', strtotime($value['tanggal_kas']) )?></td>
                        <td style="width: 32%"><?= $value['uraian'];?></td>
                        <td><?= $value['code_uraian'];?></td>
                        <td><?= $value['ke'];?></td>
                        <td style="text-align: right;">Rp. <?= number_format($value['kas_credit']);?></td>
                        <td class="text-center"> 
                            <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editkredit<?= $value['id_kas'];?>"><i class="fas fa-pen"></i>
                            </button>
                        
                            <form action="/kas/deleteKredit/<?= $value['id_kas'];?>" method="post" class="d-inline">
                                <?= csrf_field();?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin ingin mengahapus?');"><i class="fas fa-trash"></i></button>
                            </form>

                            <form method="post" action="<?= base_url('kas/cetakInvoiceKasKredit/'.$value['id_kas']);?>" class="d-inline">
                                <input type="hidden" name="kasdebet" value="<?= $value['kas_credit'];?>">
                                <button  formtarget="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></button>                        
                            </form>
                            <!-- <a href="" class="btn btn-danger" ><i class="fa fa-trash"></i></a> -->
                        </td>                                
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

    <!-- Modal Create Kas Kredit-->
    <div class="modal fade my-modal" id="kasdebet" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="<?php echo base_url('kas/prosesAddKasKredit') ?>">
            <?= csrf_field();?>
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kas Kredit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <div class="form-group row">
                             <!-- <input type="text" name="id" value="" class="form-control" readonly> -->
                        <div class="mb-3 col-sm-12">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="reservation" required>
                          </div>
                        <div class="mb-3 col-sm-12">
                            <label>Uraian</label>
                             <input type="text" name="uraian" class="form-control" autofocus required>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Code Account/Uraian</label>
                            <select class="form-control" id="select2" name="id_uraian">
                                <option selected="diselected">Pilih</option>
                                <?php foreach ($uraiann as $value) { ?>
                                <option value="<?= $value['id_uraian'];?>"><?= $value['code_uraian'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Dari/Ke</label>
                                <input type="text" name="ke" class="form-control" required>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Jumlah Kas Kredit</label>
                                <input type="number" name="kaskredit" class="form-control" required>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Simpan</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <!-- Modal Edit KAS Debet.-->
    <?php foreach ($kas as $key => $value) { ?>
     <div class="modal fade my-modal" id="editkredit<?= $value['id_kas'];?>"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form method="post" action="<?php echo base_url('kas/prosesUpdateKasKredit/'.$value['id_kas']) ?>">
                <?= csrf_field();?>
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kas Kredit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                                 <!-- <input type="text" name="id" value="" class="form-control" readonly> -->
                            <div class="mb-3 col-sm-12">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" value="<?= $value['tanggal_kas'];?>" class="form-control" required>
                              </div>
                            <div class="mb-3 col-sm-12">
                                <label>Uraian</label>
                                 <input type="text" name="uraian" value="<?= $value['uraian'];?>" class="form-control" autofocus required>
                            </div>
                            <div class="mb-3 col-sm-12">
                                <label>Code Account/Uraian</label>
                                <select class="form-control" id="select2" name="id_uraian">
                                    <option value="<?= $value['id_uraian'];?>"><?= $value['code_uraian'];?></option>
                                    <?php foreach ($uraiann as $valuee) { ?>
                                    <option value="<?= $valuee['id_uraian'];?>"><?= $valuee['code_uraian'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3 col-sm-12">
                                <label>Dari/Ke</label>
                                    <input type="text" name="ke" value="<?= $value['ke'];?>" class="form-control" required>
                            </div>
                            <div class="mb-3 col-sm-12">
                                <label>Jumlah</label>
                                    <input type="number" name="kasdebet" value="<?= $value['kas_credit'];?>" class="form-control" required>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Update</button>
                  </div>
                </div>
            </form>
          </div>
        </div>

    <?php } ?>
   
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
                        <button type="button" data-dismiss="modal" onclick="viewLapBulanKasKredit()" class="btn btn-info btn-block">View</button>  
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
                        <button type="button" data-dismiss="modal" onclick="viewLapTahunKasKredit()()" class="btn btn-info btn-block">View</button>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function viewLapBulanKasKredit(){
            let bulan = $('#bulan').val();
            let tahun = $('#tahun').val();
            if (bulan == '') {
                alert('Bulan Belum Dipilih!');
            }else if (tahun == '') {
                alert('Tahun Belum Dipilih!');
            }else{
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('petugas/viewLapBulanKasKredit');?>",
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
        function viewLapTahunKasKredit(){
            let tahun = $('#tahun2').val();
            if (tahun == '') {
                alert('Tahun Belum Dipilih!');
            }else{
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('petugas/viewLapTahunKasKredit');?>",
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