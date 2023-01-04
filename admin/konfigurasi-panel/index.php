<?php 
/* 
  Aplikasi Web Panel
  Build By Frendy Santoso
  WA : 0856 5400 8642
  YouTube : Frendy Santoso
  Panel : www.borneo-panel.com
  Blog : frendysantoso.blogspot.com
  IG : @frndysntoso
  
  !NOTE : Dilarang keras menghapus Copyright
*/
session_start();
require '../../include/function.php';
require '../../include/data-api.php';
require '../../include/data-panel.php';

if (!isset($_SESSION['username'])) {
  header("location:../../login");
  exit();
}

$username = $_SESSION['username'];
$qUser = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
$fUser = mysqli_fetch_assoc($qUser);

if ($fUser['level'] !== "Admin") {
  header("location:../../logout");
  exit();
}

if (isset($_POST['tombol_api'])) {
  $api_key = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['api_key'])));
  $user_key = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['user_key'])));

  $isi = '<?php
$api_key = "'.$api_key.'";
$user_key = "'.$user_key.'";
?>';

  $handle = fopen('../../include/data-api.php', 'w');
  fwrite($handle, $isi);

  alert('berhasil_api', 'Data Api berhasil di perbahrui', 'konfigurasi-panel');

}

if (isset($_POST['tombol_info'])) {
  $judul = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['judul'])));

  $isi = '<?php
$judul = "'.$judul.'";
?>';

  $handle = fopen('../../include/data-panel.php', 'w');
  fwrite($handle, $isi);

  alert('berhasil_info', 'Data panel berhasil di perbahrui', 'konfigurasi-panel');

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Isi Saldo - <?= $judul; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= $link; ?>/assets/plugins/datatables/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $link; ?>/assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php require '../../include/header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content" style="padding-top: 30px;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Informasi Panel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <?php if (isset($_COOKIE['gagal_info'])): ?>
                <div class="alert alert-danger">
                  <?= $_COOKIE['gagal_info']; ?>
                </div>
                <?php endif ?>
                <?php if (isset($_COOKIE['berhasil_info'])): ?>
                <div class="alert alert-success">
                  <?= $_COOKIE['berhasil_info']; ?>
                </div>
                <?php endif ?>
                <form action="" method="POST">
                  <div class="form-group">
                    <label>Nama Panel</label>
                    <input type="text" class="form-control" value="<?= $judul; ?>" name="judul">
                  </div>
                  <button class="btn btn-info btn-block" type="submit" name="tombol_info">
                    Simpan
                  </button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data API</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <?php if (isset($_COOKIE['gagal_api'])): ?>
                <div class="alert alert-danger">
                  <?= $_COOKIE['gagal_api']; ?>
                </div>
                <?php endif ?>
                <?php if (isset($_COOKIE['berhasil_api'])): ?>
                <div class="alert alert-success">
                  <?= $_COOKIE['berhasil_api']; ?>
                </div>
                <?php endif ?>
                <form action="" method="POST">
                  <div class="form-group">
                    <label>Api Key</label>
                    <input type="text" class="form-control" name="api_key" value="<?= $api_key; ?>">
                  </div>
                  <div class="form-group">
                    <label>User Key</label>
                    <input type="text" class="form-control" name="user_key" value="<?= $user_key; ?>">
                  </div>
                  <button class="btn btn-info btn-block" type="submit" name="tombol_api">
                    Simpan
                  </button>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require '../../include/footer.php'; ?>

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
<!-- DataTables -->
<script src="<?= $link; ?>/assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= $link; ?>/assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- FastClick -->
<script src="<?= $link; ?>/assets/plugins/fastclick/fastclick.js"></script>
<!-- PAGE SCRIPTS -->
<script src="<?= $link; ?>/assets/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE App -->
<script src="<?= $link; ?>/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= $link; ?>/assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });
  });
</script>
<script>
  $("#btn-tambah-informasi").on('click', function() {
    $("#tambah-informasi").modal('show');
  });
</script>
</body>
</html>
