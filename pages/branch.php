
<?php include '../layout/header.php'; ?>

          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Branch</h3>
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

                    <div class="card"  id="tbl_branch">
                      <div class="card-header pb-0">
                          <h5>Branch Module</h5>
                      </div>
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-12" style="text-align: right;">  
                          <button class="btn btn-primary" id="addBranch"><i class="fa fa-plus"></i> Add Branch</button>     

                          </div>
                      </div>
                          <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Branch ID</th>
                                    <th>Branch Name</th>
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
                                                                      t1.BranchID,
                                                                      t1.BranchName,
                                                                      t1.CreatedAt,
                                                                      CONCAT(t2.LastName,', ',t2.FirstName,' ',t2.MiddleName) AS 'CreatedBy',
                                                                      t1.isActive,
                                                                      t1.UpdatedAt,
                                                                      CONCAT(t3.LastName,', ',t3.FirstName,' ',t3.MiddleName) AS 'UpdatedBy'
                                                                  FROM t_branch t1 
                                                                  LEFT JOIN t_employee t2
                                                                  ON t1.CreatedBy = t2.EmployeeID 
                                                                  LEFT JOIN t_employee t3
                                                                  ON t1.UpdatedBy = t3.EmployeeID");

                                      

                                          while($row = mysqli_fetch_array($result)) {
                                      ?>
                                      <tr>
                                          <td> <?php echo $row["BranchID"]; ?></td>
                                          <td> <?php echo $row["BranchName"]; ?></td>
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
                                              <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="editBranch" data-toggle="modal"
                                                  data-pk_id="<?php echo $row["id"]; ?>"
                                                  data-branch_id="<?php echo $row["BranchID"]; ?>"
                                                  data-pos_name="<?php echo $row["BranchName"]; ?>"
                                                  data-isactive="<?php echo $row["isActive"]; ?>">
                                                  <i class="fa fa-edit" data-toggle="tooltip" 
                                                  title="Edit"></i>
                                              </a>
                                              <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteBranch"
                                              data-pk_id="<?php echo $row["id"]; ?>"
                                              data-branch_id="<?php echo $row["BranchID"]; ?>">
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
                     <div class="card"  id="add_branch" style="display:none">
                      <div class="card-header pb-0">
                          <h5>Add New Branch</h5>
                      </div>
                      <form class="needs-validation" id="addBranch_form" novalidate="">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_branchID">Branch ID <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_branchID" name="add_branchID" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Branch ID.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_branchName">Branch Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_branchName" name="add_branchName" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Branch Name.</div>
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
                                          <div class="invalid-feedback">Please Select Status.</div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="card-footer text-end">
                          <!-- hidden value process name and sessionid, roleid -->
                          <input value="addBranch" name="process" type="hidden">
                          <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                          <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">

                          <button class="btn btn-primary" type="submit">Submit</button>
                          <input class="btn btn-light" type="reset" id="cancel_add" value="Cancel">
                          </div>
                      </form>
                      </div>
                     <!-- END ADD FORM -->


                    
                    <!-- EDIT FORM -->
                    <div class="card"  id="edit_branch" style="display:none">
                        <div class="card-header pb-0">
                            <h5>Edit Branch</h5>
                        </div>
                        <form  class="needs-validation" novalidate="" id="branchEdit_form">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_branchID">Branch ID</label>
                                    <input class="form-control" id="edit_branchID" name="edit_branchID" type="text" readonly>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_branchName">Branch Name</label>
                                    <input class="form-control" id="edit_branchName" name="edit_branchName" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please input a Branch Name.</div>
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
                                        <div class="invalid-feedback">Please Select Status.</div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="card-footer text-end">
                                <!-- hidden value process name and sessionid primaryid ,roleid-->
                            <input value="editBranch" name="process" type="hidden">
                            <input id="pk_id" name="pk_id" type="hidden">
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

<script src="js/branch-js.js"></script>

<?php include '../layout/footer.php'; ?>