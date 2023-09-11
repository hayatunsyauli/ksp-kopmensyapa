
    <h4 style="text-align: center;">Bukti Kas Debet</h4>
        <table class="table table-sm table-borderless">
            <tr>
                <th style="width: 15%;">Diterima Dari/Ke</th>
                <th>:</th>
                <td><?= $kas['ke'];?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <th>:</th>
                <td><i>Rp  <?= number_format($nominalKas);?></i>
                </td>
            </tr>
            <tr>
                <th>Terbilang</th>
                <th>:</th>
                <td><i><?= ucwords($terbilang);?></i>
                </td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <th>:</th>
                <td><?= $kas['uraian'];?></td>
            </tr>
            <tr>
                <th>Tanggal Kas</th>
                <th>:</th>
                <td><?= date('d-m-Y', strtotime($kas['tanggal_kas']));?></td>
            </tr>
            <tr>
                <th>Tanggal Cetak</th>
                <th>:</th>
                <td><?= date('d-m-Y');?></td>
            </tr>
<!--             <tr>
                <td colspan="2"></td>
                <td style="vertical-align: baseline !important;">Jumlah : </td>
            </tr> -->
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