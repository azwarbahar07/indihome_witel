<?php

function plugins() { ?>
	<link rel="stylesheet" href="../assets/plugins/bootstrap-more/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/dist/css2/components.css">
	<script src="../assets/dist/jquery.min.js"></script>
	<script src="../assets/dist/sweetalert/sweetalert.min.js"></script>
<?php }
require('../koneksi.php');


// SUBMIT ADMIN
if (isset($_POST['submit_admin'])) {
	$nama_admin = $_POST['nama_admin'];
	$jenis_kelamin_admin = $_POST['jenis_kelamin_admin'];
	$username_admin = $_POST['username_admin'];
	$password = password_hash($username_admin, PASSWORD_DEFAULT);
	$role_admin = "TL";
	$status_admin = "Aktif";

	// SET FOTO
	$foto = $_FILES['foto_admin']['name'];
	$ext = pathinfo($foto, PATHINFO_EXTENSION);
	$nama_foto = "image_".time().".".$ext;
    $file_tmp = $_FILES['foto_admin']['tmp_name'];

    // TAMBAH DATA
	$query= "INSERT INTO tb_admin VALUES (NULL, '', '$nama_admin', '$jenis_kelamin_admin', '$username_admin', '$password', '$nama_foto', '$role_admin', '$status_admin')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		move_uploaded_file($file_tmp, '../assets/images/admin/'.$nama_foto);
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil',
					text: 'Data Admin Berhasil ditambah!',
					icon: 'success'
				}).then((data) => {
					location.href = 'administrasi.php';
				});
            });
		</script>
	<?php }
}

// UPDATE ADMIN
if (isset($_POST['edit_admin'])) {
	$id_admin = $_POST['id_admin'];
	$nama_admin = $_POST['nama_admin'];
	$jenis_kelamin_admin = $_POST['jenis_kelamin_admin'];
	$username_admin = $_POST['username_admin'];
	$role_admin = "TL";
	$status_admin = "Aktif";

    // SET FOTO
	if ($_FILES['foto_admin']['name'] != '') {
		$foto = $_FILES['foto_admin']['name'];
		$ext = pathinfo($foto, PATHINFO_EXTENSION);
		$nama_foto = "image_".time().".".$ext;
		$file_tmp = $_FILES['foto_admin']['tmp_name'];
		// HAPUS OLD FOTO
		$target = "foto/".$_POST['foto_now'];
		if (file_exists($target) && $_POST['foto_now'] != 'default.png') unlink($target);
		// UPLOAD NEW FOTO
		move_uploaded_file($file_tmp, '../assets/images/admin/'.$nama_foto);
	} else {
		$nama_foto = $_POST['foto_now'];
	}
		$query = "UPDATE tb_admin SET nama_admin = '$nama_admin',
											jekel_admin = '$jenis_kelamin_admin',
											username_admin = '$username_admin',
											foto_admin = '$nama_foto' WHERE id_admin = '$id_admin'";
		mysqli_query($conn, $query);
	// EDIT PARTAI
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil',
					text: 'Data Admin berhasil diubah',
					icon: 'success'
				}).then((data) => {
					location.href = 'administrasi.php';
				});
			});
		</script>
	<?php }
}

// HAPUS ADMIN
if (isset($_GET['hapus_admin'])) {
	$id_admin = $_GET['id_admin'];

	$query = "DELETE FROM tb_admin WHERE id_admin = '$id_admin'";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Dihapus',
					text: 'Data Admin berhasil dihapus',
					icon: 'success'
				}).then((data) => {
					location.href = 'administrasi.php';
				});
			});
		</script>
	<?php }
}


