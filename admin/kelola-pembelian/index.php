<?php 
session_start();
require '../../include/function.php';

if (!isset($_SESSION['username'])) {
  header("location:../login");
  exit();
}

$username = $_SESSION['username'];
$qUser = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
$fUser = mysqli_fetch_assoc($qUser);

if ($fUser['level'] !== "Admin") {
  header("location:../../logout");
  exit();
}

if (isset($_POST['simpan'])) {
  $status = $_POST['status'];
  $id = $_POST['id'];

  mysqli_query($db, "UPDATE riwayat_sosmed SET status = '$status' WHERE id = '$id'");
  alert('berhasil', 'Status pembelian berhasil di update','kelola-pembelian');

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kelola Pembelian - <?= $judul; ?></title>
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
                <h3 class="card-title">Kelola Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow: auto;">
                <?php if (isset($_COOKIE['berhasil'])): ?>
                <div class="alert alert-success">
                  <?= $_COOKIE['berhasil']; ?>
                </div>
                <?php endif ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Layanan</th>
                    <th>Target</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Waktu</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $qRi = mysqli_query($db, "SELECT * FROM riwayat_sosmed ORDER BY id DESC");
                    $no = 1;
                    while ($fRi = mysqli_fetch_assoc($qRi)) :
                    ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $fRi['username']; ?></td>
                      <td><?= $fRi['layanan']; ?></td>
                      <td><input type="text" class="form-control" readonly="readonly" value="<?= $fRi['target']; ?>"></td>
                      <td><?= number_format($fRi['jumlah'],0,',','.'); ?></td>
                      <td><?= number_format($fRi['harga'],0,',','.'); ?></td>
                      <td>
                        <div class="input-group mb-3">
                          <form action="" method="POST">
                            <input type="hidden" name="id" value="<?= $fRi['id']; ?>">
                            <select name="status" id="status" class="form-control">
                              <option value="<?= $fRi['status']; ?>"><?= $fRi['status']; ?> (Terpilih)</option>
                              <option value="Success">Success</option>
                              <option value="Processing">Processing</option>
                              <option value="Process">Process</option>
                              <option value="Pending">Pending</option>
                              <option value="Error">Error</option>
                              <option value="Partial">Partial</option>
                            </select>
                            <div class="input-group-prepend">
                              <button type="submit" name="simpan" class="btn btn-info">Go</button>
                            </div>
                          </form>
                        </div>
                      </td>
                      <td><?= $fRi['tanggal'] . " " . $fRi['waktu']; ?></td>
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
      "info": false,
      "autoWidth": true,
    });
  });
</script>
</body>
</html>
