
<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <button class="nav-link active" data-toggle="tab" href="#aktif">Simpanan Aktif</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-toggle="tab" href="#nonaktif">Simpanan Tidak Aktif</button>
              </li>
            </ul>
        </div>
        <div class="card-body table-responsive ">
            <!-- Tab panes -->
            <div class="tab-content" >
              <div class="tab-pane active" id="aktif">
                <div class="card-tools float-right">
                    <a href="<?php echo base_url('bendahara/setorAllSimpWajib');?>"class="btn btn-sm btn-info" data-placement="bottom" title="Setor SW Semua Anggota"><i class="fas fa-plus"></i>&nbsp; Setor Simpanan Wajib</a>
                </div><br><br>
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
                    } 
                ?>
                <table class="table p-0 table-hover text-nowrap table-bordered" id="example1">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>No Anggota</th>
                        <th>Simpanan Pokok</th>
                        <th>Simpanan Wajib</th>
                        <th>Simpanan Sukarela</th>
                        <th>Status Anggota</th>
                        <th>Status Simpanan</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $no = 1;
                        foreach ($simpan as $s) : ?>
                        <tr>
                            <td><?= $no++;?></td>
                            <td><?= $s['nama'];?><br>
                                <small><?= $s['no_anggota'];?></small>
                            </td>
                            <td class="text-right">Rp <?= number_format($s['simpanan_pokok']);?></td>
                            <td class="text-right">Rp <?= number_format($s['simpanan_wajib']);?></td>
                            <td class="text-right">Rp <?= number_format($s['simpanan_sukarela']);?></td>
                            <td class="text-center">
                                <?php
                            if ($s['status_anggota'] == "Aktif") {
                            ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php
                            } else{ ?>
                                <span class="badge badge-danger">Tidak Aktif</span>
                            <?php 
                            }
                            ?></td>
                            <td class="text-center">
                                <?php
                                if ($s['status_simpanan'] == "Belum Ditarik") {
                                ?>
                                    <span class="badge badge-success">Belum Ditarik</span>
                                <?php
                                } else{ ?>
                                    <span class="badge badge-danger">Sudah Ditarik</span>
                                <?php 
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo base_url();?>bendahara/ubahStatusSmp/<?= $s['id_simpanan'];?>" class="badge badge-warning" data-placement="bottom" title="Ubah Status Simpanan">Ubah Status Simpanan</a><br>

                                <a href="<?php echo base_url();?>bendahara/createSW/<?= $s['id_simpanan'];?>" class="btn btn-xs btn-info" data-placement="bottom" title="Setor Simp. Wajib">SW</a>
                                <a href="<?php echo base_url();?>bendahara/createSK/<?= $s['id_simpanan'];?>" class="btn btn-xs btn-success" data-placement="bottom" title="Setor Simp. Sukarela">SS</a>

                                <a href="<?= base_url('bendahara/cetakAllSimpanByAnggota/'.$s['no_anggota']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="tab-pane fade" id="nonaktif">
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
                <table class="table p-0 table-hover text-nowrap table-bordered" id="example2">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>No Anggota</th>
                        <th>Simpanan Pokok</th>
                        <th>Simpanan Wajib</th>
                        <th>Simpanan Sukarela</th>
                        <th>Status Anggota</th>
                        <th>Status Simpanan</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $no = 1;
                        foreach ($simpannon as $s) : ?>
                        <tr>
                            <td><?= $no++;?></td>
                            <td><?= $s['nama'];?><br>
                                <small><?= $s['no_anggota'];?></small>
                            </td>
                            <td class="text-right">Rp <?= number_format($s['simpanan_pokok']);?></td>
                            <td class="text-right">Rp <?= number_format($s['simpanan_wajib']);?></td>
                            <td class="text-right">Rp <?= number_format($s['simpanan_sukarela']);?></td>
                            <td class="text-center">
                                <?php
                            if ($s['status_anggota'] == "Aktif") {
                            ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php
                            } else{ ?>
                                <span class="badge badge-danger">Tidak Aktif</span>
                            <?php 
                            }
                            ?></td>
                            <td class="text-center">
                                <?php
                                if ($s['status_simpanan'] == "Belum Ditarik") {
                                ?>
                                    <span class="badge badge-success">Belum Ditarik</span>
                                <?php
                                } else{ ?>
                                    <span class="badge badge-danger">Sudah Ditarik</span>
                                <?php 
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo base_url();?>bendahara/ubahStatusSmp/<?= $s['id_simpanan'];?>" class="badge badge-warning" data-placement="bottom" title="Ubah Status Simpanan">Ubah Status Simpanan</a><br>

                                <a href="<?php echo base_url();?>bendahara/createSW/<?= $s['id_simpanan'];?>" class="btn btn-xs btn-info" data-placement="bottom" title="Setor Simp. Wajib">SW</a>
                                <a href="<?php echo base_url();?>bendahara/createSK/<?= $s['id_simpanan'];?>" class="btn btn-xs btn-success" data-placement="bottom" title="Setor Simp. Sukarela">SS</a>

                                <a href="<?= base_url('bendahara/cetakAllSimpanByAnggota/'.$s['no_anggota']);?>" target="_blank" class="btn btn-xs btn-info" data-placement="bottom" title="Cetak"><i class="fas fa-inbox"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>

<script>
    function viewLaporan(){
        let bulan = $('#bulan').val();
        let tahun = $('#tahun').val();
        if (bulan == '') {
            alert('Bulan Belum Dipilih!');
        }else if (tahun == '') {
            alert('Tahun Belum Dipilih!');
        }else{
            $.ajax({
                type: "GET",
                url: "<?= base_url('petugas/viewLaporan');?>",
                data: {
                    bulan: bulan,
                    tahun: tahun,
                },
                dataType: "JSON",
                success: function(response){
                    if (response.data) {
                        $('#table').html(response.data);
                    }
                }
            })
        }
    }
</script>