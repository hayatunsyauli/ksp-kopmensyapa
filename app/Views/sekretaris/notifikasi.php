<div class="col-md-12">
    <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><?= $judul;?></h3>

                <!-- /.card-tools -->
                <div class="card-tools">

                </div>
            </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive ">
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
            <table class="table p-0 table-hover">
                <tbody>
                    <?php 
                        $no = 1;
                        foreach ($allnotifikasi as $s) { ?>
                    <tr>
                        <td>
                            <small><?= $s['created_at'];?></small><br>
                            <h5><?= $s['judul'];?></h5>
                            <p><?= $s['detail'];?></p>
                        </td>
                        <td style="display: flex;  justify-content: center;height: 121px;  align-items: center;">
                            <?php if ($s['is_read'] == 0) { ?>
                                <a href="<?php echo base_url('sekretaris/prosesTandaSudahBaca/'.$s['id_notifikasi']) ?>" class="btn btn-info btn-sm">Tandai sudah dibaca</a>&nbsp;
                                <a href="<?php echo base_url('sekretaris/deleteNotif/'.$s['id_notifikasi']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>&nbsp;
                                
                            <?php }else{ ?>
                                <a href="<?php echo base_url('sekretaris/deleteNotif/'.$s['id_notifikasi']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>&nbsp;
                            <?php } ?>

                        </td>
                    </tr>
                    <?php }; ?>              
                </tbody>
            </table>
          </div>
          <!-- /.card-body -->        
    </div>
    <!-- /.card -->
</div>
