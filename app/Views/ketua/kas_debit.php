<div class="col-md-12">
    <?php 
    if ($kas == null) {
        $debet[] = 0;
        
    }else{
        foreach ($kas as $value) {
            $debet[] = $value['kas_debit'];
            
        }
    } 
    ?>
    <div class="alert alert-success alert-dismissible">
      <h5>Saldo Kas Debet Koperasi</h5>     
      <hr>
      <h3>Saldo Akhir Debet: Rp. <?= number_format(array_sum($debet),0);?></h3>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title"><?= $title;?></h3>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table p-0 table-hover table-bordered" id="example1">
      <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th style="width: 450px">Uraian</th>
            <th>Code Account/Uraian</th>
            <th>Dari/ke</th>
            <th>Kas Debet</th>
            <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
            $no = 1;
            foreach ($kas as $value) { ?>
            <tr class="<?= $value['status'] == 'Debet' ? 'text-success' : 'text-danger';?>">
               <td><?= $no++;?></td>
               <td><?= date('d-M-y', strtotime($value['tanggal_kas']) )?></td>
                <td><?= $value['uraian'];?></td>
                <td><?= $value['code_uraian'];?></td>
                <td><?= $value['ke'];?></td>
                <td style="text-align: right;">Rp. <?= number_format($value['kas_debit']);?></td>
                <td class="text-center">
                    <form method="post" action="<?= base_url('ketua/cetakInvoiceKasDebet/'.$value['id_kas']);?>" class="d-inline">
                        <input type="hidden" name="kasdebet" value="<?= $value['kas_debit'];?>">
                        <button  formtarget="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></button>                        
                    </form>
                    <!-- <a href="" class="btn btn-danger" ><i class="fa fa-trash"></i></a> -->
                </td>                                
            </tr>
        <?php } ?>
      </tbody>
    </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>

    <!-- Modal Create KAS Debet.-->
    <div class="modal fade" id="kasdebet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="/kas/prosesAddKasDebet">
            <?= csrf_field();?>
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kas Debet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <div class="form-group row">
                             <!-- <input type="text" name="id" value="" class="form-control" readonly> -->
                        <div class="mb-3 col-sm-12">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                          </div>
                        <div class="mb-3 col-sm-12">
                            <label>Uraian</label>
                             <input type="text" name="uraian" class="form-control" autofocus required>
                        </div>
                        <div class="mb-3 col-sm-12">
                            <label>Code Account/Uraian</label>
                            <select class="form-control select2bs4" style="height: 50%;" name="id_uraian">
                                <option selected="selected">Pilih</option>
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
                            <label>Jumlah</label>
                                <input type="number" name="kasdebet" class="form-control" required>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </div>
        </form>
      </div>
    </div>

    <!-- Modal Edit KAS Debet.-->
    <?php foreach ($kas as $key => $value) { ?>
     <div class="modal fade" id="editdebet<?= $value['id_kas'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <form method="post" action="/kas/prosesUpdateKasDebet/<?= $value['id_kas'];?>">
                <?= csrf_field();?>
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kas Debet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <input type="hidden" name="id" value="<?= $value['id_kas'];?>" class="form-control" readonly>
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
                                <select class="form-control select2bs4" style="height: 50%;" name="id_uraian">
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
                                    <input type="number" name="kasdebet" value="<?= $value['kas_debit'];?>" class="form-control" required>
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </div>
            </form>
          </div>
        </div>

    <?php } ?>
   