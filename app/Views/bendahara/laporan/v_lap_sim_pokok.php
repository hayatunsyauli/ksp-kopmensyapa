
    <?php 
        if ($simpan == null) {
            $simpanPokok[] = 0;
            // $credit[] = 0;
        }else{
            foreach ($simpan as $value) {
                $simpanPokok[] = $value['simpanan_pokok'];
                // $credit[] = $value['kas_credit'];
            }
        } 
        // $saldoakhir = array_sum($debet) - array_sum($credit);
    ?>
<?= !empty($tanggal) ? '<p class="float-right">Filter Tanggal: '.$tanggal.'</p><br>' : '';?>
<?= !empty($bulan) ? '<p class="float-right">Filter Bulan: '.$bulan.'</p><br>' : '';?>
<?= !empty($tahun) ? '<p class="float-right">Filter Tahun: '.$tahun.'</p><br>' : '';?>
<table class="table table-sm table-bordered table_pinjaman">
  <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No Anggota</th>
        <th>Status Anggota</th>
        <th>Status Simpanan</th>
        <th>Simpanan Pokok</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $no = 1;
        foreach ($simpan as $s) : ?>
        <tr>
            <td><?= $no++;?></td>
            <td><?= $s['nama'];?></td>
            <td><?= $s['no_anggota'];?></td>
            <td><?= $s['status_anggota'];?></td>
            <td><?= $s['status_simpanan'];?></td>
            <td class="text-right">
                <!-- 
                < ?php if ($jenis == 1): ?>
                    
                < ?php endif ?>
 -->
                Rp <?= number_format($s['simpanan_pokok']);?>
                    
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <th colspan="5" class="text-center">TOTAL</th>
            <th class="text-right">Rp <?= number_format(array_sum($simpanPokok));?></th>
        </tr>
        <tr>
            <th colspan="6" class="text-right"><i><?= ucwords(terbilang(array_sum($simpanPokok)));?></i></th>
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