<?php
//Android SplashScreen Check Connection to Database
$serverName = "mysql.hostinger.co.id";
$userName   = "u887437477_kans";
$password   = "123123123";
$db         = "u887437477_kans";

$conn = mysqli_connect($serverName, $userName, $password, $db);

$response = array();

if(!$conn){
  $response['error'] = true;
  die("Connection Error");
}else{
  $response['error'] = false;
}

if ($response == true){
  $response['message'] = 'Welcome to KANS NFBS Database';
}else{
  $response['message'] = 'Connection Error';
}

echo json_encode($response);
?>
