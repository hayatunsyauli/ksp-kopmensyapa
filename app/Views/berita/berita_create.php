<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
            <?php 
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                <div class=" col-sm-12 alert alert-danger" role="alert">
                    <ul>
                        <?php foreach($errors as $error) : ?>
                            <li><?= esc($error)?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php } ?>
            <form method="post" action="/berita/save" enctype="multipart/form-data">
                <?= csrf_field();?>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label"><b>Judul Berita</b></label>
                    <div class="col-sm-12">
                        <input type="text" name="judul" maxlength="255" class="form-control" id="judul" value="<?= old('judul');?>" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label"><b>Isi Berita</b></label>
                    <div class="col-sm-12">
                        <textarea name="kontent" class="summernote" id="kontent" value="<?= old('kontent');?>"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label"><b>Gambar</b></label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control custom-file-input" name="gambar" id="profil"  onchange="previewImg()">
                        <label class="custom-file-label" for="Profil">Pilih Photo..</label>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <img src="/img/default.png" class="img-thumbnail img-preview" width="300px">
                    </div>
                </div>
                <button type="submit" name="status" value="Published" class="btn btn-primary">Publish</button>
                <button type="submit" name="status" value="Draft" class="btn btn-secondary">Save to Draft</button>
                <a href="/berita" class="btn btn-warning">Kembali</a>
            </form>
      </div>
  </div>
</div>