// SUBMIT TEKNISI
if (isset($_POST['submit_teknisi'])) {
	$id_mitra = $_POST["id_mitra"];
	$nama_teknisi = $_POST['nama_teknisi'];
	$telpon_teknisi = $_POST['telpon_teknisi'];
	$jenis_kelamin_teknisi = $_POST['jenis_kelamin_teknisi'];
	$username_teknisi = $_POST['username_teknisi'];
	$password_teknisi = password_hash($username_teknisi, PASSWORD_DEFAULT);
	$role_teknisi = "Teknisi";
	$status_teknisi = "Aktif";

	// SET FOTO
	$foto = $_FILES['foto_teknisi']['name'];
	$ext = pathinfo($foto, PATHINFO_EXTENSION);
	$nama_foto = "image_".time().".".$ext;
    $file_tmp = $_FILES['foto_teknisi']['tmp_name'];

    // TAMBAH DATA
	$query= "INSERT INTO tb_teknisi VALUES (NULL, '$id_mitra', '$nama_teknisi', '$telpon_teknisi', '$jenis_kelamin_teknisi', '$nama_foto', '$status_teknisi')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		//get Id Teknisi
		$getIdInster = mysqli_insert_id($conn);
		// TAMBAH AKUN LOGIN Teknisi
		$queryauth = "INSERT INTO tb_auth VALUES (NULL, '$getIdInster', '$username_teknisi', '$password_teknisi', '$role_teknisi', '$status_teknisi')";
		mysqli_query($conn, $queryauth);
		move_uploaded_file($file_tmp, '../assets/images/teknisi/'.$nama_foto);
		plugins(); ?>
		<script>

			$(document).ready(function() {
				swal({
					title: 'Berhasil',
					text: 'Data Teknisi Berhasil ditambah!',
					icon: 'success'
				}).then((data) => {
					location.href = 'teknisi.php';
				});
            });
		</script>
	<?php }
}

// UPDATE TEKNISI
if (isset($_POST['edit_teknisi'])) {
	$id_teknisi = $_POST['id_teknisi'];
	$nama_teknisi = $_POST['nama_teknisi'];
	$telpon_teknisi = $_POST['telpon_teknisi'];
	$jenis_kelamin_teknisi = $_POST['jenis_kelamin_teknisi'];
	$username_teknisi = $_POST['username_teknisi'];
	$status_teknisi = $_POST['status_teknisi'];

    // SET FOTO
	if ($_FILES['foto_teknisi']['name'] != '') {
		$foto = $_FILES['foto_teknisi']['name'];
		$ext = pathinfo($foto, PATHINFO_EXTENSION);
		$nama_foto = "image_".time().".".$ext;
		$file_tmp = $_FILES['foto_teknisi']['tmp_name'];
		// HAPUS OLD FOTO
		$target = "foto/".$_POST['foto_now'];
		if (file_exists($target) && $_POST['foto_now'] != 'default.png') unlink($target);
		// UPLOAD NEW FOTO
		move_uploaded_file($file_tmp, '../assets/images/teknisi/'.$nama_foto);
	} else {
		$nama_foto = $_POST['foto_now'];
	}
		$query = "UPDATE tb_teknisi SET nama_teknisi = '$nama_teknisi',
											telpon_teknisi = '$telpon_teknisi',
											jekel_teknisi = '$jenis_kelamin_teknisi',
											foto_teknisi = '$nama_foto',
											status_teknisi = '$status_teknisi' WHERE id_teknisi = '$id_teknisi'";
		mysqli_query($conn, $query);
	// EDIT PARTAI
	if (mysqli_affected_rows($conn) > 0) {
		$query1 = "UPDATE tb_auth SET username_auth = '$username_teknisi' WHERE id_akun = '$id_teknisi' AND role_auth ='Teknisi'";
		mysqli_query($conn, $query1);
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil',
					text: 'Data Teknisi berhasil diubah',
					icon: 'success'
				}).then((data) => {
					location.href = 'teknisi.php';
				});
			});
		</script>
	<?php }
}

// HAPUS TEKNISI
if (isset($_GET['hapus_teknisi'])) {
	$id_teknisi = $_GET['id_teknisi'];

	$query = "DELETE FROM tb_teknisi WHERE id_teknisi = '$id_teknisi'";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		$query2 = "DELETE FROM tb_auth  WHERE id_akun = '$id_teknisi' AND role_auth ='Teknisi'";
		mysqli_query($conn, $query2);
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Dihapus',
					text: 'Data Teknisi berhasil dihapus',
					icon: 'success'
				}).then((data) => {
					location.href = 'teknisi.php';
				});
			});
		</script>
	<?php }
}

// UPDATE ID TEKNISI
if (isset($_GET['kirim_order_teknisi'])) {
	$id_teknisi = $_GET['id_teknisi'];
	$id_order = $_GET['id_order'];

		$query = "UPDATE tb_order SET teknisi_id = '$id_teknisi' WHERE id_order = '$id_order'";
		mysqli_query($conn, $query);
	// UPDATE ID MITRA
	if (mysqli_affected_rows($conn) > 0) {
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil',
					text: 'Membagikan Data berhasil.',
					icon: 'success'
				}).then((data) => {
					location.href = 'index.php';
				});
			});
		</script>
	<?php }
}


