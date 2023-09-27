
<?php include '../layout/header.php'; ?>

          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Employee</h3>
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

                    <div class="card"  id="tbl_employee">
                      <div class="card-header pb-0">
                          <h5>Employee Page</h5>
                      </div>
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-12" style="text-align: right;">  
                          <button class="btn btn-primary" id="addEmployee"><i class="fa fa-plus"></i> Add New Employee</button>
                          </div>
                      </div>
                        <div class="table-responsive">
                                <table class="display" id="basic-1">
                                    <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>ContactNo</th>
                                        <th>Email</th>
                                        <th>Birthday</th>
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


                    <!-- ADD FORM -->
                    <div class="card"  id="add_employee" style="display:none">
                      <div class="card-header pb-0">
                          <h5>Add New Employee</h5>
                      </div>
                      <form class="needs-validation" id="addEmployee_form" novalidate="">
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
                                    <label class="form-label" for="add_deptID">Department</label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="add_deptID" name="add_deptID" required="">
                                      <option value="">Select Department...</option>
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_department WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["DeptID"]; ?>"><?php echo $row_type["DeptName"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Department.</div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3">
                                    <label class="form-label" for="add_posID">Position</label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="add_posID" name="add_posID" required="">
                                      <option value="">Select Position...</option>
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_position WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["PositionID"]; ?>"><?php echo $row_type["PositionName"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Position.</div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_isActive">Status</label>
                                          <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="add_isActive" name="add_isActive" required="">
                                          <option value="">Select Status...</option>
                                          <option value="0">Active</option>
                                          <option value="1">Inactive</option>
                                          </select>
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please Select Status.</div>
                                      </div>
                                  </div>
                              </div>
                              
                          </div>
                          <div class="card-footer text-end">
                          <!-- hidden value process name and sessionid, roleid -->
                          <input value="addEmployee" name="process" type="hidden">
                          <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                          <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">

                          <button class="btn btn-primary" type="submit">Submit</button>
                          <input class="btn btn-light" type="reset" id="cancel_add" value="Cancel">
                          </div>
                      </form>
                      </div>
                     <!-- END ADD FORM -->



                     <!-- EDIT FORM -->
                    <div class="card"  id="edit_employee" style="display:none">
                        <div class="card-header pb-0">
                            <h5>Edit Employee</h5>
                        </div>
                        <form  class="needs-validation" novalidate="" id="employeeEdit_form">
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
                                    <label class="form-label" for="edit_deptID">Department</label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="edit_deptID" name="edit_deptID" required="">
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_department WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["DeptID"]; ?>"><?php echo $row_type["DeptName"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Department.</div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3">
                                    <label class="form-label" for="edit_posID">Position</label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="edit_posID" name="edit_posID" required="">
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_position WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["PositionID"]; ?>"><?php echo $row_type["PositionName"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Position.</div>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="edit_isActive">Status</label>
                                        <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="edit_isActive" name="edit_isActive" required="">
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Status.</div>
                                    </div>
                                </div>
                              </div>
                              
                          </div>
                            <div class="card-footer text-end">
                                <!-- hidden value process name and sessionid primaryid ,roleid-->
                            <input value="editEmployee" name="process" type="hidden">
                            <input id="pk_id" name="pk_id" type="hidden">
                            <input id="employee_id" name="employee_id" type="hidden">
                            <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                            <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <input class="btn btn-light" type="reset" id="cancel_edit" value="Cancel">
                            </div>
                        </form>
                    </div>
                    <!-- END EDIT FORM -->


                    <!-- view FORM -->
                    <div class="card"  id="view_employee" style="display:none">
                    <div class="card-header pb-0">
                        <h5>Client Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_employeeID">Employee ID </label>
                                    <input class="form-control" id="v_employeeID" name="v_employeeID" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_employeeName">Employee Name </label>
                                    <input class="form-control" id="v_employeeName" name="v_employeeName" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_dept">Department Name </label>
                                    <input class="form-control" id="v_dept" name="v_dept" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_pos">Position Name </label>
                                    <input class="form-control" id="v_pos" name="v_pos" type="text" readonly style="text-transform:uppercase">
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
                                    <label class="form-label" for="v_contactno">Contact Number </label>
                                    <input class="form-control" id="v_contactno" name="v_contactno" type="text" readonly>
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
                                <label class="form-label" for="v_status">Client Status</label>
                                <input class="form-control" id="v_status" name="v_status" readonly>
                            </div>
                            </div>
                        </div>
                    </div>
                        <div class="card-footer text-end">
                        <input class="btn btn-light" type="reset" id="back" value="Back">
                        </div>
                </div>
                <!-- END View FORM -->

                


                </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>

<script src="js/employee-js.js"></script>

<?php include '../layout/footer.php'; ?>