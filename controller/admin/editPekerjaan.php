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
			
$result = mysqli_query($conn, $sql);
header("Location: ../../view/admin/detailPage.php?id=".$email."");
