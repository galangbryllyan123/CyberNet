<?php 
session_start();
require '../include/function.php';

if (!isset($_SESSION['username'])) {
  header("location:../login");
  exit();
}

$username = $_SESSION['username'];
$qUser = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
$fUser = mysqli_fetch_assoc($qUser);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kontak Kami - <?= $judul; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $link; ?>/assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php require '../include/header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content" style="padding-top: 30px;">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="alert alert-info">
              <strong>Informasi</strong> Silahkan hubungi salah satu kontak Admin dibawah ini, untuk deposit pertanyaan atau informasi.
            </div>
          </div>
          <?php 
          $query = mysqli_query($db, "SELECT * FROM kontak ORDER BY id ASC");
          while ($fetch = mysqli_fetch_assoc($query)) :
          ?>
          <div class="col-md-4">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="<?= $link; ?>/assets/dist/img/profile.jpeg" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?= $fetch['nama']; ?></h3>
                <h5 class="widget-user-desc"><?= $fetch['jabatan']; ?></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <?php kontak_list('wa', $fetch['id']) ?>
                  <?php kontak_list('ig', $fetch['id']) ?>
                  <?php kontak_list('fb', $fetch['id']) ?>
                </ul>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require '../include/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= $link; ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= $link; ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="<?= $link; ?>/assets/plugins/fastclick/fastclick.js"></script>
<!-- PAGE SCRIPTS -->
<script src="<?= $link; ?>/assets/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE App -->
<script src="<?= $link; ?>/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $link; ?>/assets/dist/js/demo.js"></script>
</body>
</html>
