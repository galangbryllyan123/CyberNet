<?php 
/* 
	Aplikasi Web Panel SMM Free
	Build By Frendy Santoso
	WA : 0856 5400 8642
	YouTube : Frendy Santoso
	Panel : www.borneo-panel.com
	Blog : frendysantoso.blogspot.com
	IG : @frndysntoso
	
	!NOTE : Dilarang keras menghapus Copyright
*/
	$db = mysqli_connect('localhost', 'root', '', 'panel_sosmed');
	require 'data-panel.php';
	$link = "http://localhost/_11-november-2019/smm-free";

	date_default_timezone_set('Asia/Jakarta');
	$tanggal = date('d M Y');
	$waktu = date('G:i:s');

	/* Kumpulan Function Function */
	function alert($tipe, $isi, $lokasi) {
		setcookie($tipe, $isi, time()+2, '/');
		header("location:../" . $lokasi);
		exit();
	}

	function kontak_list($cari, $id) {
		  global $db;
		  $q = mysqli_query($db, "SELECT * FROM kontak WHERE id = '$id'");
		  $f = mysqli_fetch_assoc($q);
		  if ($cari === "wa") {
		    if (!empty($f['whatsapp'])) {
		      echo '<li class="nav-item">
		                    <a href="http://wa.me/62'.$f['whatsapp'].'" class="nav-link text-grey">
		                      <i class="fab fa-whatsapp"></i> &nbsp; (+62) '.$f['whatsapp'].'
		                    </a>
		                  </li>';
		    }
		  } else if ($cari === "ig") {
		    if (!empty($f['instagram'])) {
		      echo '<li class="nav-item">
		                    <a href="http://instagram.com/'.$f['instagram'].'" class="nav-link text-grey">
		                      <i class="fab fa-instagram"></i> &nbsp; '.$f['instagram'].'
		                    </a>
		                  </li>';
		    }
		  } else {
		    if (!empty($f['facebook'])) {
		      echo '<li class="nav-item">
		                    <a href="http://fb.com/'.$f['facebook'].'" class="nav-link text-grey">
		                      <i class="fab fa-facebook-square"></i> &nbsp; '.$f['facebook'].'
		                    </a>
		                  </li>';
		    }
		  }
		}


?>