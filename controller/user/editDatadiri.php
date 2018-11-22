<?php

include '../../database/connect.php';

$email   		   =  $_POST['inputEmail'];
$nickname			 =  $_POST['inputNamaPanggilan'];
$nama 	 		   =  $_POST['inputNama'];
$provinsi        =  $_POST['inputProvinsi'];
$kabupaten       =  $_POST['inputKabupaten'];
$kecamatan       =  $_POST['inputKecamatan'];
$alamat          =  $_POST['inputAlamat'];
$noHP 	   		 =  $_POST['inputNoHP'];
$angkatan  		 =  $_POST['inputAngkatan'];
$lulusan  		 =  $_POST['inputLulusan'];
$pekerjaan		 =  $_POST['inputPekerjaan'];
$tempatlahir	 =  $_POST['inputTempatLahir'];
$date			 =  $_POST['datepicker'];


// Get image name
$image = $_FILES['imageupload']['name'];
$newname = $email.".png";
$maxsize = 1048576;
$valid_ext = array('jpg', 'jpeg', 'png', 'gif', 'bmp');

$changeImage = 0;
/*
	2 = success;
*/

if ($_FILES['imageupload' ] ['error'] != 4){
	// image file directory
	$target = "../../dist/userpicture/".basename($newname);
	// Extension Check
	$ext = 	pathinfo($_FILES['imageupload']['name'], PATHINFO_EXTENSION);
	if (in_array($ext, $valid_ext)) {
		$changeImage++;
	}else{
		echo "<script>alert('Format File Salah'); 	window.location.href='../../view/user/profilePage.php'</script>";
	//echo $msg;
	}
	//Max Upload File
	if ($_FILES['imageupload']['size'] <= $maxsize){
		$changeImage++;
	}else{
		echo "<script>alert('File Terlalu Besar'); 	window.location.href='../../view/user/profilePage.php'</script>";
	}
	if ($changeImage == 2){
		move_uploaded_file($_FILES['imageupload']['tmp_name'], $target);
		chmod($target, 0755);
		$sql = "UPDATE datadiri_alumni
				SET nama = '$nama', image = '$newname', provinsi = '$provinsi', kabupaten = '$kabupaten', kecamatan = '$kecamatan', alamat = '$alamat', noHP = '$noHP', angkatan = '$angkatan', lulusan = '$lulusan', pekerjaan = '$pekerjaan', tempat_lahir = '$tempatlahir', tanggal_lahir = '$date'
				where
				email = '$email' ";
	  $sql2 = "UPDATE user	SET name = '$nickname' where email = '$email' ";
		mysqli_query($conn, $sql);
		mysqli_query($conn, $sql2);
		clearstatcache();//menghapus cache
		header("Location: ../../view/user/profilePage.php?refresh=1");
	}
}else{
	$sql = "UPDATE datadiri_alumni
			SET nama = '$nama', image = '$newname', provinsi = '$provinsi', kabupaten = '$kabupaten', kecamatan = '$kecamatan', alamat = '$alamat', noHP = '$noHP', angkatan = '$angkatan', lulusan = '$lulusan', pekerjaan = '$pekerjaan', tempat_lahir = '$tempatlahir', tanggal_lahir = '$date'
			where
			email = '$email' ";
	$sql2 = "UPDATE user	SET name = '$nickname' where email = '$email' ";
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql2);
	header("Location: ../../view/user/profilePage.php?sukses=1");
}
