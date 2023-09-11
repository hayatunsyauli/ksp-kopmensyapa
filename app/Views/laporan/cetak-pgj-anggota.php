    <style>
        body{
            font-family: Arial, Helvetica, sans-serif ;
            font-size: 12px;
        }
        table {
            font-family: Arial, Helvetica, sans-serif ;
            border-collapse: collapse;
            border: 1;
            text-align: center;
            font-size: 12px;
            width: 100%;
        }

        td,tr {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }



       /* tr:nth-child(even) {
            background-color: #dddddd;
        }*/

        table.table_pinjaman tr,table.table_pinjaman td,table.table_pinjaman th{
            border: hidden;
        }

        table.table_header tr,table.table_header td,table.table_header th{
            border: hidden;
        }
         table.table_content tr,table.table_content td,table.table_content th{
            border: 1px solid #dddddd;
        }
        .table_content{
            font-family: Arial, Helvetica, sans-serif ;
            text-align: center;
            font-size: 12px;
            width: 100%;
        }
    </style>
<h3>1. Data Pengajuan</h3>

<table class="table_header" style="width:70%;">
    <tr>
        <th>Kode Pengajuan</th>
        <th>:</th>
        <td style="width:70%"><?= $pengajuan['id_pengajuan'];?></td>
    </tr>
    <tr>
        <th>No Anggota</th>
        <th>:</th>
        <td><?= $pengajuan['no_anggota'];?></td>
    </tr>
    <tr>
        <th>Nama Anggota</th>
        <th>:</th>
        <td><?= $pengajuan['nama'];?></td>
    </tr>
    <tr>
        <th>Tanggal Pengajuan</th>
        <th>:</th>
        <td><?= date('d-m-Y', strtotime($pengajuan['tgl_pengajuan']));?></td>
    </tr>
    <tr>
        <th>Jenis Pinjaman</th>
        <th>:</th>
        <td><?php 
        if ($pengajuan['id_jenis_pinjaman'] == 1) {
             echo 'Pinjaman Jangka Pendek';
         }else if ($pengajuan['id_jenis_pinjaman'] == 2) {
            echo 'Pinjaman Jangka Panjang';
         } else{
             echo 'Pinjaman BKD';
         } ?>
        </td>
    </tr>
    <tr>
        <th>Besar Pinjaman</th>
        <th>:</th>
        <td>Rp <?= number_format($pengajuan['bsr_pengajuan']);?></td>
    </tr>
    <tr>
        <th>Lama Angsuran</th>
        <th>:</th>
        <td><?= $pengajuan['lama_angsuran'];?> (Bulan)</td>
    </tr>
    <tr>
        <th>Status Pengajuan</th>
        <th>:</th>
        <td><?= $pengajuan['status_pengajuan'];?></td>
    </tr>
    <tr>
        <th>Jumlah Emas (Gram/g) </th>
        <th>:</th>
        <td><?= $pengajuan['jml_emas'];?></td>
    </tr>
    <tr>
        <th>Verifikasi Sekretaris</th>
        <th>:</th>
        <td><?php 
        if ($pengajuan['tgl_veri_sekretaris'] == null) {
             echo 'Belum Diverifikasi';
         } else {
            echo 'Telah Diverifikasi';
         } ?>
    </tr>
    <tr>
        <th>Verifikasi Ketua</th>
        <th>:</th>
        <td><?php if ($pengajuan['tgl_verifikasi'] == null) {
             echo 'Belum Diverifikasi';
         } else {
            echo 'Telah Diverifikasi';
         } ?>
    </tr>            
</table>
  