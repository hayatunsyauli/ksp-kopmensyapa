<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title;?></title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/dist/css/adminlte.min.css">
  <link rel="icon" href="/img/logo.jpeg" sizes="35x35" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/dashboard/vendors/bootstrap/dist/css/bootstrap.min.css">

      <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>
<body>
<body onload="printdiv()" id="printpage">
    <table style="font-family: Arial, Helvetica, sans-serif ;border-collapse: collapse;border: 1;text-align: center;font-size: 12px;width: 100%;">
        <tbody>
            <tr>
                <td rowspan="3" width="16%" class="text-center">
                    <img src="/img/logo.png" width="100">   
                </td>
                <td class="text-center">
                    <span style="line-height: 1.6; font-weight: bold;">KOPERASI KONSUMEN SYARIAHS POLITEKNIK ACEH<br>
                        Jl. Politeknik Aceh, No.1, Desa Pango Raya, Kecamatan Ulee Kareng,<br>
                        KOTA BANDA ACEH
                    </span>
                </td>
                <td rowspan="3" width="16%">&nbsp;</td>
            </tr>
            <tr>
                
            </tr>
        </tbody>
    </table>
    <hr>
    <h4 style="text-align: center;">Bukti Transaksi Penarikan</h4>
        <table class="table_pinjaman table-sm" style="font-family: Arial, Helvetica, sans-serif;font-size: 12px;width: 100%;">
            <tr>
                <th>No Anggota</th>
                <th>:</th>
                <td style="width:70%"><?= $penarikan['no_anggota'];?></td>
            </tr>
            <tr>
                <th>Nama Anggota</th>
                <th>:</th>
                <td><?= $penarikan['nama'];?></td>
            </tr>
            <tr>
                <th>Status Anggota</th>
                <th>:</th>
                <td><?= $penarikan['status_anggota'];?></td>
            </tr>
            <tr>
                <th>Jumlah Penarikan</th>
                <th>:</th>
                <td>Rp <?= number_format($penarikan['kredit']);?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>:</th>
                <td><?= date('d-m-Y', strtotime($penarikan['tanggal']));?></td>
            </tr>
        </table>
    <hr>
    
    <table class="table-borderless" style="margin-top: 30px;">
        <tbody style="">
            <tr>
                <td style=" text-align: right; width: 55%;">Banda Aceh, <?= tanggal() ?></td>

                <td style=" text-align: right; width: 45%; ">Banda Aceh, <?= tanggal() ?></td>
                <!-- <td></td> -->
            </tr>
            <tr style="background-color: #fff;  ">
                <td style="text-align: right;">
                    Anggota
                </td>
                <td style="text-align: right;">
                    Bendahara
                </td>
                <!-- <td></td> -->
            </tr>
            <tr>
                <td style="height: 40px;"></td>
                <td style="text-align: right;">
                    <!-- <img src=" < ?= base_url() ?>assets//stempel.png" width="20%"> -->
                </td>
                <td style="text-align: right; ">
                    <!-- <img src=" < ?= base_url() ?>assets//stempel.png" width="20%"> -->
                </td>
                <!-- <td></td> -->
            </tr>
            <tr style="background-color: #fff;  ">
                <td style="text-align: right;">
                    <?= $penarikan['nama'];?></td>
                <td style="text-align: right; ">
                    <?= session()->get('nama');?></td>
                <!-- <td></td> -->
            </tr>
        </tbody>
    </table>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

<script type="text/javascript">
    // window.onload=()=>window.print();

    function printdiv(){
        //your print div data
        var newstr=document.getElementById("printpage").innerHTML;
        //You can set height width over here
        var popupWin = window.open('', '_blank', 'width=1100,height=600');
        popupWin.document.open();
        popupWin.document.write('<html><style> th{text-align: left;}</style> <body onload="window.print()">'+ newstr + '</html>');
        popupWin.document.close(); 
        return false;
    }
</script>

</body>
</html>
