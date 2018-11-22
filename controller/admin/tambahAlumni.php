<?php

session_start();
include '../../database/connect.php';
	
$email           =  $_POST['inputEmail'];
$nama 	         =  $_POST['inputNama'];
$password 	     =  $_POST['inputPassword'];
$rePassword      = $_POST['inputReTypePassword'];

//cek data klo kosong
if(empty($nama) ||empty($email)||empty($password)){
	header("Location: ../../view/admin/dataPage.php?msg='Error!!, Fill The Data'");
	exit();
}else{
	//email checker validasi
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "<script>alert('Error!!, Email Invalid'); window.location.href='../../view/admin/dataPage.php'</script>";
		exit();
	}else{
			//email udah ke pake apa belom
			$sql = "SELECT * FROM user WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				echo "<script>alert('Error!!, This Email is Used'); window.location.href='../../view/admin/dataPage.php'</script>";
				exit();
			}else{
				//hashing password
				if($password==$rePassword){
				    $status = "Tidak Aktif";
					$pass = md5($password); // password encrypt					

					//insert ke database
					$sql = "INSERT INTO user (email, password, name, angkatan) VALUES ('$email', '$pass', '$nama', '');";
					$sql1 = "INSERT INTO datadiri_alumni (email, nama, image, alamat, noHP, angkatan, lulusan, pekerjaan) VALUES ('$email', '$nama', '', '', '', '', '', '');";
					$sql2 = "INSERT INTO pekerjaan_alumni (email, namaPerusahaan, jenisPerusahaan) VALUES ('$email', '', '');";
					$sql3 = "INSERT INTO pendidikan_alumni (email, universitas, fakultas, jurusan, tahunMasuk) VALUES ('$email', '', '', '', '');";
					$sql4 = "INSERT INTO mediasosial_alumni (email, facebook, twitter, lineid, instagram, whatsapp, linkedin) VALUES ('$email', '', '', '', '', '', '');";
					mysqli_query($conn, $sql);
					mysqli_query($conn, $sql1);
					mysqli_query($conn, $sql2);
					mysqli_query($conn, $sql3);
					mysqli_query($conn, $sql4);
					
					//sucess add to database
					echo "<script>alert('Account Created'); window.location.href='../../view/admin/dataPage.php'</script>";
					exit();
				}else{
					echo "<script>alert('Error!!, Repeat The Password'); window.location.href='../../view/admin/dataPage.php'</script>";
					exit();
				}				
			}
	}
}

