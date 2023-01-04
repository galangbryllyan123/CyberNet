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

if (isset($_POST['tombol'])) {
  $nama = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['nama'])));
  $jabatan = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['jabatan'])));
  $wa = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['wa'])));
  $ig = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['ig'])));
  $fb = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['fb'])));

  if (empty($nama) OR empty($jabatan)) {
    alert('gagal', 'Masih ada data yang kosong', 'kelola-kontak');
  } else {
    mysqli_query($db, "INSERT INTO kontak VALUES ('','$nama','$jabatan','$wa','$ig','$fb')");
    alert('berhasil','Kontak baru berhasil di tambahkan','kelola-kontak');
  }

}

if (isset($_GET['hapus'])) {
  $idHapus = $_GET['hapus'];
  mysqli_query($db, "DELETE FROM kontak WHERE id = '$idHapus'");
  alert('berhasil','Kontak berhasil di hapus', 'kelola-kontak');
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kelola Kontak - <?= $judul; ?></title>
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
                <h3 class="card-title">Tambah Kontak</h3>
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
                <form action="" method="POST">
                  <div class="alert alert-warning">
                    <strong>Informasi</strong> Untuk Nama & Jabatan wajib di isi, untuk Whatsapp, Instagram & Facebook boleh di isi boleh dikosongkan.
                  </div>
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama">
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan">
                  </div>
                  <div class="form-group">
                    <label>Whatsapp</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">(+62)</span>
                      </div>
                      <input type="text" class="form-control" name="wa" placeholder="85654xxxx">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Instagram</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">http://instagram.com/</span>
                      </div>
                      <input type="text" class="form-control" name="ig">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Facebook</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">http://facebook.com/</span>
                      </div>
                      <input type="text" class="form-control" name="fb">
                    </div>
                  </div>
                  <button class="btn btn-info btn-block" type="submit" name="tombol">
                    Tambah Kontak
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
                <h3 class="card-title">Daftar Kontak</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <table class="table table-bordered">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Whatsapp</th>
                    <th>Instagram</th>
                    <th>Facebook</th>
                    <th>Aksi</th>
                  </tr>
                  <?php 
                  $no = 1;
                  $qKontak = mysqli_query($db, "SELECT * FROM kontak ORDER BY id DESC");
                  while ($qFetch = mysqli_fetch_assoc($qKontak)) :
                  ?>
                  <tr>
                    <td><?= $no; ?></td>
                    <td><?= $qFetch['nama']; ?></td>
                    <td><?= $qFetch['jabatan']; ?></td>
                    <td><?= $qFetch['whatsapp']; ?></td>
                    <td><?= $qFetch['instagram']; ?></td>
                    <td><?= $qFetch['facebook']; ?></td>
                    <th>
                      <a href="?hapus=<?= $qFetch['id']; ?>" class="badge badge-danger">
                        <i class="fa fa-trash"></i>
                      </a>
                    </th>
                  </tr>
                  <?php $no++; endwhile; ?>
                  <?php if (mysqli_num_rows($qKontak) === 0 ): ?>
                  <tr>
                    <td colspan="6" align="center">Kontak tidak di temukan</td>
                  </tr>
                  <?php endif ?>
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
