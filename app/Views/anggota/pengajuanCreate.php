<div class="col-md-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Tambah Pengajuan Pinjaman Baru</h3>

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


            <form method="post" action="<?= base_url('anggota/prosesTambahPengajuan'); ?>">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <input type="hidden" name="no_anggota" class="form-control" value="<?= $data['no_anggota']; ?>" required readonly>
                    <div class="mb-3 col-sm-6">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required readonly>
                    </div>
                    <div class="mb-3 col-sm-6">
                        <label>Tanggal Pengajuan Pinjam</label>
                        <input type="text" name="tgl_pengajuan" class="form-control" value="<?= date('Y-m-d') ?>" required readonly>
                    </div>
                    <div class="mb-3 col-sm-6">
                        <label>Jenis Pengajuan Pinjaman</label>
                        <select id="pilihpinjaman" name="jenis_pinjaman" class="form-control "required>
                            <option value="">Pilih</option>
                            <?php foreach ($jenisPinjam as $key => $value) {?>
                                <option value="<?= $value['id'];?>"><?= $value['jenis_pinjaman'];?></option>
                            <?php  } ?>
                        </select>
                    </div>

                    <div class="mb-3 col-sm-6">
                        <label>Lama Angsuran (Bulan)</label>
                        <input type="number" max="12" name="lama_angsuran" class="form-control" placeholder="Jumlah Angsuran"required>

                        <!-- div id="show1" class="noneJP">
                            <input  type="number" min="3" max="3" name="lama_angsuran" class="form-control" placeholder="Jangka pendek">
                        </div>

                        <div id="show2" class="noneJP"> 
                            <input type="number" min="4" max="12" name="lama_angsuran" class="form-control" placeholder="Jangka Panjang">
                        </div>
 -->
                        <!-- <div id="show3" class="noneJP">
                        </div> -->
                    </div>
                    <div class="mb-3 col-sm-6">
                        <label>Jumlah Pinjaman</label>
                        <span id="formatRupiah"></span>
                        <input type="number"min="1" max="10000000" name="jumlah_pinjaman" id="rupiah" class="form-control number-format" onkeyup="jmlterbilang(this,'lblterbilang')" required>
                        
                    </div>

                    <div class="mb-3 col-sm-6">
                        <label>Terbilang</label><br>
                        <i id="lblterbilang"></i>

                    </div>
                </div>
                <input type="submit" value="Kirim" class="btn btn-primary">
                <a href="<?= base_url('anggota/pengajuanSaya'); ?>" class="btn btn-warning">Kembali</a>
            </form>


        </div>
    </div>
</div>