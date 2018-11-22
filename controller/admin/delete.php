<?php

include '../../database/connect.php';
	
	$email= $_GET['id'];
    $sql="DELETE from user where email='$email'";
    mysqli_query($conn, $sql);
	header("location: ../../view/admin/dataPage.php");