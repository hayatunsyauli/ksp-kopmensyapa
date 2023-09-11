<div class="col-md-6">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Berdasarkan Status</h3>
            <!-- Button trigger modal -->

            <div class="card-tools">

            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="<?= base_url('petugas/laporanAnggotaStatus'); ?>">
            	<div class="row">
		    		<div class="col-sm-6">
		        		<div class="form-group">
		        			<label>Status Anggota</label>
		        			<select name="status" class="form-control" required>
		        				<option value="Aktif">Aktif</option>
		        				<option value="Tidak Aktif">Tidak Aktif</option>
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

<div class="col-md-6">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">Keseluruhan Anggota</h3>
            <!-- Button trigger modal -->

            <div class="card-tools">
            	
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" action="<?= base_url('petugas/laporanAllAnggota'); ?>">
	            	<div class="row">
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