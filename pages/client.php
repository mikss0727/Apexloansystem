
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
                                    <?php
                                        
                                        $result = mysqli_query($con,"SELECT 
                                                                        t1.id,
                                                                        t1.ClientID,
                                                                        t1.LastName,
                                                                        t1.FirstName,
                                                                        t1.MiddleName,
                                                                        t1.BranchID,
                                                                        t4.BranchName,
                                                                        t1.Birthday,
                                                                        t1.ContactNo,
                                                                        t1.Address,
                                                                        t1.Email,
                                                                        t1.BusinessName,
                                                                        t1.BusinessAddress,
                                                                        t1.Gender,
                                                                        t1.MaritalStatus,
                                                                        t6.MaritalName,
                                                                        t1.Age,
                                                                        t1.StatusID,
                                                                        t5.StatusName,
                                                                        t1.CreatedAt,
                                                                        CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
                                                                        t1.UpdatedAt,
                                                                        CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
                                                                    FROM t_client t1 
                                                                    LEFT JOIN t_employee t2
                                                                    ON t1.CreatedBy = t2.EmployeeID 
                                                                    LEFT JOIN t_employee t3
                                                                    ON t1.UpdatedBy = t3.EmployeeID
                                                                    LEFT JOIN t_branch t4
                                                                    ON t1.BranchID = t4.BranchID
                                                                    LEFT JOIN t_status t5
                                                                    ON t1.StatusID = t5.StatusID
                                                                    LEFT JOIN t_marital_status t6
                                                                    ON t1.MaritalStatus = t6.MaritalID");

                                        

                                            while($row = mysqli_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td> <?php echo $row["ClientID"]; ?></td>
                                            <td> <?php echo $row["LastName"].', '.$row["FirstName"].' '.$row["MiddleName"]; ?></td>
                                            <td> <?php echo $row["BranchID"].' - '.$row["BranchName"]?></td>
                                            <td> <?php echo $row["StatusName"]?></td>
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

                                            <td style="text-align: center;">
                                                <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="viewClient" data-toggle="modal"
                                                  data-pk_id="<?php echo $row["id"]; ?>"
                                                  data-client_id="<?php echo $row["ClientID"]; ?>"
                                                  data-last_name="<?php echo $row["LastName"]; ?>"
                                                  data-first_name="<?php echo $row["FirstName"]; ?>"
                                                  data-middle_name="<?php echo $row["MiddleName"]; ?>"
                                                  data-branch_name="<?php echo $row["BranchName"]; ?>"
                                                  data-branch_id="<?php echo $row["BranchID"]; ?>"
                                                  data-birthday="<?php echo $row["Birthday"]; ?>"
                                                  data-contact_no="<?php echo $row["ContactNo"]; ?>"
                                                  data-address="<?php echo $row["Address"]; ?>"
                                                  data-email="<?php echo $row["Email"]; ?>"
                                                  data-business_name="<?php echo $row["BusinessName"]; ?>"
                                                  data-business_address="<?php echo $row["BusinessAddress"]; ?>"
                                                  data-gender="<?php echo $row["Gender"]; ?>"
                                                  data-marital_name="<?php echo $row["MaritalName"]; ?>"
                                                  data-age="<?php echo $row["Age"]; ?>"
                                                  data-status_name="<?php echo $row["StatusName"]; ?>">
                                                    <i class="fa fa-eye" data-toggle="tooltip" 
                                                    title="view"></i>
                                                </a>
                                                <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="editClient" data-toggle="modal"
                                                  data-pk_id="<?php echo $row["id"]; ?>"
                                                  data-client_id="<?php echo $row["ClientID"]; ?>"
                                                  data-last_name="<?php echo $row["LastName"]; ?>"
                                                  data-first_name="<?php echo $row["FirstName"]; ?>"
                                                  data-middle_name="<?php echo $row["MiddleName"]; ?>"
                                                  data-branch_id="<?php echo $row["BranchID"]; ?>"
                                                  data-birthday="<?php echo $row["Birthday"]; ?>"
                                                  data-contact_no="<?php echo $row["ContactNo"]; ?>"
                                                  data-address="<?php echo $row["Address"]; ?>"
                                                  data-email="<?php echo $row["Email"]; ?>"
                                                  data-business_name="<?php echo $row["BusinessName"]; ?>"
                                                  data-business_address="<?php echo $row["BusinessAddress"]; ?>"
                                                  data-gender="<?php echo $row["Gender"]; ?>"
                                                  data-marital_status="<?php echo $row["MaritalStatus"]; ?>"
                                                  data-age="<?php echo $row["Age"]; ?>"
                                                  data-status_id="<?php echo $row["StatusID"]; ?>">
                                                    <i class="fa fa-edit" data-toggle="tooltip" 
                                                    title="Edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteClient"
                                                data-pk_id="<?php echo $row["id"]; ?>"
                                                data-client_id="<?php echo $row["ClientID"]; ?>">
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
                    <div class="card"  id="add_client" style="display:none">
                      <div class="card-header pb-0">
                          <h5>Add New Client</h5>
                      </div>
                      <form class="needs-validation" id="addClient_form" novalidate="">
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
                                          <input class="form-control" id="add_contactno" name="add_contactno" type="text" required="" oninput="validateDecimalInput(this)">
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
                                        <select class="form-control col-sm-12" style="width: 100%;" id="add_gender" name="add_gender" required="">
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
                        <form  class="needs-validation" novalidate="" id="clientEdit_form">
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
                                          <input class="form-control" id="edit_contactno" name="edit_contactno" type="text" required="" oninput="validateDecimalInput(this)">
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
                                        <select class="form-control col-sm-12" style="width: 100%;" id="edit_gender" name="edit_gender" required="">
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
                                    <label class="form-label" for="edit_maritalStatus">Marital Status <span style="color: red;">*</span></label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="edit_maritalStatus" name="edit_maritalStatus" required="">
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
                        <div class="row">
                            <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="v_status">Client Status</label>
                                <input class="form-control" id="v_status" name="v_status" readonly>
                            </div>
                            </div>
                        </div>
                        
                    </div>
                        <div class="card-footer text-end">
                        <button class="btn btn-primary" id="back" type="submit">Back</button>
                        </div>
                </div>
                <!-- END View FORM -->

                


                </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>

<script src="js/client-js.js"></script>

<?php include '../layout/footer.php'; ?>