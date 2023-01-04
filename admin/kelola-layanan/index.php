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
  $layanan = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['layanan'])));
  $kategori = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['kategori'])));
  $harga = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['harga'])));
  $min = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['min'])));
  $max = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['max'])));
  $provider_id = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['provider_id'])));

  if (empty($layanan) OR empty($kategori) OR empty($harga) OR empty($min) OR empty($max) OR empty($provider_id)) {
    alert('gagal', 'Masih ada data yang kosong', 'kelola-layanan');
  } else {
    mysqli_query($db, "INSERT INTO service VALUES ('','$layanan','$kategori','$harga','$min','$max','$provider_id')");
    alert('berhasil', 'Layanan baru berhasil di tambahkan', 'kelola-layanan');
  }

}

if (isset($_POST['tombol_ambil'])) {

  require '../../include/data-api.php';

  class API {

      public $api_url = 'https://borneo-panel.com/api/'; // API Url Borneo Panel API
      
      public function service($api_key, $user_key, $jenis) {
          return json_decode($this->connect($this->api_url, array(
              'api' => $api_key,
              'user' => $user_key,
              'action' => 'service',
              'jenis' => $jenis
          )), true);
      }

      private function connect($url, $post) {
          $_post = Array();
          if (is_array($post)) {
              foreach ($post as $name => $value) {
                  $_post[] = $name.'='.urlencode($value);
              }
          }
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          if (is_array($post)) {
              curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
          }
          curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
          $result = curl_exec($ch);
          if (curl_errno($ch) != 0 && empty($result)) {
              $result = false;
          }
          curl_close($ch);
          return $result;
      }
  }

  $api = new API();

  $service = $api->service($api_key, $user_key, 'sosmed');
  if ($service['result'] === "success") {
    mysqli_query($db, "TRUNCATE TABLE service");
    foreach ($service['response'] as $layanan) {
        $idS = $layanan['id'];
        $service = $layanan['service'];
        $category = $layanan['category'];
        $harga = $layanan['harga'];
        $min = $layanan['min'];
        $max = $layanan['max'];
        $note = $layanan['note'];
        mysqli_query($db, "INSERT INTO service VALUES ('','$service','$category','$harga','$min','$max','$idS')");
    }
    alert('berhasil', 'Pengambilan layanan borneo panel berhasil', 'kelola-layanan');
  } else {
    alert('gagal', 'API Key gagal terhubung ke server BP', 'kelola-layanan');
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Daftar Layanan - <?= $judul; ?></title>
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
                <h3 class="card-title">Daftar Layanan</h3>
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
                  <div class="col-md-6">
                    <button class="btn btn-info btn-block" style="margin-bottom: 10px;" id="btn-ambil-layanan">
                      Get Layanan
                    </button>
                  </div>
                  <div class="col-md-6">
                    <button class="btn btn-info btn-block" id="btn-tambah-layanan">
                      Tambah Layanan
                    </button>
                  </div>
                </div>
                <hr>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Layanan</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Min</th>
                    <th>Max</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $qRi = mysqli_query($db, "SELECT * FROM service ORDER BY kategori DESC");
                    $no = 1;
                    while ($fRi = mysqli_fetch_assoc($qRi)) :
                    ?>
                    <tr>
                      <td><?= $no; ?></td>
                      <td><?= $fRi['provider_id']; ?></td>
                      <td><?= $fRi['layanan']; ?></td>
                      <td><?= $fRi['kategori']; ?></td>
                      <td><?= number_format($fRi['harga'],0,',','.'); ?></td>
                      <td><?= number_format($fRi['min'],0,',','.'); ?></td>
                      <td><?= number_format($fRi['max'],0,',','.'); ?></td>
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

<div class="modal fade" id="tambahlayanan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Layanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Layanan</label>
            <input type="text" class="form-control" name="layanan">
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <input type="text" class="form-control" name="kategori">
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="number" class="form-control" name="harga">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Min</label>
                <input type="number" class="form-control" name="min">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Max</label>
                <input type="number" class="form-control" name="max">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Provider ID</label>
            <input type="number" class="form-control" name="provider_id">
          </div>
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" name="tombol_tambah" class="btn btn-primary">Tambah Layanan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="ambil_layanan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Get Layanan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <p>Ingin mengambil layanan Borneo Panel? Layanan sekarang akan dihapus dan di gantikan dengan semua layanan Borneo Panel.</p>
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" name="tombol_ambil" class="btn btn-primary">Tetap Ambil</button>
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
  $("#btn-tambah-layanan").on('click', function() {
    $("#tambahlayanan").modal('show');
  });
</script>
<script>
  $("#btn-ambil-layanan").on('click', function() {
    $("#ambil_layanan").modal('show');
  });
</script>
</body>
</html>
