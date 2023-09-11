  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-success elevation-4 ">
    <!-- Brand Logo -->
    <a href="<?= base_url('#');?>" class="brand-link text-center">
      <img src="<?php echo base_url("img/".$profilkop['logo_kop']) ?>" alt="KOPMENSYAPA logo" class="img-circle elevation-1" style="height: 100px;">
      <span><h4><b><?php echo $profilkop['nama_kop'] ?></b></h4></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar overflow-auto">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

          <!-- Menu Ketua -->
          <?php if (session()->get('level') == 1) {?>
            <li class="nav-item">
              <a href="<?= base_url('ketua');?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-cog"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-header">Addons</li>
            <li class="nav-item has-treeview <?= $menu == 'pinjaman' ? 'menu-open' : '';?>">
              <a href="#" class="nav-link <?= $menu == 'pinjaman' ? 'active' : '';?>">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>
                  Pinjaman
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('ketua/daftarPinjaman');?>" class="nav-link <?= $submenu == 'pinjaman' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Pinjaman</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('ketua/daftarPengajuan');?>" class="nav-link <?= $submenu == 'pengajuanPinjam' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengajuan Pinjaman</p>
                  </a>
                </li>
              </ul> 
            </li>
            <li class="nav-item">
              <a href="<?= base_url('ketua/dataSimpanan');?>" class="nav-link <?= $submenu == 'simpanan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-wallet"></i>
                <p>Data Simpanan</p>
              </a> 
            </li>
            <li class="nav-item <?= $menu == 'kas' ? 'menu-open' : '';?>">
              <a class="nav-link <?= $menu == 'kas' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-coins"></i>
                <p>
                  Kas Account
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('ketua/kasdebet')?>" class="nav-link <?= $submenu == 'kas-debet' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Kas Debet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('ketua/kascredit')?>" class="nav-link <?= $submenu == 'kas-kredit' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon text-danger"></i>
                    <p>Kas Kredit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('ketua/kas');?>" class="nav-link <?= $submenu == 'kas-rekap' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rekap Kas</p>
                  </a>
                </li>
              </ul>
            </li> 
            <li class="nav-header">Master</li>
            <li class="nav-item <?= $menu == 'anggota' ? 'menu-open' : '';?>">
              <a href="<?php echo base_url();?>ketua/anggota" class="nav-link <?= $menu == 'anggota' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-user"></i>
                <p>
                  Anggota Koperasi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('ketua/anggota')?>" class="nav-link <?= $submenu == 'subanggota' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Anggota</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('ketua/daftarPengunduranAnggota')?>" class="nav-link <?= $submenu == 'pengunduran' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengajuan Pengunduran</p>
                  </a>
                </li>
              </ul>
            </li> 
            <li class="nav-item">
              <a href="<?php echo base_url()?>ketua/petugas" class="nav-link <?= $menu == 'petugas' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-users"></i>
                <p>Data Petugas</p>
              </a>
            </li> 
            <li class="nav-item <?= $menu == 'berita' ? 'menu-open' : '';?>"s>
              <a href="<?= base_url('ketua/berita');?>" class="nav-link <?= $menu == 'berita' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-newspaper"></i>
                <p>
                  Berita
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('berita/create')?>" class="nav-link <?= $submenu == 'newPost' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Berita Baru</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('berita')?>" class="nav-link <?= $submenu == 'list' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List Berita</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-header">Laporan</li>
            <li class="nav-item <?= $menu == 'lapSimpanan' ? 'menu-open' : '';?>">
              <a href="#" class="nav-link <?= $menu == 'lapSimpanan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-file"></i>
                <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanPinjaman');?>" class="nav-link <?= $submenu == 'lapPinjaman' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Pinjaman</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanSimpanan');?>" class="nav-link <?= $submenu == 'lapSimpanan' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Simpanan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanPenarikan');?>" class="nav-link <?= $submenu == 'lapPenarikan' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Penarikan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanKas');?>" class="nav-link <?= $submenu == 'lapKas' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Kas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanAnggota')?>" class="nav-link <?= $submenu == 'lapAnggota' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Anggota</p>
                  </a>
                </li>

              </ul> 
            </li>
            <li class="nav-header">Notifikasi</li>
            <li class="nav-item">
              <a href="<?= base_url('ketua/notifikasi');?>" class="nav-link <?= $menu == 'notifikasi' ? 'active' : '';?>">
                <i class="far fa-bell nav-icon"></i>
                <p>Notifikasi</p>
              </a>
            </li> 
          <?php } ?>

          <!-- Menu Bendahara -->
          <?php if (session()->get('level') == 2) { ?>
            <li class="nav-header">Dashboard</li>
            <li class="nav-item ">
              <a href="<?= base_url('Bendahara');?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-cog"></i>
                <p>Dashboard</p>
              </a>
            </li>
            
            <li class="nav-header">Transaksi</li>
            <li class="nav-item has-treeview <?= $menu == 'pinjaman' ? 'menu-open' : '';?>">
              <a href="#" class="nav-link <?= $menu == 'pinjaman' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-money-bill-wave"></i>
                <p>
                  Pinjaman
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('bendahara/daftarPinjaman');?>" class="nav-link <?= $submenu == 'pinjaman' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Pinjaman</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('bendahara/daftarPengajuan');?>" class="nav-link <?= $submenu == 'pengajuan' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengajuan Pinjaman</p>
                  </a>
                </li>
              </ul> 
            </li>             
            <li class="nav-item has-treeview <?= $menu == 'simpanan' ? 'menu-open' : '';?>">
              <a href="#" class="nav-link <?= $menu == 'simpanan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-wallet"></i>
                <p>
                  Simpanan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('bendahara/dataSimpanan');?>" class="nav-link <?= $submenu == 'simpanan' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Simpanan </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('bendahara/penarikan');?>" class="nav-link <?= $submenu == 'penarikan' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penarikan Simpanan</p>
                  </a>
                </li>
                <li class="nav-item <?= $menu2 == 'reksimp' ? 'menu-open' : '';?>">
                  <a href="#" class="nav-link <?= $menu2 == 'reksimp' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Rekap Simpanan
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= base_url('bendahara/simpananPokok');?>" class="nav-link <?= $submenu == 'pokok' ? 'active' : '';?>">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Simpanan Pokok </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url('bendahara/simpananWajib');?>" class="nav-link <?= $submenu == 'wajib' ? 'active' : '';?>">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Simpanan Wajib </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= base_url('bendahara/simpananSS');?>" class="nav-link <?= $submenu == 'sukarela' ? 'active' : '';?>">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Simpanan Sukarela </p>
                      </a>
                    </li>
                  </ul>
                </li>                
              </ul> 
            </li> 
            <li class="nav-item has-treeview <?= $menu == 'kas' ? 'menu-open' : '';?>">
              <a class="nav-link <?= $menu == 'kas' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-coins"></i>
                <p>
                  Kas Account
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('kas/kasdebet')?>" class="nav-link <?= $submenu == 'kas-debet' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon text-success"></i>
                    <p>Kas Debet</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('kas/kascredit')?>" class="nav-link <?= $submenu == 'kas-kredit' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon text-danger"></i>
                    <p>Kas Kredit</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('kas');?>" class="nav-link <?= $submenu == 'kas-rekap' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rekap Kas</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-header">Laporan</li>
            <li class="nav-item <?= $menu == 'lapSimpanan' ? 'menu-open' : '';?>">
              <a href="#" class="nav-link <?= $menu == 'lapSimpanan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-file"></i>
                <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanPinjaman');?>" class="nav-link <?= $submenu == 'lapPinjaman' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Pinjaman</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanSimpanan');?>" class="nav-link <?= $submenu == 'lapSimpanan' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Simpanan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanPenarikan');?>" class="nav-link <?= $submenu == 'lapPenarikan' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Penarikan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanKas');?>" class="nav-link <?= $submenu == 'lapKas' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Kas</p>
                  </a>
                </li>

              </ul> 
            </li>
            <li class="nav-header">Notifikasi</li>
            <li class="nav-item">
              <a href="<?= base_url('bendahara/notifikasi');?>" class="nav-link <?= $menu == 'notifikasi' ? 'active' : '';?>">
                <i class="far fa-bell nav-icon"></i>
                <p>Notifikasi</p>
              </a>
            </li>
          <?php } ?>

          <!-- Menu Sekretaris -->
          <?php if (session()->get('level') == 3) { ?>
            <li class="nav-item">
              <a href="<?php echo base_url();?>sekretaris" class="nav-link <?= $menu == 'dashboard' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-cog"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-header">Addons</li>
            <li class="nav-item <?= $menu == 'pengajuan' ? 'menu-open' : '';?>">
              <a href="<?php echo base_url();?>anggota/simpananSaya" class="nav-link <?= $menu == 'pengajuan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-hand-holding-usd"></i>
                <p>
                  Pengajuan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('sekretaris/daftarPengajuan')?>" class="nav-link <?= $submenu == 'pengajuanPinjam' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengajuan Pinjaman</p>
                  </a>
                </li>

              </ul>
            </li> 
            <li class="nav-item">
              <a href="<?= base_url('sekretaris/daftarPinjaman')?>" class="nav-link <?= $menu == 'pinjaman' ? 'active' : '';?>">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>Data Pinjaman</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="<?= base_url('sekretaris/daftarTagihan')?>" class="nav-link <?= $menu == 'tagihan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-file"></i>
                <p>Tagihan Bulanan</p>
              </a>
            </li>
            <li class="nav-header">Master</li>
            <li class="nav-item <?= $menu == 'anggota' ? 'menu-open' : '';?>">
              <a href="<?php echo base_url();?>sekretaris/anggota" class="nav-link <?= $menu == 'anggota' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-user"></i>
                <p>
                  Anggota Koperasi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('sekretaris/anggota')?>" class="nav-link <?= $submenu == 'subanggota' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Anggota</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('sekretaris/daftarPengunduranAnggota')?>" class="nav-link <?= $submenu == 'dpa' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pengajuan Pengunduran</p>
                  </a>
                </li>
              </ul>
            </li> 
            <li class="nav-item">
              <a href="<?php echo base_url('sekretaris/jenisPinjaman')?>" class="nav-link <?= $menu == 'jenisPinjaman' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-cog"></i>
                <p>Data Jenis Pinjaman</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="<?php echo base_url('sekretaris/jenisSimpanan')?>" class="nav-link <?= $menu == 'jenisSimpanan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-cog"></i>
                <p>Data Jenis Simpanan</p>
              </a>
            </li>

            <li class="nav-header">Laporan</li>
            <li class="nav-item <?= $menu == 'lapSimpanan' ? 'menu-open' : '';?>">
              <a href="#" class="nav-link <?= $menu == 'lapSimpanan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-file"></i>
                <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanPengajuan')?>" class="nav-link <?= $submenu == 'laporanPengajuan' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Pengajuan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('petugas/laporanAnggota')?>" class="nav-link <?= $submenu == 'lapAnggota' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Anggota</p>
                  </a>
                </li>

              </ul> 
            </li> 
            <li class="nav-header">Notifikasi</li>
            <li class="nav-item">
              <a href="<?= base_url('sekretaris/notifikasi');?>" class="nav-link <?= $menu == 'notifikasi' ? 'active' : '';?>">
                <i class="far fa-bell nav-icon"></i>
                <p>Notifikasi</p>
              </a>
            </li>
          <?php } ?>

          <!-- Menu Anggota -->
          <?php if (session()->get('level') == "Anggota") { ?>
            <li class="nav-item">
              <a href="<?= base_url('anggota');?>" class="nav-link <?= $menu == 'dashboard' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-cog"></i>
                <p>Dashboard</p>
              </a>
            </li> 

            <li class="nav-header">Pengajuan</li>
            <li class="nav-item">
              <a href="<?= base_url('anggota/pengajuanSaya');?>" class="nav-link <?= $menu == 'pengajuan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-hand-holding-usd"></i>
                <p>
                  Pengajuan
                </p>
              </a>
             
            </li> 
            <li class="nav-header">Menu Anggota</li>

            <li class="nav-item">
              <a href="<?php echo base_url();?>anggota/simpananSaya" class="nav-link <?= $menu == 'simpanan' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-wallet"></i>
                <p>Simpanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('anggota/pinjamanSaya');?>" class="nav-link <?= $menu == 'pinjaman' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-money-bill-wave"></i>
                <p>
                  Pinjaman
                </p>
              </a>
            </li> 
            <li class="nav-item <?= $menu == 'profile' ? 'menu-open' : '';?>">
              <a href="<?php echo base_url();?>anggota/profile" class="nav-link <?= $menu == 'profile' ? 'active' : '';?>">
                <i class="nav-icon fas fa-fw fa-user"></i>
                <p>
                  Profile
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('anggota/profile')?>" class="nav-link <?= $submenu == 'profile-saya' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profile Saya</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('anggota/pengunduran')?>" class="nav-link <?= $submenu == 'ajukanPengunduran' ? 'active' : '';?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ajukan Pengunduran</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">Notifikasi</li>
            <li class="nav-item">
              <a href="<?= base_url('anggota/notifikasi');?>" class="nav-link <?= $menu == 'notifikasi' ? 'active' : '';?>">
                <i class="far fa-bell nav-icon"></i>
                <p>Notifikasi</p>
              </a>
            </li>
        <?php   } ?>
          <li class="nav-item">
            <div class="dropdown-divider"></div>
              <a href="" class="nav-link" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
              </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>