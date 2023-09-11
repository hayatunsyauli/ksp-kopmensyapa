<?php 
    if ($kas == null) {
        $kasDebet[] = 0;
        // $credit[] = 0;
    }else{
        foreach ($kas as $value) {
            $kasDebet[] = $value['kas_debit'];
            // $credit[] = $value['kas_credit'];
        }
    } 
    // $saldoakhir = array_sum($debet) - array_sum($credit);
?>
<div class="row">
    <div class="col-12">
      <h4><i class="fas fa-globe"></i> <?= $judul;?></h4>
    </div>
<!-- /.col -->
</div>
<?= !empty($tanggal) ? '<p class="float-right">Filter Tanggal: '.$tanggal.'</p><br>' : '';?>
<?= !empty($bulan) ? '<p class="float-right">Filter Bulan: '.$bulan.'</p><br>' : '';?>
<?= !empty($tahun) ? '<p class="float-right">Filter Tahun: '.$tahun.'</p><br>' : '';?>
<table class="table table-sm table-bordered table_pinjaman"  >
  <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th style="width: 450px">Uraian</th>
        <th>Code Account/Uraian</th>
        <th>Dari/ke</th>
        <th>Kas Debet</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $no = 1;
        foreach ($kas as $value) { ?>
        <tr>
           <td><?= $no++;?></td>
           <td><?= date('d-m-Y', strtotime($value['tanggal_kas']) )?></td>
            <td><?= $value['uraian'];?></td>
            <td><?= $value['code_uraian'];?></td>
            <td><?= $value['ke'];?></td>
            <td style="text-align: right;">Rp. <?= number_format($value['kas_debit']);?></td>
        </tr>
    <?php } ?>
        <tr>
            <th class="text-center" colspan="5">Total</th>
            <th class="text-right">Rp <?= number_format(array_sum($kasDebet));?></th>
        </tr>
        <tr>
            <th colspan="6" class="text-right"><i><?= ucwords(terbilang(array_sum($kasDebet)));?></i></th>
        </tr>
  </tbody>
</table>

    <table class="table-borderless" style="margin-top: 30px;">
        <tbody style="">
            <tr>
                <td style=" text-align: right; width:100%;">Banda Aceh, <?= tanggal() ?></td>
            </tr>
            <tr style="background-color: #fff;  ">
                <td style="text-align: right;">
                    Bendahara
                </td>
            </tr>
            <tr>
                <td style="height: 40px;"></td>
                <td style="text-align: right; ">
                    <!-- <img src=" < ?= base_url() ?>assets//stempel.png" width="20%"> -->
                </td>
                <!-- <td></td> -->
            </tr>
            <tr style="background-color: #fff;  ">
                <td style="text-align: right; ">
                    <?= session()->get('nama');?></td>
                <!-- <td></td> -->
            </tr>
        </tbody>
    </table>
    