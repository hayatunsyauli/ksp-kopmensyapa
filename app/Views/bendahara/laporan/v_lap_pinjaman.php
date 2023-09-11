
    <?php 
        if ($pinjaman == null) {
            $simpanPokok[] = 0;
            // $credit[] = 0;
        }else{
            foreach ($pinjaman as $value) {
                $simpanPokok[] = $value['jml_angsuran'];
                // $credit[] = $value['kas_credit'];
            }
        } 
        // $saldoakhir = array_sum($debet) - array_sum($credit);
    ?>
<div class="row">
    <div class="col-12">
      <h4><i class="fas fa-globe"></i> <?= $jenis['jenis_pinjaman'];?></h4>
    </div>
<!-- /.col -->
</div>
<?= !empty($tanggal) ? '<p class="float-right">Filter Tanggal: '.$tanggal.'</p><br>' : '';?>
<?= !empty($bulan) ? '<p class="float-right">Filter Bulan: '.$bulan.'</p><br>' : '';?>
<?= !empty($tahun) ? '<p class="float-right">Filter Tahun: '.$tahun.'</p><br>' : '';?>
<table class="table table-sm table-bordered table_pinjaman">
  <thead>
    <tr>
        <th>No</th>
        <th>Kode Pinjaman</th>
        <th>Nama</th>
        <th>No Anggota</th>
        <th>Lama Angsuran</th>
        <th>Tanggal</th>
        <th>Jatuh Tempo</th>
        <th>Status</th>
        <th>Jumlah Pinjaman</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $no = 1;
        foreach ($pinjaman as $jp) : ?>
        <tr>
            <td><?= $no++;?></td>
            <td><?= $jp['id_pinjaman'];?></td>
            <td><?= $jp['nama'];?></td>
            <td><?= $jp['no_anggota'];?></td>
            <td><?= $jp['lama_angsuran'];?> Bulan</td>
            <td><?=date('d-m-Y', strtotime($jp['tgl_pinjam']));?></td>
            <td>
                <?= date('d-m-Y', strtotime($jp['tgl_jth_tempo']));?>
            </td> 
            <td><?= $jp['status_pinjaman'];?></td>
            <td class="text-right">Rp. <?= number_format($jp['jml_angsuran']);?></td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <th colspan="8" class="text-center">TOTAL</th>
            <th class="text-right">Rp <?= number_format(array_sum($simpanPokok));?></th>
        </tr>
        <tr>
            <th colspan="9" class="text-right"><i><?= ucwords(terbilang(array_sum($simpanPokok)));?></i></th>
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