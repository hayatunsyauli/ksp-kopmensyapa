    <h4 style="text-align: center;">Bukti Transaksi Pinjaman</h4>
        <table class="table_header table table-sm">
            <tr>
                <th>No Anggota</th>
                <th>:</th>
                <td><?= $angsuran['no_anggota'];?></td>
            </tr>
            <tr>
                <th>Nama Anggota</th>
                <th>:</th>
                <td><?= $angsuran['nama'];?></td>
            </tr>
            <tr>
                <th>Kode Pinjaman</th>
                <th>:</th>
                <td style="width:70%"><?= $angsuran['id_pinjaman'];?></td>
            </tr>
            <tr>
                <th>Besar Pinjaman</th>
                <th>:</th>
                <td>Rp <?= number_format($angsuran['jml_angsuran']);?></td>
            </tr>
            <tr>
                <th>Besar Angsuran</th>
                <th>:</th>
                <td>Rp <?= number_format($angsuran['angsuran_pembayaran']);?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>:</th>
                <td><?= date('d-m-Y', strtotime($angsuran['tgl_angsuran']));?></td>
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
                    <?= $angsuran['nama'];?></td>
                <td style="text-align: right; ">
                    <?= session()->get('nama');?></td>
                <!-- <td></td> -->
            </tr>
        </tbody>
    </table>

<!-- 
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
            //alert(document.getElementById("printpage").innerHTML);
            var newstr=document.getElementById("printpage").innerHTML;

            // var header='<table  class="table_header"><tbody><tr><td rowspan="3" width="16%" class="text-center"><img src="/img/logo.png" width="150"></td><td class="text-center"><span style="line-height: 1.6; font-weight: bold;">KOPERASI SIMPAN PINJAM KARYAWAN POLITEKNIK ACEH<br>Jl. Politeknik Aceh, No.1, Desa Pango Raya, Kecamatan Ulee Kareng,<br>KOTA BANDA ACEH</span></td><td rowspan="3" width="16%">&nbsp;</td></tr><tr></tr></tbody></table><hr>'

            // var footer ="Your Footer";

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
 -->