<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Data Anggota</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
            <table class="table_header table table-sm" >
                <tr>
                    <th>No Anggota</th>
                    <th>:</th>
                    <td><?= $simpanan['no_anggota'];?></td>
                </tr>
                <tr>
                    <th>NRP</th>
                    <th>:</th>
                    <td style="width:70%"><?= $simpanan['nrp'];?></td>
                </tr>
                <tr>
                    <th>Nama Anggota</th>
                    <th>:</th>
                    <td><?= $simpanan['nama'];?></td>
                </tr>
                <tr>
                    <th>No Hp</th>
                    <th>:</th>
                    <td><?= $simpanan['nohp'];?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <th>:</th>
                    <td><?= $simpanan['email'];?></td>
                </tr>
                <tr>
                    <th>Tanggal Keanggotaan</th>
                    <th>:</th>
                    <td><?= date('d-m-Y', strtotime($simpanan['created_at']));?></td>
                </tr>
                <tr>
                    <th>Status Anggota</th>
                    <th>:</th>
                    <td><?= $simpanan['status_anggota'];?></td>
                </tr>          
            </table>
      </div>
  </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul;?> </h3>

            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <table class="table table-sm table-bordered table_pinjaman" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Anggota</th>
                        <th>Simpanan Pokok</th>
                        <th>Simpanan Wajib</th>
                        <th>Simpanan Sukarela</th>
                        <th>Status Simpanan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <tr>
                        <td><?= $no++;?></td>
                        <td><?= $simpanan['no_anggota'];?></td>
                        <td class="text-right">Rp <?= number_format($simpanan['simpanan_pokok']);?></td>
                        <td class="text-right">Rp <?= number_format($simpanan['simpanan_wajib']);?></td>
                        <td class="text-right">Rp <?= number_format($simpanan['simpanan_sukarela']);?></td>
                        <td><?= $simpanan['status_simpanan'];?></td>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-right">TOTAL SIMPANAN</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-right">
                        <?php
                        $totalSimpanan[] = $simpanan['simpanan_pokok']+$simpanan['simpanan_wajib']+$simpanan['simpanan_sukarela']; ?>
                        Rp <?= $simpanan == null ? '' : number_format(array_sum($totalSimpanan),0);?><br>
                        </th>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="6"><i><?= ucwords(terbilang(array_sum($totalSimpanan)));?></i></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
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
                    <?= $simpanan['nama'];?></td>
                <td style="text-align: right; ">
                    <?= session()->get('nama');?></td>
                <!-- <td></td> -->
            </tr>
        </tbody>
    </table>           