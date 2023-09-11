
  <style type="text/css">
      body{
            /*font-family: Arial, Helvetica, sans-serif ;
            font-*/size: 12px;
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
            border: hidden;
/*            border: 1px solid #dddddd;*/
            text-align: left;
/*            padding: 2px;*/
        }
        table.table_pinjaman tr,table.table_pinjaman td,table.table_pinjaman th{
            border: 1px solid #dddddd;
        }

        table.table_header tr,table.table_header td,table.table_header th{
            border: hidden;
        }
         table.table_content tr,table.table_content td,table.table_content th{
            border: 1px solid #dddddd;
        }
        table.table_pinjaman tr,table.table_pinjaman td,table.table_pinjaman th{
            border: 1px solid #dddddd;
        }
  </style>

    <table  class="table_header table-sm">
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