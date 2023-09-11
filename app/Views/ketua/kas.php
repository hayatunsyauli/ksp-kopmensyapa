<div class="col-md-12">
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
    <div class="alert alert-info alert-dismissible">
      <h5>Saldo Kas Koperasi</h5>
      Debet : Rp. <?= number_format(array_sum($debet),0);?><br>
      Credit : Rp. <?= number_format(array_sum($credit),0);?>
      
      <hr>
      <h3>Saldo Akhir : Rp. <?= number_format($saldoakhir,0);?></h3>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $title;?></h3>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table class="table p-0 table-hover table-striped table-bordered" id="example1">
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
                   <td><?= date('d-M-y', strtotime($value['tanggal']) )?></td>
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
                    <form method="post" action="/kas/addCodeUraian">
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