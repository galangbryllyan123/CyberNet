<?php 
if (isset($_POST['kategori'])) {
	require '../include/function.php';
	echo '<option value="0">Pilih salah satu</option>';
	$kategori = $_POST['kategori'];
	$qKategori = mysqli_query($db, "SELECT * FROM service WHERE kategori = '$kategori' ORDER BY layanan ASC");
	while ($fKategori = mysqli_fetch_assoc($qKategori)) {
		echo '<option value="'.$fKategori['id'].'">'.$fKategori['layanan'].'</option>';
	}
}
if (isset($_POST['data'])) {
	require '../include/function.php';
	$data = htmlspecialchars(trim(mysqli_real_escape_string($db, $_POST['data'])));
	$qData = mysqli_query($db, "SELECT * FROM service WHERE id = '$data'");
	if (mysqli_num_rows($qData) === 1 ) {
		$fData = mysqli_fetch_assoc($qData);
		if (isset($_POST['harga'])) {
			echo number_format($fData['harga'],0,',','.');
		} else if (isset($_POST['min'])) {
			echo number_format($fData['min'],0,',','.');
		} else if (isset($_POST['max'])) {
			echo number_format($fData['max'],0,',','.');
		} else {
			echo "Terjadi kesalahan";
		}
	} else {
		echo "Terjadi kesalahan";
	}
}
?>