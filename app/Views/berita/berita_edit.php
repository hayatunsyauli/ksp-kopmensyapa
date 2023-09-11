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
            <form method="post" action="/berita/update/<?= $berita['id_post'];?>" enctype="multipart/form-data">
                <?= csrf_field();?>
                <input type="hidden" name="slug" value="<?= $berita['slug'];?>">
                <input type="hidden" name="gambarLama" value="<?= $berita['gambar'];?>">
                <div class="form-group">
                    <label class="col-sm-2 col-form-label"><b>Judul Berita</b></label>
                    <div class="col-sm-12">
                        <input type="text" name="judul" maxlength="255" class="form-control" id="judul" value="<?= (old('judul')) ? old('judul') : $berita['judul'];?>" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label"><b>Isi Berita</b></label>
                    <div class="col-sm-12">
                        <textarea class="summernote" name="kontent" id="kontent"><?= (old('kontent')) ? old('kontent') : $berita['kontent'];?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-form-label"><b>Gambar</b></label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : '' ;?>" name="gambar" id="profil"  onchange="previewImg()">
                        <?= $validation->getError('gambar');?>
                        <label class="custom-file-label" for="Profil"><?= (old('gambar')) ? old('gambar') : $berita['gambar'];?></label>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <img src="/img/berita/<?= $berita['gambar'];?>" class="img-thumbnail img-preview" width="300px">
                        <div class="invalid-feedback">
                            <?= $validation->getError('profil');?>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" name="status" value="Published" class="btn btn-sm btn-primary">Publish</button>
                <button type="submit" name="status" value="Draft" class="btn btn-sm btn-secondary">Save to Draft</button>
                <a href="<?= base_url('berita')?>" class="btn btn-sm btn-warning">Kembali</a>
            </form>
      </div>
  </div>
</div>