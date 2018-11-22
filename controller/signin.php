<?php

session_start();

include '../database/connect.php';

$password = mysqli_real_escape_string($conn, $_POST['form-password']);
$email    = mysqli_real_escape_string($conn, $_POST['form-email']);
$pass 	  = md5($password); //password decrypt
//check data login kosong
if(empty($email)||empty($password)){
	echo "<script>alert('Error!!, Please Input Username and Password'); window.location.href='../index.php'</script>";
	exit();
}else{
	$sql = "SELECT * FROM `user` WHERE `email`= '$email'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	//validasi Email
	if($resultCheck < 1){
		echo "<script>alert('Email Invalid'); window.location.href='../index.php'</script>";
		exit();
	}else{
		if($row =  mysqli_fetch_assoc($result)){
			//check password
			if($pass != $row['password']){
				echo "<script>alert('Email and Password Invalid'); window.location.href='../index.php'</script>";
				exit();
			}else{
				$_SESSION['email'] = $row['email'];
				$_SESSION['name'] = $row['name'];
				if ($row['email'] == 'admin@admin.com') {
						echo "<script>alert('Login Sukses'); window.location.href='../view/admin/dashboardPage.php'</script>";
						exit();
				}
				//login user
				else{
						echo "<script>alert('Login Sukses'); window.location.href='../view/user/dashboardPage.php'</script>";
						exit();
				}
			}
		}
	}
}
