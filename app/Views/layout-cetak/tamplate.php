<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title;?></title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/dist/css/adminlte.min.css">
  <link rel="icon" href="/img/logo.jpeg" sizes="35x35" />

  <link rel="stylesheet" href="<?= base_url('AdminLTE');?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <style type="text/css">
      body{
           /* font-family: Arial, Helvetica, sans-serif ;
            font-size: 16px;*/
        }
        /*table {
            font-family: Arial, Helvetica, sans-serif ;
            border-collapse: collapse;
            border: 1;
            text-align: center;
            font-size: 15px;
            width: 100%;
        }*/

        td,tr {
            border: hidden;
/*            border: 1px solid #dddddd;*/
            text-align: left;
/*            padding: 2px;*/
        }
        table.table_pinjaman tr,table.table_pinjaman td,table.table_pinjaman th{
            border: 1px solid #dddddd;
        }

        table.table_header tr,table.table_header td,table.table_header th{
/*            border: hidden;*/
            
        }
        table.table_content tr,table.table_content td,table.table_content th{
            border: 1px solid #dddddd;}
        style="
        }
        /*
        table.table_pinjaman tr,table.table_pinjaman td,table.table_pinjaman th{
            border: 1px solid #dddddd;
        }*/
  </style>

      <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

</head>

<body onload="print()">
    <table  class="table_header" style="font-family: Arial, Helvetica, sans-serif ;border-collapse: collapse;border: 1;text-align: center;font-size: 12px;width: 100%; padding-bottom: 10px;">
        <tbody>
            <tr>
                <td rowspan="3" width="16%" class="text-center">
                    <img src="<?php echo base_url('/img/logo.png') ?>" width="150">
                </td>
                <td class="text-center">
                    <span style="line-height: 1.6; font-weight: bold;">KOPERASI KONSUMEN SYARIAH POLITEKNIK ACEH<br>
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
<!-- Main content -->    
          <?php if ($page) {
            echo view($page);
          } ?>
    


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('AdminLTE');?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('AdminLTE');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('AdminLTE');?>/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url('AdminLTE');?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('AdminLTE');?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('AdminLTE');?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('AdminLTE');?>/dist/js/adminlte.min.js"></script>


</body>

</html>