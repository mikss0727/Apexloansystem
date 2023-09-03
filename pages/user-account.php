
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
                                  <?php
                                      
                                      $result = mysqli_query($con,"SELECT 
                                                                      t1.id,
                                                                      t1.EmployeeID,
                                                                      CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'EmployeeName',
                                                                      t1.RoleID,
                                                                      t1.BranchID,
                                                                      t5.BranchName,
                                                                      t1.CreatedAt,
                                                                      CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'CreatedBy',
                                                                      t1.isActive,
                                                                      t1.UpdatedAt,
                                                                      CONCAT(t4.LastName,', ',t4.FirstName,' ',t4.MiddleName) AS 'UpdatedBy'
                                                                  FROM t_user_account t1 
                                                                  LEFT JOIN t_employee t2
                                                                  ON t1.EmployeeID = t2.EmployeeID 
                                                                  LEFT JOIN t_employee t3
                                                                  ON t1.CreatedBy = t3.EmployeeID
                                                                  LEFT JOIN t_employee t4
                                                                  ON t1.UpdatedBy = t4.EmployeeID
                                                                  LEFT JOIN t_branch t5
                                                                  ON t1.BranchID = t5.BranchID");

                                      

                                          while($row = mysqli_fetch_array($result)) {
                                      ?>
                                      <tr>
                                          <td> <?php echo $row["EmployeeID"]; ?></td>
                                          <td> <?php echo $row["EmployeeName"]; ?></td>
                                          <td> <?php echo $row["BranchID"].' - '.$row["BranchName"]; ?></td>
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
                                              <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="editUserAccount" data-toggle="modal"
                                                  data-pk_id="<?php echo $row["id"]; ?>"
                                                  data-user_id="<?php echo $row["EmployeeID"]; ?>"
                                                  data-branch_id="<?php echo $row["BranchID"]; ?>"
                                                  data-role_id="<?php echo $row["RoleID"]; ?>"
                                                  data-isactive="<?php echo $row["isActive"]; ?>">
                                                  <i class="fa fa-edit" data-toggle="tooltip" 
                                                  title="Edit"></i>
                                              </a>
                                              <a href="#" class="btn btn-pill btn-outline-warning btn-xs" id="resetPassword"
                                              data-pk_id="<?php echo $row["id"]; ?>"
                                              data-user_id="<?php echo $row["EmployeeID"]; ?>">
                                                  <i class="fa fa-rotate-right" data-toggle="tooltip" 
                                                  title="Reset Password"></i>
                                              </a>
                                              <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteUserAccount"
                                              data-pk_id="<?php echo $row["id"]; ?>"
                                              data-user_id="<?php echo $row["EmployeeID"]; ?>">
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