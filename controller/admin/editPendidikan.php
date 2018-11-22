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

$result = mysqli_query($conn, $sql);
header("Location: ../../view/admin/detailPage.php?id=".$email."");
