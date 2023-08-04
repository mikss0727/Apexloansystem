<?php
session_start();
if(!isset($_SESSION['EmployeeID']))
{
  header("location:../index.php");
}

$EmployeeID = $_SESSION['EmployeeID'];
?>
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
  <title>OPELOTRACK</title>
  
  <!-- Font Awesome-->
  <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="../assets/css/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">

</head>
<body>
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="theme-loader">    
      <div class="loader-p"></div>
    </div>
  </div>
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
              <ul class="nav-menu custom-scrollbar">
                <li class="back-btn">
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li class="sidebar-main-title">
                  <div>
                    <h6>General             </h6>
                  </div>
                </li>
                <li class="dropdown"><a class="nav-link menu-title link-nav" href="index.php"><i data-feather="home"></i><span>Dashboard</span></a></li>
                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>Manage</span></a>
                  <ul class="nav-submenu menu-content">
                    <li><a href="position.php">Position</a></li>
                  </ul>
                </li>
                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="airplay"></i><span>Finance</span></a>
                  <ul class="nav-submenu menu-content">
                    <li><a href="capital.php">Capital</a></li>
                    <li><a href="expense.php">Expense</a></li>
                  </ul>
                </li>

                


              </div>
            </nav>
          </header>
          <!-- Page Sidebar Ends-->
          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Dashboard</h3>
                    <ol class="breadcrumb">
                      <!-- <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li> -->
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                <div class="col-sm-12">


                    <div class="card"  id="tbl_postition">
                    <div class="card-header pb-0">
                        <h5>Position</h5>
                    </div>
                    <div class="card-body">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-sm-12" style="text-align: right;">  
                        <button class="btn btn-primary" id="addPosition"><i class="fa fa-plus"></i> Add New Position</button>     

                        </div>
                    </div>
                        <div class="table-responsive">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>Position ID</th>
                                <th>Position Name</th>
                                <th>Created By</th>
                                <th>Created On</th>
                                <th>Updated By</th>
                                <th>Updated On</th>
                                <th>Status</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                include("../database/connection.php");
                                $result = mysqli_query($con,"SELECT 
                                                                t1.id,
                                                                t1.PositionID,
                                                                t1.PositionName,
                                                                t1.CreatedAt,
                                                                CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
                                                                t1.isActive,
                                                                t1.UpdatedAt,
                                                                CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
                                                            FROM t_position t1 
                                                            LEFT JOIN t_employee t2
                                                            ON t1.CreatedBy = t2.EmployeeID 
                                                            LEFT JOIN t_employee t3
                                                            ON t1.UpdatedBy = t3.EmployeeID");

                                

                                    while($row = mysqli_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td> <?php echo $row["PositionID"]; ?></td>
                                    <td> <?php echo $row["PositionName"]; ?></td>
                                    <td> <?php echo $row["CreatedBy"]; ?></td>
                                    <td><?php 
                                            if($row["CreatedAt"] == '' || $row["CreatedAt"] == null)
                                            {
                                                echo '';
                                            }
                                            else{
                                                $date_created=date_create($row["CreatedAt"]);
                                                echo date_format($date_created,"Y-m-d g:i a");
                                            }
                                    ?></td>
                                    <td> <?php echo $row["UpdatedBy"]; ?></td>
                                    <td><?php 
                                            if($row["UpdatedAt"] == '' || $row["UpdatedAt"] == null)
                                            {
                                                echo '';
                                            }
                                            else{
                                                $date_update=date_create($row["UpdatedAt"]);
                                                echo date_format($date_update,"Y-m-d g:i a");
                                            }
                                    ?></td>
                                    <td><?php if ($row["isActive"] == 0){ ?><span class="label label-success">Active</span> <?php }else { ?><span class="label label-info">Inactive</span>  <?php } ?></td>
                                    

                                    <td style="text-align: center;">
                                        <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="editPosition" data-toggle="modal"
                                            data-pk_id="<?php echo $row["id"]; ?>"
                                            data-pos_id="<?php echo $row["PositionID"]; ?>"
                                            data-pos_name="<?php echo $row["PositionName"]; ?>"
                                            data-isactive="<?php echo $row["isActive"]; ?>">
                                            <i class="fa fa-edit" data-toggle="tooltip" 
                                            title="Edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deletePosition"
                                        data-pk_id="<?php echo $row["id"]; ?>"
                                        data-pos_id="<?php echo $row["PositionID"]; ?>">
                                            <i class="fa fa-trash-o" data-toggle="tooltip" 
                                            title="Delete"></i>
                                        </a>

                                    </td>
                                </tr>
                                <?php
                                
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>




                     <!-- ADD FORM -->
                    <div class="card"  id="add_postition" style="display:none">
                    <div class="card-header pb-0">
                        <h5>Add New User Account</h5>
                    </div>
                    <form class="needs-validation" id="addPosition_form" novalidate="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="add_postitionID">Position ID <span style="color: red;">*</span></label>
                                        <input class="form-control" id="add_postitionID" name="add_postitionID" type="text" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input a Position ID.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="add_postitionName">Position Name <span style="color: red;">*</span></label>
                                        <input class="form-control" id="add_postitionName" name="add_postitionName" type="text" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input a Position Name.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="add_isActive">Status</label>
                                        <select class="form-control col-sm-12" style="width: 100%;" id="add_isActive" name="add_isActive" required="">
                                        <option value="">Select Status...</option>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Customer.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                        <!-- hidden value process name and sessionid -->
                        <input value="addPosition" name="process" type="hidden">
                        <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">

                        <button class="btn btn-primary" type="submit">Submit</button>
                        <input class="btn btn-light" type="reset" id="cancel_add" value="Cancel">
                        </div>
                    </form>
                    </div>



                    <!-- EDIT FORM -->
                    <div class="card"  id="edit_postition" style="display:none">
                        <div class="card-header pb-0">
                            <h5>Edit Position</h5>
                        </div>
                        <form  class="needs-validation" novalidate="" id="positionEdit_form">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_postitionID">Position ID</label>
                                    <input class="form-control" id="edit_postitionID" name="edit_postitionID" type="text" readonly>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_postitionName">Position Name</label>
                                    <input class="form-control" id="edit_postitionName" name="edit_postitionName" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please input a Email ID.</div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="edit_isActive">Status</label>
                                        <select class="form-control col-sm-12" style="width: 100%;" id="edit_isActive" name="edit_isActive" required="">
                                        <option value="">Select Status...</option>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Customer.</div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <!-- hidden value process name and sessionid primaryid -->
                            <input value="editPosition" name="process" type="hidden">
                            <input id="pk_id" name="pk_id" type="hidden">
                            <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <input class="btn btn-light" type="reset" id="cancel_edit" value="Cancel">
                            </div>
                        </form>
                    </div>







                </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>
          <!-- footer start-->
          <footer class="footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 footer-copyright">
                  <p class="mb-0">Copyright 2022 © Apex Funding Corporation All rights reserved.</p>
                </div>
                <div class="col-md-6">
                  <p class="pull-right mb-0">Hand crafted & made with <i class="fa fa-heart font-secondary"></i></p>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>
      <!-- latest jquery-->
      <script src="../assets/js/jquery-3.5.1.min.js"></script>
      <!-- feather icon js-->
      <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
      <!-- Sidebar jquery-->
      <script src="../assets/js/sidebar-menu.js"></script>
      <script src="../assets/js/config.js"></script>
      <!-- Bootstrap js-->
      <script src="../assets/js/bootstrap/popper.min.js"></script>
      <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
      <!-- Plugins JS start-->
      <script src="../assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
      <script src="../assets/js/datatable/datatables/datatable.custom.js"></script>
      <script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
      <script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
      <script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
      <script src="../assets/js/owlcarousel/owl.carousel.js"></script>
      <script src="../assets/js/general-widget.js"></script>
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="../assets/js/script.js"></script>
      <script src="../custom_assets/sweetalert2/sweetalert2.min.js"></script>    
      <script src="../assets/js/theme-customizer/customizer.js"></script>
      <script src="position/position_js.js"></script>

      <!-- login js-->
      <!-- Plugin used-->
    </body>
    </html>