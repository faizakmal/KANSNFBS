<!DOCTYPE html>
<html>
<title>KANS NFBS</title>
<link href='dist/img/icon.png' rel='shortcut icon'>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="dist/index/css.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/id/id-all.js"></script>

<?php
	session_start(); //session start
    $_SESSION['LAST_ACTIVITY'] = time();
    
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
    }
    if($_SESSION['last_session_request'] > time() - 2){
    // users will be redirected to this page if it makes requests faster than 2 seconds
    header("location: http://kansnfbs.com/");
    exit;
}
    
	include 'database/connect.php';
	require_once ('libraries/Google/autoload.php');
    
	//****************************GOOGLE API***************************
	//Insert your cient ID and secret
	//You can get it from : https://console.developers.google.com/
	$client_id = '986913153276-cabpoa6h8s1j44evquc7v27abpf4tif1.apps.googleusercontent.com';
	$client_secret = 'h_CNIYbx4T5yfpHOxnxzXG5S';
	$redirect_uri = 'http://kansnfbs.com/';

	if (isset($_GET['logout'])) {
	  unset($_SESSION['access_token']);
	}

	$client = new Google_Client();
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect_uri);
	$client->addScope("email");
	$client->addScope("profile");

	$service = new Google_Service_Oauth2($client);

	if (isset($_GET['code'])) {
	  $client->authenticate($_GET['code']);
	  $_SESSION['access_token'] = $client->getAccessToken();
	  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
	  exit;
	}

	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	  $client->setAccessToken($_SESSION['access_token']);
	} else {
	  $authUrl = $client->createAuthUrl();
	}

	////**************************MAPS//**************************
	$temp;

	$proviceArr = array("11","64","33","17","36"
					   ,"61","19","51","35","63"
					   ,"53","73","21","91", "12"
					   ,"14","71","82","13","81","52"
					   ,"74","72","94","32","18","31"
					   ,"75","34","62","16","76"
					   ,"15");
	$sumArr = count($proviceArr);
	for($a = 0; $a < $sumArr; $a++){
		$nameProvince = $proviceArr[$a];
		$sql = "SELECT COUNT(datadiri_alumni.provinsi) FROM datadiri_alumni WHERE datadiri_alumni.provinsi=$nameProvince";
		$result = mysqli_query($conn, $sql);
		if ($data = mysqli_fetch_array ($result))
			$temp = $data[0];
		$sumPopulation[$a] = $temp;
	}
	//**************************END MAPS********************************

