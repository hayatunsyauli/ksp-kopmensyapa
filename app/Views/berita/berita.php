<div class="col-md-12">
    <div class="card card-outline card-info">
      <div class="card-header">
        <h3 class="card-title"><?= $judul;?></h3>

        <div class="card-tools">
          <a href="<?= base_url();?>/berita/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Berita baru</a>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <table class="table p-0 table-hover table-striped table-bordered" id="example1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($post as $p) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <strong><?= $p['judul']; ?></strong><br>
                            <small class="text-muted"><?= $p['tanggal']; ?></small>
                        </td>
                        <td>

                            <?php if ($p['status'] === 'published') : ?>
                                <small class="text-success"><?= $p['status'] ?></small>
                            <?php else : ?>
                                <small class="text-muted"><?= $p['status'] ?></small>
                            <?php endif ?>
                        </td>
                        <td class="text-center">
                            <!-- Preview -->
                            <a href="/berita/<?= $p['slug']; ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <!-- Edit -->
                            <a href="/berita/edit/<?= $p['slug']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>

                            <form action="/berita/<?= $p['id_post']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda Yakin?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


      </div>
  </div>
</div>