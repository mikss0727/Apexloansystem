
<?php include '../layout/header.php'; ?>

          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Account</h3>
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

                    <div class="card"  id="tbl_user">
                      <div class="card-header pb-0">
                          <h5>User Account Module</h5>
                      </div>
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-12" style="text-align: right;">  
                          <button class="btn btn-primary" id="addUser"><i class="fa fa-plus"></i> Add User</button>     

                          </div>
                      </div>
                          <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Branch</th>
                                    <th>Created By</th>
                                    <th>Created On</th>
                                    <th>Updated By</th>
                                    <th>Updated On</th>
                                    <th>Status</th>
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
                     <div class="card"  id="add_user" style="display:none">
                      <div class="card-header pb-0">
                          <h5>Add New User Account</h5>
                      </div>
                      <form class="needs-validation" id="addUser_form" novalidate="">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                      <label class="form-label" for="add_EmpID">Employee Name <span style="color: red;">*</span></label>
                                        <select class="form-control js-example-basic-single col-sm-12" style="width: 100%;" id="add_EmpID" name="add_EmpID" required="">
                                            <option value="">Select Name...</option>
                                                <?php
                                                        $result_type = mysqli_query($con,"SELECT * FROM t_employee WHERE isActive = 0");
                                                        
                                                        while($row_type = mysqli_fetch_array($result_type)) {
                                                ?>
                                                <option value="<?php echo $row_type["EmployeeID"]; ?>"><?php echo $row_type["LastName"].', '.$row_type["FirstName"].' '.$row_type["MiddleName"]; ?></option>
                                                <?php
                                                
                                                }
                                                ?>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Employee Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                      <label class="form-label" for="add_Branch">Branch Name <span style="color: red;">*</span></label>
                                        <select class="form-control js-example-basic-single col-sm-12" style="width: 100%;" id="add_Branch" name="add_Branch" required="">
                                            <option value="">Select Branch...</option>
                                                <?php
                                                        $result_type = mysqli_query($con,"SELECT * FROM t_branch WHERE isActive = 0");
                                                        
                                                        while($row_type = mysqli_fetch_array($result_type)) {
                                                ?>
                                                <option value="<?php echo $row_type["BranchID"]; ?>"><?php echo $row_type["BranchID"].' - '.$row_type["BranchName"]; ?></option>
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
                                      <label class="form-label" for="add_Role">Role Name <span style="color: red;">*</span></label>
                                        <select class="form-control js-example-basic-single col-sm-12" style="width: 100%;" id="add_Role" name="add_Role" required="">
                                            <option value="">Select Role...</option>
                                                <?php
                                                        $result_type = mysqli_query($con,"SELECT * FROM t_user_roles WHERE isActive = 0");
                                                        
                                                        while($row_type = mysqli_fetch_array($result_type)) {
                                                ?>
                                                <option value="<?php echo $row_type["RoleID"]; ?>"><?php echo $row_type["RoleName"]; ?></option>
                                                <?php
                                                
                                                }
                                                ?>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Role.</div>
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
                          <input value="addUserAccount" name="process" type="hidden">
                          <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                          <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">

                          <button class="btn btn-primary" type="submit">Submit</button>
                          <input class="btn btn-light" type="reset" id="cancel_add" value="Cancel">
                          </div>
                      </form>
                      </div>
                     <!-- END ADD FORM -->


                    
                    <!-- EDIT FORM -->
                    <div class="card"  id="edit_user" style="display:none">
                        <div class="card-header pb-0">
                            <h5>Edit User Account</h5>
                        </div>
                        <form  class="needs-validation" novalidate="" id="userEdit_form">
                        <div class="card-body">
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                      <label class="form-label" for="edit_EmpID">Employee Name </label>
                                        <select class="form-control js-example-basic-single col-sm-12" style="width: 100%;" id="edit_EmpID" name="edit_EmpID" disabled="true">
                                                <?php
                                                        $result_type = mysqli_query($con,"SELECT * FROM t_employee WHERE isActive = 0");
                                                        
                                                        while($row_type = mysqli_fetch_array($result_type)) {
                                                ?>
                                                <option value="<?php echo $row_type["EmployeeID"]; ?>"><?php echo $row_type["LastName"].', '.$row_type["FirstName"].' '.$row_type["MiddleName"]; ?></option>
                                                <?php
                                                
                                                }
                                                ?>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Employee Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                      <label class="form-label" for="edit_Branch">Branch Name <span style="color: red;">*</span></label>
                                        <select class="form-control js-example-basic-single col-sm-12" style="width: 100%;" id="edit_Branch" name="edit_Branch" required="">
                                                <?php
                                                        $result_type = mysqli_query($con,"SELECT * FROM t_branch WHERE isActive = 0");
                                                        
                                                        while($row_type = mysqli_fetch_array($result_type)) {
                                                ?>
                                                <option value="<?php echo $row_type["BranchID"]; ?>"><?php echo $row_type["BranchID"].' - '.$row_type["BranchName"]; ?></option>
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
                                      <label class="form-label" for="edit_Role">Role Name <span style="color: red;">*</span></label>
                                        <select class="form-control js-example-basic-single col-sm-12" style="width: 100%;" id="edit_Role" name="edit_Role" required="">
                                                <?php
                                                        $result_type = mysqli_query($con,"SELECT * FROM t_user_roles WHERE isActive = 0");
                                                        
                                                        while($row_type = mysqli_fetch_array($result_type)) {
                                                ?>
                                                <option value="<?php echo $row_type["RoleID"]; ?>"><?php echo $row_type["RoleName"]; ?></option>
                                                <?php
                                                
                                                }
                                                ?>
                                        </select>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Select Role.</div>
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
                            <input value="editUserAccount" name="process" type="hidden">
                            <input id="pk_id" name="pk_id" type="hidden">
                            <input id="p_edit_EmpID" name="p_edit_EmpID" type="hidden">
                            <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                            <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <input class="btn btn-light" type="reset" id="cancel_edit" value="Cancel">
                            </div>
                        </form>
                    </div>
                    <!-- END EDIT FORM -->

                </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>

<script src="js/user-account-js.js"></script>

<?php include '../layout/footer.php'; ?>