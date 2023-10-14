<?php
session_start();
if(!isset($_SESSION['EmployeeID']))
{
  header("location:../index.php");
}

$EmployeeID = $_SESSION['EmployeeID'];
$RoleID = $_SESSION['RoleID'];
?>
<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="../custom_assets/pic/logo.png" type="image/png">
  <link rel="shortcut icon" href="../custom_assets/pic/logo.png" type="image/png">
  <title>APEX FUNDING</title>
  
  <!-- css -->
  <?php include '../partials/css.php'; ?>

  <!-- database connection -->
  <?php include '../database/connection.php'; ?>
  
</head>
<body>
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="theme-loader">    
      <div class="loader-p"></div>
    </div>
  </div>
  <input value="<?php echo $_SESSION['RoleID']; ?>" name="SESSION_RoleID" id="SESSION_RoleID" type="hidden">
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <div class="page-main-header">
      <div class="main-header-right row m-0"> 
        <div class="main-header-left">
          <div class="logo-wrapper"><a href="index.php"><img class="img-fluid" src="../custom_assets/pic/logo.png" alt=""></a></div>
          <div class="dark-logo-wrapper"><a href="index.php"><img class="img-fluid" src="../custom_assets/pic/logo.png" alt=""></a></div>
          <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle"></i></div>
        </div>

      
        <div class="nav-right col pull-right right-menu p-0">
          <ul class="nav-menus">
            <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
            <li ><i data-feather="activity"></i><b><i><a href="#"> Welcome to Apex Funding Corporation System</a></i></b></li>
            <li><i data-feather="user"></i><b><i><a href="edit-profile.php"> <?php echo $_SESSION['Name']; ?></a></i></b></li>
            <li class="onhover-dropdown p-0">
              <button class="btn btn-primary-light" type="button" id="logout_btn"><a href="#"><i data-feather="log-out"></i>Log out</a></button>
            </li>
          </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
      </div>
    </div>
    <!-- Page Header Ends                              -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper horizontal-menu">
      <!-- Page Sidebar Start-->
      <header class="main-nav">
       <div class="sidebar-user text-center"><img class="img-90 rounded-circle" src="../assets/images/dashboard/1.png" alt="">
        <div class="badge-bottom"><span class="badge badge-primary"></span></div><a href="user-profile.html">
          <h6 class="mt-3 f-14 f-w-600"><?php echo $_SESSION['Name']; ?></h6></a>
          <p class="mb-3 f-14 f-w-600"><?php echo $_SESSION['PositionName']; ?></p>
        </div>
        <nav>
          <div class="main-navbar">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="mainnav">           
                <?php include 'sidebar.php'; ?>
              </div>
          </div>
        </nav>
          </header>
          <!-- Page Sidebar Ends-->