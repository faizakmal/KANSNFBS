<?php
if($_GET['refresh'] == 1){
	echo "<script>window.location.href='../../view/user/profilePage.php'</script>";
}

session_start();
if (!isset($_SESSION['name'])){
    header('Location:../../index.php');
  }
include '../../controller/user/profile.php';
include '../../database/connect.php';


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KANS NFBS | Profile</title>
  <link href='../../dist/img/icon.png' rel='shortcut icon'>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--Script For Autocomplete Input Alamat-->
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
  <?php
    include "../../dist/user/style.php"
  ?>
  <script type="text/javascript">
  $( document ).ready(function() {
    var tempProvinsi = "<?php echo $provinsi?>";
    var tempKabupaten = "<?php echo $kabupaten?>";
    var tempKecamatan = "<?php echo $kecamatan?>";
    var temp = "Provinsi : "+tempProvinsi+" Kabupaten: "+tempKabupaten+" Kecamatan: "+tempKecamatan;
    console.log(temp);
    if(tempProvinsi != ""){
        
        document.getElementById("divKabupaten").style.display = "block";
        
        let dropdown = $('#myKabupaten');
        var picked = 0;
        dropdown.empty();
                                
        dropdown.append('<option selected="true" disabled>Pilih Kabupaten/Kota</option>');
        
        $.getJSON('http://kansnfbs.com/controller/user/getData.php?province='+tempProvinsi, function (data) {
            $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.ID).text(entry.NAME));
                if(tempKabupaten == entry.ID) picked = key;
            })
            dropdown.prop('selectedIndex', picked+1);
        });
        
        if(tempKabupaten != ""){
            
            document.getElementById("divKecamatan").style.display = "block";
            
            let dropdown = $('#myKecamatan');
            var picked = 0;
            dropdown.empty();
                                    
            dropdown.append('<option selected="true" disabled>Pilih Kecamatan</option>');
            
            $.getJSON('http://kansnfbs.com/controller/user/getData.php?kabupaten='+tempKabupaten, function (data) {
                $.each(data, function (key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.ID).text(entry.NAME));
                    if(tempKecamatan == entry.ID) picked = key;
                })
                dropdown.prop('selectedIndex', picked+1);
            });
            if(tempKecamatan != ""){
                
                document.getElementById("inputAlamat").disabled = false;
            }else document.getElementById("inputAlamat").disabled = true;
        }else document.getElementById("divKecamatan").style.display = "none";
    }else{
        
        document.getElementById("divKabupaten").style.display = "none";
        document.getElementById("divKecamatan").style.display = "none";
        document.getElementById("inputAlamat").disabled = true;
    }
  });
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!--navbar header-->
  <header class="main-header">
    <a href="dashboardPage.php" class="logo">
      <span class="logo-mini"><b>NF</b></span>
      <span class="logo-lg"><img src="../../dist/img/btnhome.png" class="img-circle" alt="Home" style="margin-right: 10px;"><b>KANS NFBS</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="profilePage.php">
              <span class="hidden-xs">Welcome, <?php echo $_SESSION['name']; ?></span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Tutup navbar header-->
  </header>
  <!-- Sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/userpicture/<?php echo $image?>" style="width: 36px; height: 36px; border-radius: 50%;" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="dashboardPage.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="cariAlumniPage.php"><i class="fa fa-search"></i> <span>Cari Alumni</span></a></li>
        <li class="active"><a href="profilePage.php"><i class="fa fa-book"></i> <span>Profile</span></a></li>
        <li class="header">SETTINGS</li>
        <li><a href="../../index.php"><i class="fa fa-circle-o text-green"></i> <span>Home</span></a></li>
        <li><a href="../../controller/logout.php"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a></li>
      </ul>
    </section>
  </aside>
  
  <div class="content-wrapper">
         <?php
        if($_GET['sukses'] == 1){
    ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                Data Berhasil Diupdate 
    </div>
    <?php
        }
    ?>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
            });
        }, 1500);
    </script>
    <section class="content-header">
      <h1>Profil</h1>
      <ol class="breadcrumb">
        <li><a href="dashboardPage.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-book"></i> Profile</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/userpicture/<?php echo $image?>" alt="User profile picture" style = "width: 100px; height: 100px; border-radius: 50%;" >
              <h3 class="profile-username text-center"><?php echo $name; ?></h3>
              <p class="text-muted text-center"><?php echo $email; ?></p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Nama</b> <a class="pull-right"><?php echo $name; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?php echo $email; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Angkatan</b> <a class="pull-right"><?php echo $angkatan; ?> <?php echo $lulusan; ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-map-marker margin-r-5"></i>Alamat</strong>
              <p class="text-muted"><?php echo $alamats; ?></p>

              <hr>

              <strong><i class="fa fa-phone margin-r-5"></i>No HP</strong>
              <p class="text-muted"><?php echo $noHP; ?></p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Pendidikan</strong>
              <p class="text-muted"><?php echo $jurusan; ?>, <?php echo $universitas; ?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-8">
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Data Diri</a></li>
              <li><a href="#tab_2" data-toggle="tab">Pendidikan Terakhir</a></li>
              <li><a href="#tab_3" data-toggle="tab">Pekerjaan</a></li>
              <li><a href="#tab_4" data-toggle="tab">Media Sosial</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controller/user/editDatadiri.php">
                  <div class="form-group">
                    <div class="col-sm-10">
                      <input type="hidden" class="form-control" name="inputEmail" value= "<?php echo $email; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputNama" class="col-sm-2 control-label">Nama Lengkap</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputNama" placeholder="Nama Lengkap"  value= "<?php echo $name; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputNama" class="col-sm-2 control-label">Nama Panggilan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputNamaPanggilan" placeholder="Nama Panggilan"  value= "<?php echo $namapanggilan; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputTempatLahir" class="col-sm-2 control-label">Tempat Lahir</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputTempatLahir" placeholder="Tempat Lahir"  value= "<?php echo $tempatlahir; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputTempatLahir" class="col-sm-2 control-label">Tanggal Lahir</label>

                    <div class="col-sm-10">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" name="datepicker" value="<?php echo $tanggallahir; ?>">
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                      <label for="inputAlamat" class="col-sm-2 control-label"></label>
                     <div class="col-sm-10">
                       <a>Inputkan alamat tempat tinggal anda sekarang</a>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputProvinsi" class="col-sm-2 control-label">Provinsi</label>

                    <div id="divProvinsi" class="col-sm-10">
                        <select id="myProvince" onchange="myProvinceS()" class="form-control select2" placeholder="Provinsi" name="inputProvinsi" style="width: 100%;">
                            <?php
                                $sql =  "SELECT * FROM `provinces` ORDER BY name";
                                $result = mysqli_query($conn, $sql);
                                if($provinsi == null) echo "<option value ="."Pilih Provinsi"." selected disabled>"."Pilih Provinsi"."</option>";
                                while($data = mysqli_fetch_array($result)){
                                    if($data[0] == $provinsi){
                                      echo "<option value =".$data['0']." selected>".$data[1]."</option>";
                                    } 
                                    else echo "<option value =".$data['0'].">".$data[1]."</option>";
                                }
                            ?>
                      </select>
                        <script>
                            function myProvinceS() {
                                document.getElementById("divKabupaten").style.display = "block";
                                document.getElementById("divKecamatan").style.display = "none";
                                document.getElementById("inputAlamat").disabled = true;
                                var province = document.getElementById("myProvince").value;
                                let dropdown = $('#myKabupaten');

                                dropdown.empty();
                                
                                dropdown.append('<option selected="true" disabled>Pilih Kabupaten/Kota</option>');
                                dropdown.prop('selectedIndex', 0);
                                $.getJSON('http://kansnfbs.com/controller/user/getData.php?province='+province, function (data) {
                                  $.each(data, function (key, entry) {
                                    dropdown.append($('<option></option>').attr('value', entry.ID).text(entry.NAME));
                                  })
                                });
                    
                            }
                        </script>
                    </div>
                  </div>
                  <div id="divKabupaten" class="form-group">
                    <label for="inputKabupaten" class="col-sm-2 control-label">Kota/Kabupaten</label>

                    <div class="col-sm-10">
                        <select id="myKabupaten" onchange="myKabupatenS()" class="form-control select2" placeholder="Kabupaten" name="inputKabupaten" style="width: 100%;">
                            
                      </select>
                      <script>
                            function myKabupatenS() {
                                document.getElementById("divKecamatan").style.display = "block";
                                document.getElementById("inputAlamat").disabled = true;
                                var kabupaten = document.getElementById("myKabupaten").value;
                                let dropdown = $('#myKecamatan');

                                dropdown.empty();
                                
                                dropdown.append('<option selected="true" disabled>Pilih Kabupaten/Kota</option>');
                                dropdown.prop('selectedIndex', 0);
                                $.getJSON('http://kansnfbs.com/controller/user/getData.php?kabupaten='+kabupaten, function (data) {
                                  $.each(data, function (key, entry) {
                                    dropdown.append($('<option></option>').attr('value', entry.ID).text(entry.NAME));
                                  })
                                });
                            }
                        </script>
                    </div>
                  </div>
                  <div id="divKecamatan" class="form-group">
                    <label for="inputAlamat" class="col-sm-2 control-label">Kecamatan</label>

                    <div class="col-sm-10">
                        <select id="myKecamatan" onchange="myKecamatanS()" class="form-control select2" placeholder="Provinsi" name="inputKecamatan" style="width: 100%;">
                            <option selected="selected"><?php echo $kota; ?></option>
                            
                      </select>
                      <script>
                            function myKecamatanS() {
                                document.getElementById("divKecamatan").style.display = "block";
                                document.getElementById("inputAlamat").disabled = false;
                            }
                        </script>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="inputAlamat" class="col-sm-2 control-label">Detail Alamat</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputAlamat" name="inputAlamat" placeholder="Detail Alamat (Nama Jalan, Nomor Rumah)"  value= "<?php echo $alamat; ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputNoHP" class="col-sm-2 control-label">Nomor HP</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputNoHP" placeholder="NoHP"  value= "<?php echo $noHP; ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputAngkatan" class="col-sm-2 control-label">Angkatan</label>

                    <div class="col-sm-10">

                      <input type="text" class="form-control" name="inputAngkatan" placeholder="Angkatan (Angka)"  value="<?php echo $angkatan; ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputLulusan" class="col-sm-2 control-label">Lulusan</label>

                    <div class="col-sm-10">
                        <select class="form-control select2" name="inputLulusan" style="width: 100%;">
                            <option selected="selected"><?php echo $lulusan; ?></option>
                            <option>SMP</option>
                            <option>SMA</option>
                            <option>SMP-SMA</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPekerjaan" class="col-sm-2 control-label">Pekerjaan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputPekerjaan" placeholder="Pekerjaan" value= "<?php echo $pekerjaan; ?>" >
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Upload Foto Profil</label>
                    <br>
                    <div class="col-sm-10">
                       <input type="file" name="imageupload">
                       <a>*max file size 1Mb</a>
                      </div>
                    </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success" onclick='return checkInput()'>Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                 <form class="form-horizontal" method="POST" action="../../controller/user/editPendidikan.php">
                  <div class="form-group">
                    <div class="col-sm-10">
                      <input type="hidden" class="form-control" name="inputEmail" value=<?php echo $email; ?> >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputStrata" class="col-sm-2 control-label">Strata</label>

                    <div class="col-sm-10">
                      <select class="form-control select2" name="inputStrata">
                            <option selected="selected"><?php echo $strata; ?></option>
                            <option>D1/D2</option>
                            <option>D3</option>
                            <option>S1</option>
                            <option>S2</option>
                            <option>S3</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputUniversitas" class="col-sm-2 control-label">Universitas</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputUniversitas" placeholder="Universitas" value= "<?php echo $universitas; ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputFakultas" class="col-sm-2 control-label">Fakultas</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputFakultas" placeholder="Fakultas" value= "<?php echo $fakultas; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputJurusan" class="col-sm-2 control-label">Jurusan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputJurusan" placeholder="Jurusan" value= "<?php echo $jurusan; ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputTahunMasuk" class="col-sm-2 control-label">Tahun Masuk</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputTahunMasuk" placeholder="Tahun Masuk" value= "<?php echo $tahunMasuk; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success" onclick='return checkInput()'>Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <form class="form-horizontal" method="POST" action="../../controller/user/editPekerjaan.php">
                  <div class="form-group">
                    <div class="col-sm-10">
                     <input type="hidden" class="form-control" name="inputEmail" value=<?php echo $email; ?> >
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputJenisPerusahaan" class="col-sm-2 control-label">Jenis Perusahaan</label>

                    <div class="col-sm-10">
                      <select class="form-control select2" name="inputJenisPerusahaan" style="width: 100%;">
                            <option selected="selected"><?php echo $jenisPerusahaan; ?></option>
                            <option>Swasta</option>
                            <option>Pemerintahan</option>
                            <option>Bisnis</option>
                            <option>NGO/LSM</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputNamaPerusahaan" class="col-sm-2 control-label">Nama Perusahaan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputNamaPerusahaan" placeholder="Nama Perusahaan" value="<?php echo $namaPerusahaan; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputDivisiPerusahaan" class="col-sm-2 control-label">Divisi Perusahaan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputDivisiPerusahaan" placeholder="Divisi Perusahaan" value="<?php echo $divisiPerusahaan; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputTahunPekerjaan" class="col-sm-2 control-label">Tahun Bekerja</label>

                    <div class="col-sm-7">
                      <input type="year" class="form-control" name="inputTahunPekerjaan" placeholder="Tahun Bekerja" value="<?php echo $tahunPerusahaan; ?>">
                    </div>
                    <div class="col-sm-3">
                     <label for="inputTahunPekerjaan" class="col-sm-3 control-label">Tahun </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success" onclick='return checkInput()'>Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="tab_4">
                <form class="form-horizontal" method="POST" action="../../controller/user/editMediaSosial.php">
                  <div class="form-group">
                    <div class="col-sm-10">
                     <input type="hidden" class="form-control" name="inputEmail" value=<?php echo $email; ?> >
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputFacebook" class="col-sm-2 control-label">Facebook</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputFacebook" placeholder="facebook.com/..." value=<?php echo $facebook; ?>>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputTwitter" class="col-sm-2 control-label">Twitter</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputTwitter" placeholder="@..." value=<?php echo $twitter; ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputLine" class="col-sm-2 control-label">Line ID</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputLine" placeholder="ID Line" value=<?php echo $line; ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputInstagram" class="col-sm-2 control-label">Instagram</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputInstagram" placeholder="@..." value=<?php echo $instagram; ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputWhatsapp" class="col-sm-2 control-label">WhatsApp</label>
                        <?php
                            if ($whatsapp != ""){
                                $hp = $whatsapp;
                            }
                            else{
                                $hp = $noHP;
                            }
                        ?>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="inputWhatsapp" placeholder="Nomor WhatsApp" value=<?php echo $hp; ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputLinkedIn" class="col-sm-2 control-label">LinkedIn</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="inputLinkedIn" placeholder="linkedin.com/in/..."  value= "<?php echo $linkedin; ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success" onclick='return checkInput()'>Submit</button>
                    </div>
                  </div>
                </form>
              </div>
          
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <strong>Copyright © KANS NFBS 2018 </strong>
  </footer>
    <?php
    include "../../dist/user/js.php"
     ?>
</body>
</html>
