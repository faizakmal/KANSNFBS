<?php
session_start();
if (!isset($_SESSION['name'])){
    header('Location:../../index.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KANS NFBS | Cari Alumni</title>
  <link href='../../dist/img/icon.png' rel='shortcut icon'>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <?php
    include "../../dist/user/style.php"
  ?>
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
          <img src="../../dist/userpicture/<?php echo $_SESSION['email'].".png"?>" style="width: 36px; height: 36px; border-radius: 50%;" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="dashboardPage.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="cariAlumniPage.php"><i class="fa fa-search"></i> <span>Cari Alumni</span></a></li>
        <li><a href="profilePage.php"><i class="fa fa-book"></i> <span>Profile</span></a></li>
        <li class="header">SETTINGS</li>
        <li><a href="../../index.php"><i class="fa fa-circle-o text-green"></i> <span>Home</span></a></li>
        <li><a href="../../controller/logout.php"><i class="fa fa-circle-o text-red"></i> <span>Logout</span></a></li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Daftar<small>Alumni</small></h1>
      <ol class="breadcrumb">
        <li><a href="dashboardPage.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-search"></i> Cari Alumni</a></li>
      </ol>
    </section>
    <section class="content">
         <div class="box">
           <div class="box-header with-border">
          <h3 class="box-title">Alumni-Alumni KANS NFBS</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped" >
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Angkatan</th>
                  <th>Lulusan</th>
                  <th></th>
                </tr>
                </thead>
                <?php
                    include '../../controller/user/display.php';
                ?>
              </table>
            </div>

        </div>
        <div class="box-footer">
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <strong>Copyright © KANS NFBS 2018 </strong>
  </footer>
 <?php
    include "../../dist/admin/js.php"
  ?>
</body>
</html>
