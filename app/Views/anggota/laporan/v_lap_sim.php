    <?php 
        if ($simpan == null) {
            $debet[] = 0;
            $kredit[] = 0;
            // $sukarela[] = 0;
        }else{
            foreach ($simpan as $value) {
                $debet[] = $value['debet'];
                $kredit[] = $value['kredit'];
                // $sukarela[] = $value['simpanan_sukarela'];
            }
            $saldoakhir = array_sum($debet) - array_sum($kredit);
        } 
    ?>

<?= !empty($tanggal) ? '<p style="margin-top: -10px;">Filter Tanggal : '.$tanggal.'</p>' : '';?>
<?= !empty($bulan) ? '<p style="margin-top: -10px;">Filter Bulan : '.$bulan.'</p>' : '';?>
<?= !empty($tahun) ? '<p style="margin-top: -10px;">Filter Tahun : '.$tahun.'</p>' : '';?>

<table class="table table-sm" style="width: 25%; border: 0;">
            <tr >
                <th style="border: 1;">Total Debet</th>
                <td class="text-right"><b>Rp <?= number_format(array_sum($debet),0);?></b></td>
            </tr>
            <tr>
                <th style="border: 1;">Total Kredit</th>
                <td class="text-right"><b>Rp <?= number_format(array_sum($kredit),0);?></b></td>
            </tr>
            <tr>
                <th style="border: 1;"><h5 style="margin-bottom: -2px;margin-top: -5px;">Saldo Akhir</h5></th>
                <td class="text-right"><h5 style="margin-bottom: -2px;margin-top: -5px;">Rp <?= number_format($saldoakhir,0);?></h5></td>
            </tr>
        </table>
            <hr>
<table class="table table-sm table-hover table-bordered table_pinjaman">
  <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jenis Simpanan</th>
        <th>Debet</th>
        <th>Kredit</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $no = 1;
        foreach ($simpan as $jp) : ?>
        <tr class="<?= $jp['status'] == 'Debet' ? 'text-success' : 'text-danger';?>">
            <td><?= $no++;?></td>
            <td><?= date('d-m-Y', strtotime($jp['tanggal'])) ?></td>
            <td><?= $jp['jenis_simpanan'];?></td>
            <td class="text-right">Rp <?= number_format($jp['debet']);?></td>
            <td class="text-right">Rp <?= number_format($jp['kredit']);?></td>
            
        </tr>
    <?php endforeach; ?>
        <tr>
        </tr>
  </tbody>
</table>
