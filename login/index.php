<?php
session_start();
require '../include/function.php';

if (isset($_SESSION['username'])) {
  header("location:../");
  exit();
}

if (isset($_POST['tombol'])) {
  $username = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['username'])));
  $password = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['password'])));

  if (empty($username) OR empty($password)) {
    alert('gagal', 'Masih ada data yang kosong', 'login');
  } else {
    $queryUser = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($queryUser) === 1) {
      $fetchUser = mysqli_fetch_assoc($queryUser);
      if ($username === $fetchUser['username']) {
        if (password_verify($password, $fetchUser['password'])) {
          if ($fetchUser['status'] === "On") {
            $_SESSION['username'] = $fetchUser['username'];
            header("location:../");
            exit();
          } else {
            alert('gagal', 'Akun anda tersuspend, silahkan hubungi Admin', 'login');
          }
        } else {
          alert('gagal', 'Username atau password salah', 'login');
        }
      } else {
        alert('gagal', 'Username atau password salah', 'login');
      }
    } else {
      alert('gagal', 'Username atau password salah', 'login');
    }
  }

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login - <?= $judul; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= $link; ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $link; ?>/assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= $link; ?>"><b><?= $judul; ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan login dengan akun Anda</p>

      <form action="" method="post">
        <?php if (isset($_COOKIE['gagal'])): ?>
        <div class="alert alert-danger">
          <strong>Terjadi kesalahan</strong> <?= $_COOKIE['gagal']; ?>
        </div>
        <?php endif ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append input-group-text">
              <span class="fas fa-user"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="tombol">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- Belum memiliki akun? -</p>
        <button class="btn btn-block btn-primary" id="Register">
          <i class="fa fa-user-plus mr-2"></i> Register
        </button>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pendaftaran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="alert alert-info">
            <strong>Informasi</strong> silahkan hubungi salah satu Admin di bawah ini untuk melakukan registrasi
          </div>
          <?php 
          $query = mysqli_query($db, "SELECT * FROM kontak ORDER BY id ASC");
          while ($fetch = mysqli_fetch_assoc($query)) :
          ?>
          <div class="col-md-12">
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
      <div class="modal-footer text-right">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
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

<script>
  $("#Register").on('click', function() {
    $("#modal-default").modal('show');
  });
</script>

</body>
</html>