// SUBMIT SALES
if (isset($_POST['submit_sales'])) {
	$random_number = rand(10, 99);
	$kode_sales = "SPMU" .$random_number. "M";
	$nama_sales = $_POST['nama_sales'];
	$telpon_sales = $_POST['telpon_sales'];
	$email_sales = $_POST['email_sales'];
	$alamat_sales = $_POST['alamat_sales'];
	$username_sales = $_POST['username_sales'];
	$password_sales = password_hash($username_sales, PASSWORD_DEFAULT);
	$role_sales = "Sales";
	$status_sales = "Aktif";

	// SET FOTO
	$foto = $_FILES['foto_sales']['name'];
	$ext = pathinfo($foto, PATHINFO_EXTENSION);
	$nama_foto = "image_".time().".".$ext;
    $file_tmp = $_FILES['foto_sales']['tmp_name'];

    // TAMBAH DATA
	$query= "INSERT INTO tb_sales VALUES (NULL, '$kode_sales', '$nama_sales', '$telpon_sales', '$email_sales', '$alamat_sales', '$nama_foto', '$status_sales')";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		//get Id sales
		$getIdInster = mysqli_insert_id($conn);
		// TAMBAH AKUN LOGIN SALES
		$queryauth = "INSERT INTO tb_auth VALUES (NULL, '$getIdInster', '$username_sales', '$password_sales', '$role_sales', '$status_sales')";
		mysqli_query($conn, $queryauth);
		move_uploaded_file($file_tmp, '../assets/images/sales/'.$nama_foto);
		plugins(); ?>
		<script>

			$(document).ready(function() {
				swal({
					title: 'Berhasil',
					text: 'Data Sales Berhasil ditambah!',
					icon: 'success'
				}).then((data) => {
					location.href = 'sales.php';
				});
            });
		</script>
	<?php }
}

// UPDATE SALES
if (isset($_POST['edit_sales'])) {
	$id_sales = $_POST['id_sales'];
	$nama_sales = $_POST['nama_sales'];
	$telpon = $_POST['telpon'];
	$email_sales = $_POST['email_sales'];
	$alamat_sales = $_POST['alamat_sales'];
	$status_sales = $_POST['status_sales'];
	$username_sales = $_POST['username_sales'];

    // SET FOTO
	if ($_FILES['foto_sales']['name'] != '') {
		$foto = $_FILES['foto_sales']['name'];
		$ext = pathinfo($foto, PATHINFO_EXTENSION);
		$nama_foto = "image_".time().".".$ext;
		$file_tmp = $_FILES['foto_sales']['tmp_name'];
		// HAPUS OLD FOTO
		$target = "foto/".$_POST['foto_now'];
		if (file_exists($target) && $_POST['foto_now'] != 'default.png') unlink($target);
		// UPLOAD NEW FOTO
		move_uploaded_file($file_tmp, '../assets/images/sales/'.$nama_foto);
	} else {
		$nama_foto = $_POST['foto_now'];
	}
		$query = "UPDATE tb_sales SET nama_sales = '$nama_sales',
											telpon = '$telpon',
											email_sales = '$email_sales',
											alamat_sales = '$alamat_sales',
											foto_sales = '$nama_foto',
											status_sales = '$status_sales' WHERE id_sales = '$id_sales'";
		mysqli_query($conn, $query);
	// EDIT PARTAI
	if (mysqli_affected_rows($conn) > 0) {
		$query1 = "UPDATE tb_auth SET username_auth = '$username_sales' WHERE id_akun = '$id_sales' AND role_auth ='Sales'";
		mysqli_query($conn, $query1);
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil',
					text: 'Data Sales berhasil diubah',
					icon: 'success'
				}).then((data) => {
					location.href = 'sales.php';
				});
			});
		</script>
	<?php }
}

// HAPUS SALES
if (isset($_GET['hapus_sales'])) {
	$id_sales = $_GET['id_sales'];

	$query = "DELETE FROM tb_sales WHERE id_sales = '$id_sales'";
	mysqli_query($conn, $query);
	if (mysqli_affected_rows($conn) > 0) {
		$query2 = "DELETE FROM tb_auth  WHERE id_akun = '$id_sales' AND role_auth ='Sales'";
		mysqli_query($conn, $query2);
		plugins(); ?>
		<script>
			$(document).ready(function() {
				swal({
					title: 'Berhasil Dihapus',
					text: 'Data Sales berhasil dihapus',
					icon: 'success'
				}).then((data) => {
					location.href = 'sales.php';
				});
			});
		</script>
	<?php }
}




?>