?>
<script type="text/javascript">
    $(document).ready(function(){
		//MAP
		var data = [
			['id-3700', 0],
			['id-ac', <?php echo $sumPopulation[0];?>], //aceh
			['id-ki', <?php echo $sumPopulation[1];?>], //kalimantan timur
			['id-jt', <?php echo $sumPopulation[2];?>], //jawa tengah
			['id-be', <?php echo $sumPopulation[3];?>], //bengkulu
			['id-bt', <?php echo $sumPopulation[4];?>], //banten
			['id-kb', <?php echo $sumPopulation[5];?>], //kalimantan barat
			['id-bb', <?php echo $sumPopulation[6];?>], //bangka belitung
			['id-ba', <?php echo $sumPopulation[7];?>], //bali
			['id-ji', <?php echo $sumPopulation[8];?>], //jawa timur
			['id-ks', <?php echo $sumPopulation[9];?>], //kalimantan selatan
			['id-nt', <?php echo $sumPopulation[10];?>], //NTT
			['id-se', <?php echo $sumPopulation[11];?>], //sulawesi selatan
			['id-kr', <?php echo $sumPopulation[12];?>], //kepulawan riau
			['id-ib', <?php echo $sumPopulation[13];?>], //irian jaya
			['id-su', <?php echo $sumPopulation[14];?>], //sumatra utara
			['id-ri', <?php echo $sumPopulation[15];?>], //riau
			['id-sw', <?php echo $sumPopulation[16];?>], //sulawesi utara
			['id-la', <?php echo $sumPopulation[17];?>], //maluku utara
			['id-sb', <?php echo $sumPopulation[18];?>], //sumatera barat
			['id-ma', <?php echo $sumPopulation[19];?>], //malluku
			['id-nb', <?php echo $sumPopulation[20];?>], //NTB
			['id-sg', <?php echo $sumPopulation[21];?>], //sulawesi tenggara
			['id-st', <?php echo $sumPopulation[22];?>], //sulawesi tengah
			['id-pa', <?php echo $sumPopulation[23];?>], //papua
			['id-jr', <?php echo $sumPopulation[24];?>], //jawa barat
			['id-1024', <?php echo $sumPopulation[25];?>], //lampung
			['id-jk', <?php echo $sumPopulation[26];?>], //jakarta
			['id-go', <?php echo $sumPopulation[27];?>], //gorontalo
			['id-yo', <?php echo $sumPopulation[28];?>], //jogja
			['id-kt', <?php echo $sumPopulation[29];?>], //kalimantan tengah
			['id-sl', <?php echo $sumPopulation[30];?>], //sumatera selatan
			['id-sr', <?php echo $sumPopulation[31];?>], //sulawesi barat
			['id-ja', <?php echo $sumPopulation[32];?>]  //jambi
		];

		// Create the chart
		Highcharts.mapChart('containermap', {
			chart: {
				map: 'countries/id/id-all'
			},

			title: {
				text: 'Persebaran Alumni Nurul Fikri Boarding School'
			},

			subtitle: {
				text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/id/id-all.js">Indonesia</a>'
			},

			mapNavigation: {
				enabled: true,
				buttonOptions: {
					verticalAlign: 'bottom'
				}
			},

			colorAxis: {
				min: 0
			},

			series: [{
				data: data,
				name: 'Jumlah Alumni',
				states: {
					hover: {
						color: '#BADA55'
					}
				},
				dataLabels: {
					enabled: true,
					format: '{point.name}'
				}
			}]
		});
		//************
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();
      // Store hash
			var hash = this.hash;
      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
           // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>

<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar" id="myNavbar">
    <a class="w3-bar-item w3-button  w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
      <i class="fa fa-bars"></i>
    </a>
    <a href="#home" class="w3-bar-item w3-button ">HOME</a>
    <a href="#persebaranAlumni" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> Pesebaran Alumni</a>
    <a href="#kegiatan" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-camera-retro"></i> Agenda Alumni</a>
    <a href="#contact" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i> Kontak</a>
		<?php
		if (isset($authUrl)){
			//show login url
			echo '<a href="'.$authUrl.'" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-green">Login</a>';
		}else{
			$user = $service->userinfo->get(); //get user info

			//check if user exist in database using COUNT
			$result = $conn->query("SELECT COUNT(email) as usercount FROM user WHERE email='$user->email'");
			$user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist

			//admin
			if($user->email == "kansnfbs@gmail.com"){
				$_SESSION['email'] = $user->email;
				$_SESSION['name'] = "admin";
				echo "<script>window.location.href='view/admin/dashboardPage.php'</script>";
			}
			//if user already exist
			else if($user_count){
					$_SESSION['email'] = $user->email;
					$_SESSION['name'] = $user->name;
		      echo '<a href="'.$redirect_uri.'?logout=1" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">Log Out</a><a class="w3-bar-item  w3-button w3-right w3-hide-small" href="view/user/dashboardPage.php">'.$user->name.'</a>';
		   }else{
				 //REGISTER
				 //insert ke database
				 $nopic = $user->picture;
				 $picforuser = 'dist/userpicture/'.$user->email.'.png';
				 $emailpic = $user->email.".png";
				 copy($nopic, $picforuser);
				 $sql = "INSERT INTO user (email, name) VALUES ('$user->email', '');";
				 $sql1 = "INSERT INTO datadiri_alumni (email, nama, image, alamat, noHP, angkatan, lulusan, pekerjaan) VALUES ('$user->email', '$user->name', '$emailpic', '', '', '', '', '');";
				 $sql2 = "INSERT INTO pekerjaan_alumni (email, namaPerusahaan, jenisPerusahaan) VALUES ('$user->email', '', '');";
				 $sql3 = "INSERT INTO pendidikan_alumni (email, universitas, fakultas, jurusan, tahunMasuk) VALUES ('$user->email', '', '', '', '');";
				 $sql4 = "INSERT INTO mediasosial_alumni (email, facebook, twitter, lineid, instagram, whatsapp, linkedin) VALUES ('$user->email', '', '', '', '', '', '');";
				 mysqli_query($conn, $sql);
				 mysqli_query($conn, $sql1);
				 mysqli_query($conn, $sql2);
				 mysqli_query($conn, $sql3);
				 mysqli_query($conn, $sql4);
				 $_SESSION['email'] = $user->email;
				 $_SESSION['name'] = $user->name;
				 echo "<script>window.location.href='view/user/profilePage.php'</script>";
			 }
		}
		?>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
    <a href="#persebaranAlumni" class="w3-bar-item w3-button" onclick="toggleFunction()">Persebaran Alumni</a>
    <a href="#kegiatan" class="w3-bar-item w3-button" onclick="toggleFunction()">Agenda Alumni</a>
    <a href="#contact" class="w3-bar-item w3-button" onclick="toggleFunction()">Kontak</a>
    <?php
    if (isset($authUrl)){
		//show login url
		echo '<a href="'.$authUrl.'" class="w3-bar-item w3-button w3-hover-green">Login</a>';
	}else{
	   $user = $service->userinfo->get(); //get user info

		//check if user exist in database using COUNT
		$result = $conn->query("SELECT COUNT(email) as usercount FROM user WHERE email='$user->email'");
		$user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist
		
		//admin
			if($user->email == "kansnfbs@gmail.com"){
				$_SESSION['email'] = $user->email;
				$_SESSION['name'] = "admin";
				echo "<script>window.location.href='view/admin/dashboardPage.php'</script>";
			}
			//if user already exist
			else if($user_count){
				$_SESSION['email'] = $user->email;
				$_SESSION['name'] = $user->name;
		        echo '<a class="w3-bar-item w3-button" href="view/user/dashboardPage.php">'.$user->name.'</a><a href="'.$redirect_uri.'?logout=1" class="w3-bar-item w3-button w3-hover-red">Log Out</a>';
		   }else{
				 //REGISTER
				 //insert ke database
				 $nopic = $user->picture;
				 $picforuser = 'dist/userpicture/'.$user->email.'.png';
				 $emailpic = $user->email.".png";
				 copy($nopic, $picforuser);
				 $sql = "INSERT INTO user (email, name) VALUES ('$user->email', '');";
				 $sql1 = "INSERT INTO datadiri_alumni (email, nama, image, alamat, noHP, angkatan, lulusan, pekerjaan) VALUES ('$user->email', '$user->name', '$emailpic', '', '', '', '', '');";
				 $sql2 = "INSERT INTO pekerjaan_alumni (email, namaPerusahaan, jenisPerusahaan) VALUES ('$user->email', '', '');";
				 $sql3 = "INSERT INTO pendidikan_alumni (email, universitas, fakultas, jurusan, tahunMasuk) VALUES ('$user->email', '', '', '', '');";
				 $sql4 = "INSERT INTO mediasosial_alumni (email, facebook, twitter, lineid, instagram, whatsapp, linkedin) VALUES ('$user->email', '', '', '', '', '', '');";
				 mysqli_query($conn, $sql);
				 mysqli_query($conn, $sql1);
				 mysqli_query($conn, $sql2);
				 mysqli_query($conn, $sql3);
				 mysqli_query($conn, $sql4);
				 $_SESSION['email'] = $user->email;
				 $_SESSION['name'] = $user->name;
				 echo "<script>window.location.href='view/user/profilePage.php'</script>";
			 }
	}
    ?>
  </div>
</div>

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-top">
      <header class="w3-container w3-aqua">
        <span onclick="document.getElementById('id01').style.display='none'"
        class="w3-button w3-display-topright">&times;</span>
        <h2>Login</h2>
      </header>
      <div class="w3-container">
        <form class="w3-container" action="controller/signin.php" method="post">
           <br>
           <i class="fa fa-envelope"></i><label> Email</label>
            <input class="w3-input w3-border" type="text" name="form-email" placeholder="Input Email">
            <br>
          <i class="fa fa-lock"></i><label> Password</label>
            <input class="w3-input w3-border" type="Password" name="form-password" placeholder="Input Password">
            <br>
        <button type="button" class="w3-button w3-black w3-left w3-section" onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none'; ">
        Register</button>
        <button type="submit" class="w3-button w3-black w3-right w3-section" name="login" id="login">Login</button>
      </div>
    </div>
    </form>
  </div>
  <div id="id02" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-top">
      <header class="w3-container w3-green">
        <span onclick="document.getElementById('id02').style.display='none'; "
        class="w3-button w3-display-topright">&times;</span>
        <h2>Register</h2>
      </header>
      <div class="w3-container">
        <form class="w3-container" action="controller/signup.php" method="post">
           <br>
          <i class="fa fa-envelope"></i><label> Email</label>
            <input class="w3-input w3-border" type="text" name="form-email" placeholder="Input Email">
            <br>
           <i class="fa fa-lock"></i> <label> Password</label>
            <input class="w3-input w3-border" type="Password" name="form-password" placeholder="Input Password">
            <br>
             <i class="fa fa-lock"></i><label> ReType Password</label>
            <input class="w3-input w3-border" type="Password"  name="form-repassword" placeholder="ReType Password">
            <br>
             <i class="fa fa-user"></i><label> Nama Panggilan</label>
            <input class="w3-input w3-border" type="text" name="form-nama" placeholder="Input Nama Panggilan">
            <br>
            <i class="fa fa-mortar-board"></i><label>Angkatan</label>
            <input class="w3-input w3-border" type="number" name="form-angkatan" placeholder="Angkatan (1, 2, 3, ...)">
            <br>
        <button type="submit" class="w3-button w3-black w3-right w3-section" name="register" id="register">Regsiter</button>
      </div>
    </div>
    </form>
  </div>

<!-- First Parallax Image with Logo Text -->
<div class="bgimg-1 w3-display-container w3-opacity" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
    <span class="w3-center w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">KANS <span class="w3-hide-small">NFBS</span>
  </div>
</div>

<!-- Container (About Section) -->
<div class="w3-content w3-container w3-padding-64" id="persebaranAlumni" >
  <h3 class="w3-center">PERSEBARAN ALUMNI</h3>
  <p class="w3-center" ><em>  </em></p><br>
  <div id="containermap" style="width:100%"></div>
</div>


<!-- Second Parallax Image with Portfolio Text -->
<div class="bgimg-2 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
    <span class="w3-xxlarge w3-text-white w3-wide">AGENDA</span>
  </div>
</div>

<!-- Container (Portfolio Section) -->
<div class="w3-content w3-container w3-padding-64" id="kegiatan">
  <h3 class="w3-center">AGENDA ALUMNI</h3>
<p class="w3-center"><em>Agenda-Agenda KANS NFBS</em></p><br>
    <div class="w3-display-container mySlides">
      <div class='w3-row-padding w3-padding-16 w3-center'>

<?php
// use this instagram access token generator http://instagram.pixelunion.net/
$access_token="1835721399.1677ed0.4d2b46aa4d284eb6b7da1a12afd6b7ce";
$photo_count=4;

$json_link="https://api.instagram.com/v1/users/self/media/recent/?";
$json_link.="access_token={$access_token}&count={$photo_count}";
$json = file_get_contents($json_link);
$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

echo "";
foreach ($obj['data'] as $post) {

    $pic_text=$post['caption']['text'];
    $pic_link=$post['link'];
    $pic_like_count=$post['likes']['count'];
    $pic_comment_count=$post['comments']['count'];
    $pic_src=str_replace("http://", "https://", $post['images']['standard_resolution']['url']);
    $pic_created_time=date("F j, Y", $post['caption']['created_time']);
    $pic_created_time=date("F j, Y", strtotime($pic_created_time . " +1 days"));

      echo "<div class='w3-quarter'>";
        echo "<a href='{$pic_link}' target='_blank'>";
            echo "<img class='img-responsive photo-thumb' style='width:100%' src='{$pic_src}' alt='{$pic_text}'>";
        echo "</a>";
        echo "</p>";
      echo "</div>";
}
?>

    </div>
  </div>
</div>



</div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>

<!-- Third Parallax Image with Portfolio Text -->
<div class="bgimg-3 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
     <span class="w3-xxlarge w3-text-white w3-wide">KONTAK</span>
  </div>
</div>

<!-- Container (Contact Section) -->
<div class="w3-content w3-container w3-padding-64" id="contact">
  <h3 class="w3-center">KONTAK KANS NFBS</h3>
  <div class="w3-row w3-padding-32 w3-section">
    <div class="w3-col m7 w3-container">
      <!-- Add Google Maps -->
      <div id="googleMap" class="w3-round-large w3-greyscale" style="width:100%;height:400px;"></div>
    </div>
    <br><br><br><br><br><br>
    <div class="w3-col m5 w3-panel">
      <div class="w3-large w3-margin-bottom">
        <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Nurul Fikri Boarding School Anyer<br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: kansnfbs@gmail.com<br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Line: @jgb2043c<br>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64 w3-opacity w3-hover-opacity-off">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
     <a href="http://facebook.com/kansnurulfikri"  target="_blank"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
     <a href="http://instagram.com/kansnfbs"  target="_blank"><i class="fa fa-instagram w3-hover-opacity"></i></a>
     <a href="http://twitter.com/kansnfbs"  target="_blank"><i class="fa fa-twitter w3-hover-opacity"></i></a>
  </div>
  <p>Copyright &copy; Kans NFBS 2018 </p>
</footer>
 <script type="text/javascript" src="dist/index/js.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAc9pBfRDe2elx10Tm4wmsYhoBgTKjmG9k&callback=myMap"></script>
</body>
</html>
