<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Data Pinjaman</h3>
            <!-- Button trigger modal -->

            <div class="card-tools">

            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <?php
            if (session()->getFlashdata('pesan')) {

                echo session()->getFlashdata('pesan');
            }
            if (session()->getFlashdata('gagal')) {
                // echo '<div class="alert alert-danger">';
                echo session()->getFlashdata('gagal');
                // echo '</div>';
            } ?>
            <table class="table p-0 table-hover table-striped table-bordered" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pengajuan</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Lama Angsuran</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                        foreach ($pinjaman as $jp) : 
                            if ($jp['status_pinjaman'] == "Belum Lunas") { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $jp['id_pinjaman']; ?></td>
                            <td><?= date('d-m-Y', strtotime($jp['tgl_pinjam'])); ?></td>
                            <td class="text-right">Rp. <?= number_format($jp['jml_angsuran']); ?></td>
                            <td><?= //$hitungangsur.' dari ' . 
                            $jp['lama_angsuran']; ?> Bulan</td>
                            <td>
                                <?= date('d-m-Y', strtotime($jp['tgl_jth_tempo'])); ?>
                            </td>
                            <td class="text-center">
                                <?php if ($jp['status_pinjaman'] == "Belum Lunas") { ?>
                                    <span class="badge badge-danger">Belum Lunas</span>
                                <?php } else { ?>
                                    <span class="badge badge-info">Lunas </span>
                                <?php } ?>
                            </td>
                            <td><a href="<?php echo base_url(); ?>anggota/detailPengajuan/<?= $jp['id_pengajuan']?>"class="btn btn-success btn-xs" data-placement="bottom" title="Diterima"><i class="fas fa-eye"></i></a></td>
                        </tr>
                <?php }else{
                    
                     } 
                    endforeach;?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>