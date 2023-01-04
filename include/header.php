  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom navbar-dark navbar-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="<?= $link; ?>/riwayat-saldo">
          Saldo Rp <?= number_format($fUser['saldo'],0,',','.'); ?>,-
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $link; ?>/logout">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $link; ?>" class="brand-link navbar-info">
      <img src="<?= $link; ?>/assets/dist/img/portalsmm.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?= $judul; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= $link; ?>/assets/dist/img/profile.jpeg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $username; ?> <?php if ($fUser['level'] === "Admin"): ?><i class="fa fa-check-circle text-info"></i><?php endif ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= $link; ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if ($fUser['level'] === "Admin"): ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Fitur Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= $link; ?>/admin/konfigurasi-panel" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Konfigurasi Panel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= $link; ?>/admin/isi-saldo" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Isi Saldo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= $link; ?>/admin/kelola-pembelian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Pembelian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= $link; ?>/admin/kelola-pengguna" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= $link; ?>/admin/kelola-layanan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Layanan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= $link; ?>/admin/kelola-informasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Informasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= $link; ?>/admin/kelola-kontak" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelola Kontak</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif ?>
          <li class="nav-item">
            <a href="<?= $link; ?>/pembelian-baru" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Pembelian Baru
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $link; ?>/riwayat-pembelian" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Riwayat Pembelian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $link; ?>/riwayat-saldo" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Riwayat Saldo
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $link; ?>/daftar-layanan" class="nav-link">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Daftar Layanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= $link; ?>/kontak-kami" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Kontak Kami
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>