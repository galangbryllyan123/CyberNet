<?php 
session_start();
require 'include/function.php';

if (!isset($_SESSION['username'])) {
  header("location:login");
  exit();
}

$username = $_SESSION['username'];
$qUser = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
$fUser = mysqli_fetch_assoc($qUser);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Dashboard - <?= $judul; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <?php require 'include/header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $link; ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-info">
              Selamat datang <strong><?= $username; ?> (<?= $fUser['level']; ?>)</strong>, selamat berbelanja.
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Saldo</span>
                <span class="info-box-number">
                  Rp <?= number_format($fUser['saldo'],0,',','.'); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Saldo Terpakai</span>
                <span class="info-box-number">
                  Rp <?= number_format($fUser['saldo_terpakai'],0,',','.'); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="<?= $link; ?>/assets/dist/img/profile.jpeg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $fUser['username']; ?></h3>

                <p class="text-muted text-center"><?= $fUser['level']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>No HP</b> <a class="float-right">(+62) <?= $fUser['nohp']; ?></a>
                  </li>
                    <li class="list-group-item">
                      <b>Status</b> <a class="float-right">
                        <?php if ($fUser['status'] === "On"): ?>
                          <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                          <span class="badge badge-danger">Non Aktif</span>
                        <?php endif ?>
                      </a>
                    </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-9">
            <ul class="timeline timeline-inverse">
              <li class="time-label">
                <span class="bg-info">
                  Informasi
                </span>
              </li>
              <?php 
              $qInfo = mysqli_query($db, "SELECT * FROM informasi ORDER BY id DESC LIMIT 5");
              while ($rInfo = mysqli_fetch_assoc($qInfo)) :
              ?>
              <li>  
                <div class="timeline-item bg-white">
                  <span class="time"><i class="far fa-clock"></i> <?= $rInfo['tanggal']; ?></span>

                  <h3 class="timeline-header"><?= $rInfo['judul']; ?></h3>

                  <div class="timeline-body">
                    <?= $rInfo['isi']; ?>
                  </div>
                </div>
              </li>
              <?php endwhile; ?>
              <?php if (mysqli_num_rows($qInfo) === 0 ): ?>
              <li>
                <div class="timeline-item bg-info">
                  <div class="timeline-body text-center">
                    Tidak ada informasi
                  </div>
                </div>
              </li>
              <?php endif ?>
            </ul>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  
  <?php require 'include/footer.php'; ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="assets/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/world_countries.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="assets/dist/js/pages/dashboard2.js"></script>
</body>
</html>
