<?php

include '../../database/connect.php';

$email     		   =  $_POST['inputEmail'];
$fb    			   =  $_POST['inputFacebook'];
$twitter 		   =  $_POST['inputTwitter'];
$line 		   	   =  $_POST['inputLine'];
$instagram 	   	   =  $_POST['inputInstagram'];
$whatsapp 	  	   =  $_POST['inputWhatsapp'];
$linkedin  	   =  $_POST['inputLinkedIn'];

$sql = "UPDATE mediasosial_alumni
			SET facebook = '$fb', twitter = '$twitter', lineid = '$line', instagram = '$instagram', whatsapp = '$whatsapp' , linkedin = '$linkedin'
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
