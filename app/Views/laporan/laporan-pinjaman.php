<div class="col-md-4">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Laporan Harian</h3>
            <!-- Button trigger modal -->

            <div class="card-tools">

            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="<?= base_url('petugas/laporanPinjamanHarian'); ?>">
            	<div class="row">
		    		<div class="col-sm-4">
		        		<div class="form-group">
		        			<label>Tanggal</label>
		        			<select name="tanggal" class="form-control">
		        				<?php 
		        				$mulai = 1;
		        				for ($i=$mulai; $i < $mulai + 31; $i++) { 
		        					echo '<option value="'. $i .'">'.$i.'</option>';
		        				 } ?>
		        			</select>
		        		</div>
		        	</div>
		      
		        	<div class="col-sm-4">
		        		<div class="form-group">
		        			<label>Bulan</label>
		        			<select name="bulan" class="form-control">
                            	<option value="">Bulan</option>
		        				<?php 
	                            $bln = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	                            $mulai = 1;
	                            for ($i=$mulai; $i < $mulai + 12; $i++) { 
	                                echo '<option value="'. $i .'">'.$bln[$i].'</option>';
	                             } ?>
		        			</select>
		        		</div>
		        	</div>
		        	<div class="col-sm-4">
		        		<div class="form-group">
		        			<label>Tahun</label>
		        			<select name="tahun" class="form-control">
		        				<option value="">Tahun</option>
	                            <?php 
	                            $mulai = date('Y') - 10;
	                            for ($i=$mulai; $i < $mulai + 11; $i++) { 
	                                echo '<option value="'. $i .'">'. $i .'</option>';
	                             } ?>
		        			</select>
		        		</div>
		        	</div>
		        	<div class="col-sm-12">
		        		<div class="form-group">
		        			<button type="submit" formtarget="_blank" class="btn btn-info btn-block">Cetak Laporan</button>
		        		</div>
		    		</div>
            		
            	</div>
            </form>
            	
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Laporan Bulanan</h3>
            <!-- Button trigger modal -->

            <div class="card-tools">
            	
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="<?= base_url('petugas/laporanPinjamanBulanan'); ?>">
	            	<div class="row">
			        	<div class="col-sm-8">
			        		<div class="form-group">
			        			<label>Bulan</label>
			        			<select name="bulan" class="form-control">
                            		<option value="">Bulan</option>
			        				<?php 
		                            $bln = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		                            $mulai = 1;
		                            for ($i=$mulai; $i < $mulai + 12; $i++) { 
		                                echo '<option value="'. $i .'">'.$bln[$i].'</option>';
		                             } ?>
			        			</select>
			        		</div>
			        	</div>
			        	<div class="col-sm-4">
			        		<div class="form-group">
			        			<label>Tahun</label>
			        			<select name="tahun" class="form-control">
			        				<option value="">Tahun</option>
		                            <?php 
		                            $mulai = date('Y') - 10;
		                            for ($i=$mulai; $i < $mulai + 11; $i++) { 
		                                echo '<option value="'. $i .'">'. $i .'</option>';
		                             } ?>
			        			</select>
			        		</div>
			        	</div>
			        	<div class="col-sm-12">
			        		<div class="form-group">
			        			<button type="submit" formtarget="_blank" class="btn btn-info btn-block">Cetak Laporan</button>
			        		</div>
			    		</div>
	            		
	            	</div>
	            </form>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Laporan Tahun</h3>
            <!-- Button trigger modal -->

            <div class="card-tools">
            	
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="<?= base_url('petugas/laporanPinjamanTahunan'); ?>">
	            	<div class="row">
			        	<div class="col-sm-8">
			        		<div class="form-group">
			        			<label>Tahun</label>
			        			<select name="tahun" class="form-control">
			        				<option value="">Tahun</option>
		                            <?php 
		                            $mulai = date('Y') - 10;
		                            for ($i=$mulai; $i < $mulai + 11; $i++) { 
		                                echo '<option value="'. $i .'">'. $i .'</option>';
		                             } ?>
			        			</select>
			        		</div>
			        	</div>
			        	<div class="col-sm-12">
			        		<div class="form-group">
			        			<button type="submit" formtarget="_blank" class="btn btn-info btn-block">Cetak Laporan</button>
			        		</div>
			    		</div>
	            		
	            	</div>
	            </form>
        </div>
    </div>
</div>

<!-- 
<div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-header">
        <h3 class="card-title">Daftar Data Pinjaman</h3>
        -- Button trigger modal --
                
        <div class="card-tools">
          
        </div>
         /.card-tools --
      </div>
      -- /.card-header --
      <div class="card-body table-responsive">
        <div class="table" id="printarea">
             <table class="table table-sm table-hover table-striped table-bordered">
               <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pinjaman</th>
                        <th>Tanggal Pinjam</th>
                        <th>Nama</th>
                        <th>No Anggota</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Lama Angsuran</th>
                        <th>Jenis Pinjaman</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    < ?php 
                    $no = 1;
                    foreach ($pinjaman as $jp) : ?>
                    <tr>
                        <td>< ? = $no++;?></td>
                        <td>< ?= $jp['id_pinjaman'];?></td>
                        <td>< ?=date('d-m-Y', strtotime($jp['tgl_pinjam']));?></td>
                        <td>< ?= $jp['nama'];?></td>
                        <td>< ?= $jp['no_anggota'];?></td>
                        <td class="text-right">Rp. < ?= number_format($ jp['jml_angsuran']);?></td>
                        <td>< ?= $jp['lama_angsuran'];?> Bulan</td>
                        <td>< ?= $jp['jenis_pinjaman'];?></td>
                        <td>
                            < ?= date('d-m-Y', strtotime($jp['tgl_jth_tempo']));?>
                        </td> 
                        <td>< ?= $jp['status_pinjaman'];?></td>
                    </tr>
                < ? php endforeach; ?>
                </tbody>
            </table>       
        </div>

        
      </div>
  </div>
</div>
 -->