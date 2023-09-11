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
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dashboard/vendors/bootstrap/dist/css/bootstrap.min.css">

      <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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
            padding: 5px;
        }



       /* tr:nth-child(even) {
            background-color: #dddddd;
        }*/

        table.table_pinjaman tr,table.table_pinjaman td,table.table_pinjaman th{
            border: 1px solid #dddddd;

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
            font-size: 10px;
            width: 100%;
        }
    </style>
</head>

<body onload="print()">
    <table  class="table_header">
        <tbody>
            <tr>
                <td rowspan="3" width="16%" class="text-center">
                    <img src="/img/logo.png" width="150">
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
    
    <table class="table table-borderless" style="margin-top: 50px;">
    <tbody>
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

<script>
    // $(document).ready(function() {
    //     $('#mauexport').DataTable( {
    //         dom: 'Bfrtip',
    //         buttons: [
    //             {
    //                 extend: 'excel',
    //                 exportOptions: {
    //                     columns: ':visible'
    //                 },   
    //             },
    //         ],

    //         "bFilter": false
    //     } );
    // } );
</script>
<script>
    var css = '@page { size: landscape; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');
    style.type = 'text/css';
    style.media = 'print';
    if (style.styleSheet){
        style.styleSheet.cssText = css;
    }else{
        style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);

</script>

</body>

</html>