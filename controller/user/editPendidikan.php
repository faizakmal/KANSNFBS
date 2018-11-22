<?php

include '../../database/connect.php';

$email     		   =  $_POST['inputEmail'];
$strata 		   =  $_POST['inputStrata'];
$universitas 	   =  $_POST['inputUniversitas'];
$fakultas    	   =  $_POST['inputFakultas'];
$jurusan 	   	   =  $_POST['inputJurusan'];
$tahunMasuk  	   =  $_POST['inputTahunMasuk'];


$sql = "UPDATE pendidikan_alumni
			SET strata = '$strata', universitas = '$universitas', fakultas = '$fakultas', jurusan = '$jurusan', tahunMasuk = '$tahunMasuk'
			where 
			email = '$email' ";

/*$result = mysqli_query($conn, $sql);
if ($result) {
	echo "<script>alert('Data Pendidikan Alumni Berhasil diupdate'); window.location.href='../../view/user/profilePage.php'</script>";
}
else {
	echo "<script>alert('Data Tidak Tersimpan'); window.location.href='../../view/user/profilePage.php'</script>";
}*/
mysqli_query($conn, $sql);
header("Location: ../../view/user/profilePage.php?sukses=1");
