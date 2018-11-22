<?php

include '../../database/connect.php';

$email     		   =  $_POST['inputEmail'];
$namaPerusahaan    =  $_POST['inputNamaPerusahaan'];
$jenisPerusahaan   =  $_POST['inputJenisPerusahaan'];
$divisi  		   =  $_POST['inputDivisiPerusahaan'];
$tahun 			   =  $_POST['inputTahunPekerjaan'];


$sql = "UPDATE pekerjaan_alumni
			SET namaPerusahaan = '$namaPerusahaan', jenisPerusahaan = '$jenisPerusahaan', divisiPerusahaan = '$divisi', tahunBekerja = '$tahun'
			where 
			email = '$email' ";
			
/*$result = mysqli_query($conn, $sql);
if ($result) {
	echo "<script>alert('Data Pekerjaan Alumni Berhasil diupdate'); window.location.href='../../view/user/profilePage.php'</script>";
}
else {
	echo "<script>alert('Data Tidak Tersimpan'); window.location.href='../../view/user/profilePage.php'</script>";
}*/

mysqli_query($conn, $sql);
header("Location: ../../view/user/profilePage.php?sukses=1");
