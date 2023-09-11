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
<div class="row">
    <div class="col-12">
      <h4><i class="fas fa-globe"></i> <?= $judul;?></h4>
    </div>
<!-- /.col -->
</div>
<?= !empty($tanggal) ? '<p class="float-right">Filter Tanggal: '.$tanggal.'</p><br>' : '';?>
<?= !empty($bulan) ? '<p class="float-right">Filter Bulan: '.$bulan.'</p><br>' : '';?>
<?= !empty($tahun) ? '<p class="float-right">Filter Tahun: '.$tahun.'</p><br>' : '';?>
<table class="table-bordered table_pinjaman"  >
  <thead >
    <tr class="text-center">
        <th>No</th>
        <th style="width: 400px">Uraian</th>
        <th>Code Account/Uraian</th>
        <th>Dari/ke</th>
        <th>Tanggal</th>
        <th>Kas Debet</th>
        <th>Kas Kredit</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $no = 1;
        foreach ($kas as $value) { ?>
        <tr>
           <td class="text-center"><?= $no++;?></td>
            <td><?= $value['uraian'];?></td>
            <td><?= $value['code_uraian'];?></td>
            <td><?= $value['ke'];?></td>
            <td><?= date('d-m-Y', strtotime($value['tanggal_kas']) )?></td>
            <td style="text-align: right;">Rp. <?= number_format($value['kas_debit']);?></td>
            <td style="text-align: right;">Rp. <?= number_format($value['kas_credit']);?></td>
        </tr>
    <?php } ?>
        <tr>
            <th class="text-center" colspan="5">Total</th>
            <th class="text-right">Rp <?= number_format(array_sum($debet));?></th>
            <th class="text-right">Rp <?= number_format(array_sum($credit));?></th>
        </tr>
        <tr>
            <!-- <th colspan="6" class="text-right"><i>< ?= ucwords(terbilang(array_sum($debet)));?></i></th> -->
        </tr>
  </tbody>
</table>

    <table class="table_header" style="margin-top: 30px;">
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
