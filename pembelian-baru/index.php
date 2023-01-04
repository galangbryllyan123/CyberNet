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

if (isset($_POST['tombol'])) {
  $kategori = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['kategori'])));
  $layanan = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['layanan'])));
  $target = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['target'])));
  $jumlah = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['jumlah'])));

  if (empty($kategori) OR empty($layanan) OR empty($target) OR empty($jumlah)) {
    alert('gagal', 'Masih ada data yang kosong', 'pembelian-baru');
  } else {
    $qLayanan = mysqli_query($db, "SELECT * FROM service WHERE id = '$layanan' AND kategori = '$kategori'");
    if (mysqli_num_rows($qLayanan) === 1) {
      $fLayanan = mysqli_fetch_assoc($qLayanan);
      if ($jumlah > $fLayanan['max']) {
        alert('gagal', 'Jumlah maksimal tidak valid', 'pembelian-baru');
      } else if ($jumlah < $fLayanan['min']) {
        alert('gagal', 'Jumlah minimal tidak valid', 'pembelian-baru');
      } else {
        $hargaSatuan = $fLayanan['harga'] / 1000;
        $totalbayar = $hargaSatuan * $jumlah;

        if ($fUser['saldo'] < $totalbayar) {
          alert('gagal', 'Saldo tidak mencukupi', 'pembelian-baru');
        } else {

          /* Proses Pembelian */
          $saldoAwal = $fUser['saldo'];
          $saldoJadi = $fUser['saldo'] - $totalbayar;

          require '../include/data-api.php';

          class API {
            
            public $api_url = 'https://borneo-panel.com/api/'; // API Url Borneo Panel API
            
            public function buy_sosmed($link, $type, $jumlah, $api, $user) {
                return json_decode($this->connect($this->api_url, array(
                    'api' => $api,
                    'user' => $user,
                    'action' => 'buy',
                    'target' => $link,
                    'service' => $type,
                    'jumlah' => $jumlah,
                    'jenis' => 'buy_sosmed'
                )), true);
            }

            private function connect($end_point, $post) {
                $_post = Array();
                if (is_array($post)) {
                    foreach ($post as $name => $value) {
                        $_post[] = $name.'='.urlencode($value);
                    }
                }
                $ch = curl_init($end_point);
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
          $order = $api->buy_sosmed($target, $fLayanan['provider_id'], $jumlah, $api_key, $user_key);

          if ($order['result'] === "success") {
            $trx = $order['response']['trx_pembelian'];
            $namaLayanan = $fLayanan['layanan'];
            mysqli_query($db, "INSERT INTO riwayat_sosmed VALUES ('','$username','$namaLayanan','$jumlah','$totalbayar','$target','$trx','Proses','$tanggal','$waktu','0','0')");
            mysqli_query($db, "INSERT INTO riwayat_saldo VALUES ('','$username','Melakukan pembelian dengan trx : $trx','$totalbayar','- Saldo','$tanggal','$waktu')");
            mysqli_query($db, "UPDATE user SET saldo = saldo-$totalbayar WHERE username = '$username'");
            mysqli_query($db, "UPDATE user SET saldo_terpakai = saldo_terpakai+$totalbayar WHERE username = '$username'");

            alert('berhasil', 'Pembelian dalam proses dengan trx : ' . $trx, 'pembelian-baru');

          } else {
            alert('gagal', $order['response']['message'], 'pembelian-baru');
          }
        }
      }
    } else {
      alert('gagal', 'Layanan tidak ditemukan', 'pembelian-baru');
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Pembelian Baru - <?= $judul; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= $link; ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= $link; ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $link; ?>/assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <?php require '../include/header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="padding-top: 30px;">

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Pembelian Baru</h5>
              </div>
              <form action="" method="POST">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <?php if (isset($_COOKIE['berhasil'])): ?>
                      <div class="alert alert-success">
                        <?= $_COOKIE['berhasil']; ?>
                      </div>
                      <?php endif ?>
                      <?php if (isset($_COOKIE['gagal'])): ?>
                      <div class="alert alert-danger">
                        <?= $_COOKIE['gagal']; ?>
                      </div>
                      <?php endif ?>
                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                          <option value="0">Pilih salah satu</option>
                          <?php 
                          $qCat = mysqli_query($db, "SELECT DISTINCT kategori FROM service ORDER BY kategori ASC");
                          while ($fCat = mysqli_fetch_assoc($qCat)) :
                          ?>
                          <option value="<?= $fCat['kategori']; ?>"><?= $fCat['kategori']; ?></option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Layanan</label>
                        <select name="layanan" id="layanan" class="form-control">
                          <option value="0">Pilih Kategori</option>
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                              </div>
                              <input type="text" class="form-control" readonly="readonly" id="harga">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Min</label>
                            <input type="text" class="form-control" readonly="readonly" id="min">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Max</label>
                            <input type="text" class="form-control" readonly="readonly" id="max">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Target Username / Link</label>
                        <input type="text" class="form-control" name="target">
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control" id="jumlah" onkeyup="hitung_total(this.value).value;" name="jumlah">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Total</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                              </div>
                              <input type="text" class="form-control" readonly="readonly" id="total">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.row -->
                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-default mr-2">Reset</button>
                  <button class="btn btn-info" type="submit" name="tombol">Beli Sekarang</button>
                </div>
                <!-- ./card-body -->
              </form>
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Informasi</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <ul>
                      <li>Silahkan pilih kategori sesuai katerigori yang Anda inginkan</li>
                      <li>Pilih layanan sesuai keinginan</li>
                      <li>Akan tampil harga dari layanan dan jam minimal maksimal pembelian</li>
                      <li>Masukan target pembelian gunakan <strong>username</strong> untuk pembelian <strong>Instagram followers</strong>, pembelian selain instagram followers gunakan <strong>link</strong></li>
                      <li>Masukan jumlah pembelian pastikan jumlah pembelian tidak kurang dari jumlah minimal dan tidak lebih dari jumlah maksimlal</li>
                      <li>Akan tampil jumlah total harga yang harus di bayarkan, pastikan saldo Anda cukup untuk melakukan pembelian</li>
                      <li>Jika pembelian berstatuskan <label class="badge badge-danger">Error</label> maka pembelian gagal</li>
                      <li>Jika pembelian berstatuskan <label class="badge badge-danger">Partial</label> maka pembelian tidak terselesaikan saldo di kembalian sesuai jumlah pembelian yang kurang</li>
                      <li>Jika pembelian berstatuskan <label class="badge badge-success">Success</label> maka pembelian berhasil di proses</li>
                      <li>Jika pembelian berstatuskan <label class="badge badge-warning">Pending</label> maka pembelian dalam antrian</li>
                      <li>Jika pembelian berstatuskan <label class="badge badge-info">Processing</label> maka pembelian dalam proses</li>
                    </ul>
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
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

  <!-- Main Footer -->
  <?php require '../include/footer.php'; ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= $link; ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= $link; ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= $link; ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= $link; ?>/assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?= $link; ?>/assets/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= $link; ?>/assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= $link; ?>/assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= $link; ?>/assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= $link; ?>/assets/plugins/jquery-mapael/maps/world_countries.min.js"></script>
<!-- ChartJS -->
<script src="<?= $link; ?>/assets/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?= $link; ?>/assets/dist/js/pages/dashboard2.js"></script>

<script>
var htmlobjek;
   $(document).ready(function(){
            
    $("#kategori").change(function(){
      var kategori = $("#kategori").val();
    
      $.ajax({
        url : 'get-data.php',
        data  : 'kategori='+kategori,
        type  : 'POST',
        dataType: 'html',
        success : function(msg){
                   $("#layanan").html(msg);
              }
        });
    });

    $("#layanan").change(function(){
      var layanan = $("#layanan").val();
    
      $.ajax({
        url : 'get-data.php',
        data  : 'harga=harga&data='+layanan,
        type  : 'POST',
        dataType: 'html',
        success : function(msg){
                   $("#harga").val(msg);
              }
        });

      $.ajax({
        url : 'get-data.php',
        data  : 'min=harga&data='+layanan,
        type  : 'POST',
        dataType: 'html',
        success : function(msg){
                   $("#min").val(msg);
              }
        });

      $.ajax({
        url : 'get-data.php',
        data  : 'max=harga&data='+layanan,
        type  : 'POST',
        dataType: 'html',
        success : function(msg){
                   $("#max").val(msg);
              }
        });

    });    

  });
</script>

<script>
  function hitung_total(jumlah){
      var get_harga = $("#harga").val();
      var harga = get_harga.split('.').join('');
      var hasil = (eval(jumlah) * harga) / 1000;
      var balik = hasil.toFixed(0);

      var number_string = balik.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);

      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
     
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

      $('#total').val(rupiah);
  } 
</script>

</body>
</html>
