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

if (isset($_POST['tombol_tambah'])) {
  $p_username = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['username'])));
  $p_password = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['password'])));
  $p_level = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['level'])));
  $p_saldo = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['saldo'])));
  $p_nohp = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['nohp'])));

  $password_hash = password_hash($p_password, PASSWORD_DEFAULT);

  if (empty($p_username) OR empty($p_password) OR empty($p_level) OR empty($p_saldo) OR empty($p_nohp)) {
    alert('gagal', 'Masih ada data yang kosong', 'kelola-pengguna');
  } else {
    $qUsername = mysqli_query($db, "SELECT * FROM user WHERE username = '$p_username'");
    if (mysqli_num_rows($qUsername) === 0 ) {
      mysqli_query($db, "INSERT INTO user VALUES ('','$p_username','$password_hash','$p_level','$p_saldo','0','$p_nohp','On','$tanggal $waktu')");
      alert('berhasil', 'Pengguna baru berhasil di tambahkan dengan username : ' . $p_username . ' dan password : ' . $p_password, 'kelola-pengguna');
    } else {
      alert('gagal', 'Username sudah digunakan', 'kelola-pengguna');
    }
  }

}

if (isset($_GET['id']) AND isset($_GET['aksi'])) {
  $aksi = $_GET['aksi'];
  $id = $_GET['id'];

  mysqli_query($db, "UPDATE user SET status = '$aksi' WHERE id = '$id'");
  alert('berhasil', 'Status pengguna berhasil di update', 'kelola-pengguna');

}

if (isset($_GET['hapus'])) {
  $idHapus = $_GET['hapus'];
  mysqli_query($db, "DELETE FROM user WHERE id = '$idHapus'");
  alert('berhasil', 'Pengguna berhasil di hapus', 'kelola-pengguna');
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kelola Pengguna - <?= $judul; ?></title>
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
          <div class="col-md-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kelola Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <?php if (isset($_COOKIE['gagal'])): ?>
                <div class="alert alert-danger">
                  <?= $_COOKIE['gagal']; ?>
                </div>
                <?php endif ?>
                <?php if (isset($_COOKIE['berhasil'])): ?>
                <div class="alert alert-success">
                  <?= $_COOKIE['berhasil']; ?>
                </div>
                <?php endif ?>
                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-info btn-block" style="margin-bottom: 10px;" id="btn-tambah-pengguna">
                      Tambah Pengguna
                    </button>
                  </div>
                </div>
                <hr>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Saldo</th>
                    <th>Saldo Terpakai</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Tgl Register</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $qRi = mysqli_query($db, "SELECT * FROM user ORDER BY id DESC");
                    $no = 1;
                    while ($fRi = mysqli_fetch_assoc($qRi)) :
                    ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $fRi['username']; ?></td>
                      <td><?= $fRi['level']; ?></td>
                      <td><?= number_format($fRi['saldo'],0,',','.'); ?></td>
                      <td><?= number_format($fRi['saldo_terpakai'],0,',','.'); ?></td>
                      <td><?= $fRi['nohp']; ?></td>
                      <td>
                        <?php if ($fRi['status'] === "On"): ?>
                          <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                          <span class="badge badge-danger">Non Aktif</span>
                        <?php endif ?>
                      </td>
                      <td><?= $fRi['tgl_reg']; ?></td>
                      <td>
                        <?php if ($fRi['status'] === "On"): ?>
                          <a href="?aksi=Off&id=<?= $fRi['id']; ?>" class="badge badge-danger">Non Aktifkan</a>
                        <?php else : ?>
                          <a href="?aksi=On&id=<?= $fRi['id']; ?>" class="badge badge-success">Aktifkan</a>
                        <?php endif ?>
                        <a href="?hapus=<?= $fRi['id']; ?>" class="badge badge-danger">Hapus</a>
                      </td>
                    </tr>
                    <?php $no++; endwhile; ?>
                  </tbody>
                </table>
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

<div class="modal fade" id="form-pengguna">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengguna</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password">
          </div>
          <div class="form-group">
            <label>Level</label>
            <select name="level" id="level" class="form-control">
              <option value="0">Pilih salah satu</option>
              <option value="Admin">Admin</option>
              <option value="Member">Member</option>
            </select>
          </div>
          <div class="form-group">
            <label>Saldo</label>
            <input type="number" class="form-control" name="saldo">
          </div>
          <div class="form-group">
            <label>No HP</label>
            <input type="number" class="form-control" name="nohp">
          </div>
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" name="tombol_tambah" class="btn btn-primary">Tambah Pengguna</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
  $("#btn-tambah-pengguna").on('click', function() {
    $("#form-pengguna").modal('show');
  });
</script>
</body>
</html>
