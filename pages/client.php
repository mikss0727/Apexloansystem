<?php include '../layout/header.php'; ?>

          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Client</h3>
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

                    <div class="card"  id="tbl_client">
                      <div class="card-header pb-0">
                          <h5>Client Page</h5>
                      </div>
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-12" style="text-align: right;">  
                          <button class="btn btn-primary" id="addClient"><i class="fa fa-plus"></i> Add New Client</button>
                          </div>
                      </div>
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link client-tab active" data-value="ACTV" id="active-tabs" data-bs-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active Client</a></li>
                            <li class="nav-item"><a class="nav-link client-tab" data-value="IACTV" id="inactive-tabs" data-bs-toggle="tab" href="#inactive" role="tab" aria-controls="inactive" aria-selected="false">InActive Client</a></li>
                            </ul>
                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="table-responsive">
                                    <table class="display" id="basic-1">
                                        <thead>
                                        <tr>
                                            <th>Client ID</th>
                                            <th>Client Name</th>
                                            <th>Branch</th>
                                            <th>Status</th>
                                            <th>Created On</th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                          
                      </div>
                    </div>


                    <!-- ADD FORM -->
                    <div class="card"  id="add_client" style="display:none">
                      <div class="card-header pb-0">
                          <h5>Add New Client</h5>
                      </div>
                      <form class="needs-validation" id="addClient_form" novalidate="" action="sql/client-sql-query.php" method="post" enctype="multipart/form-data">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_lname">Last Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_lname" name="add_lname" type="text" required="" style="text-transform:uppercase">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Last Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_fname">First Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_fname" name="add_fname" type="text" required="" style="text-transform:uppercase">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a First Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_mname">Middle Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_mname" name="add_mname" type="text" required="" style="text-transform:uppercase">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Middle Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_bday">Date of Birth <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_bday" name="add_bday" type="date" required="" max="<?php echo date('Y-m-d'); ?>">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Birthday.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_age">Age <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_age" name="add_age" type="text" readonly>
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Age.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_contactno">Contact Number <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_contactno" name="add_contactno" type="text" required="" oninput="validateContactNo(this)">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Contact Number.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_address">Address </label>
                                          <input class="form-control" id="add_address" name="add_address" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Address.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_email">Email Address </label>
                                          <input class="form-control" id="add_email" name="add_email" type="email">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Email Address.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3">
                                    <label class="form-label" for="add_branchid">Branch</label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="add_branchid" name="add_branchid" required="">
                                      <option value="">Select Branch...</option>
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_branch WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["BranchID"]; ?>"><?php echo $row_type["BranchName"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Branch.</div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_bussName">Business Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_bussName" name="add_bussName" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Business Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_bussAdd">Business Address <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_bussAdd" name="add_bussAdd" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Business Address.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="add_gender">Gender <span style="color: red;">*</span></label>
                                        <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="add_gender" name="add_gender" required="">
                                        <option value="">Select Gender...</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Gender.</div>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3">
                                    <label class="form-label" for="add_maritalStatus">Marital Status <span style="color: red;">*</span></label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="add_maritalStatus" name="add_maritalStatus" required="">
                                      <option value="">Select Marital Status...</option>
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_marital_status WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["MaritalID"]; ?>"><?php echo $row_type["MaritalName"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Marital Status.</div>
                                  </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="id_Front">ID Front <span style="color: red;">*</span></label>
                                            <input class="form-control col-sm-12" id="id_Front" type="file" accept="image/*" name="ID_FRONT" onchange="validateImage('id_Front')" />
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please Select Image.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="id_Back">ID Back <span style="color: red;">*</span></label>
                                            <input class="form-control col-sm-12" id="id_Back" type="file" accept="image/*" name="ID_BACK" onchange="validateImage('id_Back')" />
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please Select Image.</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                          </div>
                          <div class="card-footer text-end">
                          <!-- hidden value process name and sessionid, roleid -->
                          <input value="addClient" name="process" type="hidden">
                          <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                          <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">

                          <button class="btn btn-primary" type="submit">Submit</button>
                          <input class="btn btn-light" type="reset" id="cancel_add" value="Cancel">
                          </div>
                      </form>

                      </div>
                     <!-- END ADD FORM -->



                     <!-- EDIT FORM -->
                    <div class="card"  id="edit_client" style="display:none">
                        <div class="card-header pb-0">
                            <h5>Edit Client</h5>
                        </div>
                        <form  class="needs-validation" novalidate="" id="clientEdit_form" action="sql/client-sql-query.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_lname">Last Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_lname" name="edit_lname" type="text" required="" style="text-transform:uppercase">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Last Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_fname">First Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_fname" name="edit_fname" type="text" required="" style="text-transform:uppercase">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a First Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_mname">Middle Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_mname" name="edit_mname" type="text" required="" style="text-transform:uppercase">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Middle Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_bday">Date of Birth <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_bday" name="edit_bday" type="date" required="" max="<?php echo date('Y-m-d'); ?>">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Birthday.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_age">Age <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_age" name="edit_age" type="text" readonly>
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Age.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_contactno">Contact Number <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_contactno" name="edit_contactno" type="text" required="" oninput="validateContactNo(this)">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Contact Number.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_address">Address <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_address" name="edit_address" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Address.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_email">Email Address </label>
                                          <input class="form-control" id="edit_email" name="edit_email" type="email">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Email Address.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3">
                                    <label class="form-label" for="edit_branchid">Branch</label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="edit_branchid" name="edit_branchid" required="">
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_branch WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["BranchID"]; ?>"><?php echo $row_type["BranchName"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Branch.</div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_bussName">Business Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_bussName" name="edit_bussName" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Business Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="edit_bussAdd">Business Address <span style="color: red;">*</span></label>
                                          <input class="form-control" id="edit_bussAdd" name="edit_bussAdd" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Business Address.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="edit_gender">Gender <span style="color: red;">*</span></label>
                                        <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="edit_gender" name="edit_gender" required="">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Gender.</div>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3">
                                    <label class="form-label" for="edit_maritalStatus">Marital Status <span style="color: red;">*</span></label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="edit_maritalStatus" name="edit_maritalStatus" required="">
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_marital_status WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["MaritalID"]; ?>"><?php echo $row_type["MaritalName"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Marital Status.</div>
                                  </div>
                                </div>
                              </div>

                               <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_id_Front">ID Front (Replace Existing)</label>
                                            <input class="form-control col-sm-12" id="edit_id_Front" type="file" accept="image/*" name="edit_ID_FRONT" />
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please Select Image.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_id_Back">ID Back (Replace Existing)</label>
                                            <input class="form-control col-sm-12" id="edit_id_Back" type="file" accept="image/*" name="edit_ID_BACK" />
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please Select Image.</div>
                                        </div>
                                    </div>
                                </div>
                              
                          </div>
                            <div class="card-footer text-end">
                                <!-- hidden value process name and sessionid primaryid ,roleid-->
                            <input value="editClient" name="process" type="hidden">
                            <input id="pk_id" name="pk_id" type="hidden">
                            <input id="client_id" name="client_id" type="hidden">
                            <input id="status_id" name="status_id" type="hidden">
                            <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                            <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <input class="btn btn-light" type="reset" id="cancel_edit" value="Cancel">
                            </div>
                        </form>
                    </div>
                    <!-- END EDIT FORM -->


                    <!-- view FORM -->
                    <div class="card"  id="view_client" style="display:none">
                    <div class="card-header pb-0">
                        <h5>Client Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_clientID">Client ID </label>
                                    <input class="form-control" id="v_clientID" name="v_clientID" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_clientName">Client Name </label>
                                    <input class="form-control" id="v_clientName" name="v_clientName" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_branch">Branch Name </label>
                                    <input class="form-control" id="v_branch" name="v_branch" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_bday">Date of Birth </label>
                                    <input class="form-control" id="v_bday" name="v_bday" type="date" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_age">Age </label>
                                    <input class="form-control" id="v_age" name="v_age" type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_contactno">Contact Number </label>
                                    <input class="form-control" id="v_contactno" name="v_contactno" type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_address">Address </label>
                                    <input class="form-control" id="v_address" name="v_address" type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_email">Email Address </label>
                                    <input class="form-control" id="v_email" name="v_email" type="email" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_bussName">Business Name </label>
                                    <input class="form-control" id="v_bussName" name="v_bussName" type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_bussAdd">Business Address </label>
                                    <input class="form-control" id="v_bussAdd" name="v_bussAdd" type="text" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_gender">Gender</label>
                                    <input class="form-control" id="v_gender" name="v_gender" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="v_maritalStatus">Marital Status</label>
                                <input class="form-control" id="v_maritalStatus" name="v_maritalStatus" readonly>
                            </div>
                            </div>
                        </div>
                       

                        
                    </div>
                        <div class="card-footer text-end">
                        <input class="btn btn-light" type="reset" id="back" value="Back">
                        </div>
                </div>
                <!-- END View FORM -->


                <!-- APPLY LOAN FORM -->
                <div class="card"  id="apply_loan" style="display:none">
                    <div class="card-header pb-0">
                        <h5>Client Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="l_clientID">Client ID </label>
                                    <input class="form-control" id="l_clientID" name="l_clientID" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="l_clientName">Client Name </label>
                                    <input class="form-control" id="l_clientName" name="l_clientName" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="l_branch">Branch Name </label>
                                    <input class="form-control" id="l_branch" name="l_branch" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        
                    <form  class="needs-validation" novalidate="" id="applyLoan_form">
                        <!-- loan/ product  -->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                <label class="form-label" for="l_loan_product">Product <span style="color: red;">*</span></label>
                                <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="l_loan_product" name="l_loan_product" required="">
                                    <option value="">Select Product...</option>
                                        <?php
                                                $result_type = mysqli_query($con,"SELECT * FROM t_product WHERE isActive = 0");
                                                
                                                while($row_type = mysqli_fetch_array($result_type)) {
                                        ?>
                                        <option value="<?php echo $row_type["ProductID"]; ?>"><?php echo $row_type["ProductName"].' - '.$row_type["LoanAmount"]; ?>.00</option>
                                        <?php
                                        
                                        }
                                        ?>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please Select Product.</div>
                                </div>
                            </div>
                        </div>

                        <!-- interest rate  -->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                <label class="form-label" for="l_loan_rate">Rate <span style="color: red;">*</span></label>
                                <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="l_loan_rate" name="l_loan_rate" required="">
                                    <option value="">Select Rate...</option>
                                        <?php
                                                $result_type = mysqli_query($con,"SELECT * FROM t_interest_rate WHERE isActive = 0");
                                                
                                                while($row_type = mysqli_fetch_array($result_type)) {
                                        ?>
                                        <option value="<?php echo $row_type["RateID"]; ?>"><?php echo $row_type["Rate"]; ?></option>
                                        <?php
                                        
                                        }
                                        ?>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please Select Rate.</div>
                                </div>
                            </div>
                        </div>

                         <!-- Term  -->
                         <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                <label class="form-label" for="l_loan_term_type">Term Type <span style="color: red;">*</span></label>
                                <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="l_loan_ Type_type" name="l_loan_term_type" required="">
                                    <option value="">Select Term Type...</option>
                                        <?php
                                                $result_type = mysqli_query($con,"SELECT * FROM t_term_type WHERE isActive = 0");
                                                
                                                while($row_type = mysqli_fetch_array($result_type)) {
                                        ?>
                                        <option value="<?php echo $row_type["TypeID"]; ?>"><?php echo $row_type["TypeName"].' Collection'; ?></option>
                                        <?php
                                        
                                        }
                                        ?>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please Select Term Type.</div>
                                </div>
                            </div>
                        </div>

                        <!-- disb date  -->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="l_loan_disbDate">Disbursement Date <span style="color: red;">*</span></label>
                                    <input class="form-control" id="l_loan_disbDate" name="l_loan_disbDate" type="date" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please input a Disbursement Date.</div>
                                </div>
                            </div>
                        </div>
                       

                        
                    </div>
                        <div class="card-footer text-end">
                         <!-- hidden value process name and sessionid primaryid ,roleid-->
                         <input value="processApplyLoan" name="process" type="hidden">
                        <input id="l_pk_id" name="l_pk_id" type="hidden">
                        <input id="l_client_id" name="l_client_id" type="hidden">
                        <input id="l_branch_id" name="l_branch_id" type="hidden">
                        <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                        <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <input class="btn btn-light" type="reset" id="back_apply_form" value="Back">
                        </div>
                    </form>
                </div>
                <!-- END APPLY LOAN FORM -->

                <!--start image modal -->
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php include 'components/image-viewer.php'; ?>
                            </div>
                            <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end image modal -->

                </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>

<script src="js/client-js.js"></script>

<?php include '../layout/footer.php'; ?>