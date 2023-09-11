<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title"><?= $judul; ?></h3>

            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-info">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            if (session()->getFlashdata('gagal')) {
                echo '<div class="alert alert-danger">';
                echo session()->getFlashdata('gagal');
                echo '</div>';
            } ?>

            <table class="table p-0 table-hover table-striped table-bordered" id="example1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pengajuan</th>
                        <th>No Anggota</th>
                        <th>Jenis Pinjaman</th>
                        <th>Jumlah</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($histori_penarikan as $item) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d-M-y', strtotime($item['tgl_pengajuan'])); ?></td>
                            <td><?= $item['no_anggota']; ?></td>
                            <td><?= $item['jenis_pinjaman']; ?></td>
                            <td class="text-right">Rp. <?= number_format($item['bsr_pengajuan']); ?></td>
                            <td class="text-center">
                                <?php
                                if ($item['status_pengajuan'] == "Sedang Diverifikasi") {
                                ?>
                                    <span class="badge badge-warning">Sedang Diverifikasi</a></span>
                                <?php
                                } else if ($item['status_pengajuan'] == "Ditolak") { ?>
                                    <span class="badge badge-danger">Di Tolak</a></span>
                                <?php } else {
                                    echo '<span class="badge badge-info">Diverifikasi</a></span>';
                                } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>