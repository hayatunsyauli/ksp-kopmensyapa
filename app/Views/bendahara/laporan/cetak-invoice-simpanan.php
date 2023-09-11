
    <h4 style="text-align: center;">Bukti Transaksi Simpanan</h4>
        <table class="table_header table table-sm">
            <tr>
                <th>No Anggota</th>
                <th>:</th>
                <td><?= $simpanan['no_anggota'];?></td>
            </tr>
            <tr>
                <th>Nama Anggota</th>
                <th>:</th>
                <td><?= $simpanan['nama'];?></td>
            </tr>
            <tr>
                <th>Jenis Simpanan</th>
                <th>:</th>
                <td style="width:70%"><?= $simpanan['jenis_simpanan'];?></td>
            </tr>
            <tr>
                <th>Besar Simpanan</th>
                <th>:</th>
                <td>Rp <?= number_format($simpanan['debet']);?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>:</th>
                <td><?= date('d-m-Y', strtotime($simpanan['tanggal']));?></td>
            </tr>
        </table>
    <hr>
    
    <table class="table table-sm table-borderless" style="margin-top: 50px;">
        <tbody>
            <tr>
                <td style=" text-align: right;width: 50%;">Banda Aceh, <?= tanggal() ?></td>
                <td style=" text-align: right;width: 30%;">Banda Aceh, <?= tanggal() ?></td>
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
            </tr>
            <tr>
                <td style="text-align: right;">
                    <!-- <img src=" < ?= base_url() ?>assets//stempel.png" width="20%"> -->
                </td>
                <td style="text-align: right;">
                    <!-- <img src=" < ?= base_url() ?>assets//stempel.png" width="20%"> -->
                </td>
                <!-- <td></td> -->
            </tr>
            <tr style="background-color: #fff;  ">
                <td style="text-align: right;">
                    <?= $simpanan['nama'];?></td>
                <td style="text-align: right;">
                    <?= session()->get('nama');?></td>
                <!-- <td></td> -->
            </tr>
        </tbody>
    </table>

