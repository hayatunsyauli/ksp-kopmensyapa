<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Daftar Data Pinjaman</h3>
        <!-- Button trigger modal -->
                
        <div class="card-tools">
          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#codeaccount"><i class="fas fa-search"></i>&nbsp; Filter
          </button>
          <button type="submit" onclick="printLaporan()" class="btn btn-info btn-sm">Print</button>&nbsp;

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
             <table class="table p-0 table-hover table-striped table-bordered" id="example2">
               <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pinjaman</th>
                        <th>Tanggal Pinjam</th>
                        <th>Nama</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Lama Angsuran</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    $no = 1;
                    foreach ($pinjaman as $jp) : ?>
                    <tr>
                        <td><?= $no++;?></td>
                        <td><?= $jp['id_pinjaman'];?></td>
                        <td><?=date('d-m-Y', strtotime($jp['tgl_pinjam']));?></td>
                        <td><?= $jp['nama'];?><br><small><?= $jp['no_anggota'];?></small></td>
                        <td class="text-right">Rp. <?= number_format($jp['jml_angsuran']);?></td>
                        <td>
                           <?= $jp['lama_angsuran'];?> Bulan<br>
                           <small><?= $jp['jenis_pinjaman'];?></small>
                        </td>
                        <td>
                            <?= date('d-m-Y', strtotime($jp['tgl_jth_tempo']));?>
                        </td> 
                        <td class="text-center">
                            <?php if ($jp['status_pinjaman'] == "Belum Lunas") { ?>
                            <span class="badge badge-danger">Belum Lunas</span>
                            <?php } else{?>
                            <span class="badge badge-info">Lunas </span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                         <?php if ($jp['status_pinjaman'] == "Belum Lunas") { ?>
                            <a href="<?= base_url('bendahara/detailAngsuran/'.$jp['id_pinjaman']);?>" class="btn btn-xs btn-info" data-placement="bottom" title="Detail Pinjaman"><i class="fas fa-eye"></i></a>
                            <a href="<?= base_url('bendahara/setorAngsuran/'.$jp['id_pinjaman']);?>" class="btn btn-xs btn-warning" data-placement="bottom" title="Setor Pinjaman">Setor</a><br>
                            <a href="/bendahara/setorLunas/<?= $jp['id_pinjaman'];?>" class="btn btn-xs btn-success" data-placement="bottom" title="Setor Lunas">Setor Lunas</a>

                        <?php } else{?>
                            <a href="<?= base_url('');?>bendahara/detailAngsuran/<?= $jp['id_pinjaman'];?>" class="btn btn-xs btn-info" data-placement="bottom" title="Detail Pinjaman"><i class="fas fa-eye"></i></a>

                        <?php } ?>
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
                    <div class="col-sm-3">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">Tahun</option>
                            <?php 
                            $mulai = date('Y') - 10;
                            for ($i=$mulai; $i < $mulai + 11; $i++) { 
                                echo '<option value="'. $i .'">'. $i .'</option>';
                             } ?>
                        </select>
                    </div>
                    <!-- <label class="col-xs-1 pl-2">Jns. Pinjaman</label> -->
                    <div class="col-sm-5">
                        <select name="jenis_pinjaman" id="jenis_pinjaman" class="form-control">
                            <option value="">Jenis Pinjaman</option>
                            <?php 
                            foreach ($jenisPinjam as $key => $value) {
                                echo '<option value="'. $value['id'] .'">'. $value['jenis_pinjaman'] .'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" onclick="viewLapBulanPinjaman()" class="btn btn-info btn-block" data-dismiss="modal">View</button>
                    </div>
                </div>
                <label class="col-xs-1">Filter Tahunan</label>
                <div class="row mb-3">
                    <div class="col-sm-2">
                        <select name="tahun" id="tahun2" class="form-control">
                            <option value="">Tahun</option>
                            <?php 
                            $mulai = date('Y') - 10;
                            for ($i=$mulai; $i < $mulai + 11; $i++) { 
                                echo '<option value="'. $i .'">'. $i .'</option>';
                             } ?>
                        </select>
                    </div>
                    <!-- <label class="col-xs-1">Jns. Pinjaman</label> -->
                    <div class="col-sm-8">
                        <select name="jenis_pinjaman" id="jenis_pinjaman2" class="form-control">
                            <option value="">Jenis Pinjaman</option>
                            <?php 
                            foreach ($jenisPinjam as $key => $value) {
                                echo '<option value="'. $value['id'] .'">'. $value['jenis_pinjaman'] .'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" onclick="viewLapTahunPinjaman()" class="btn btn-info btn-block" data-dismiss="modal">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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