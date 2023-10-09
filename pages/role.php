
<?php include '../layout/header.php'; ?>

          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Accounts Role's</h3>
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

                    <div class="card"  id="tbl_role">
                      <div class="card-header pb-0">
                          <h5>Role's</h5>
                      </div>
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-12" style="text-align: right;">  
                          <button class="btn btn-primary" id="addRole"><i class="fa fa-plus"></i> Add Role</button>     

                          </div>
                      </div>
                          <div class="table-responsive">
                            <table class="display" id="basic-1">
                              <thead>
                              <tr>
                                  <th>Role ID</th>
                                  <th>Role Name</th>
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
                     <div class="card"  id="add_role" style="display:none">
                      <div class="card-header pb-0">
                          <h5>Add New Role</h5>
                      </div>
                      <form class="needs-validation" id="addRole_form" novalidate="">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_roleID">Role ID <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_roleID" name="add_roleID" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Role ID.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_roleName">Role Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_roleName" name="add_roleName" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Role Name.</div>
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
                          <input value="addRole" name="process" type="hidden">
                          <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                          <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">

                          <button class="btn btn-primary" type="submit">Submit</button>
                          <input class="btn btn-light" type="reset" id="cancel_add" value="Cancel">
                          </div>
                      </form>
                      </div>
                     <!-- END ADD FORM -->




                     
                    
                    <!-- EDIT FORM -->
                    <div class="card"  id="edit_role" style="display:none">
                        <div class="card-header pb-0">
                            <h5>Edit Role</h5>
                        </div>
                        <form  class="needs-validation" novalidate="" id="roleEdit_form">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_roleName">Role Name</label>
                                    <input class="form-control" id="edit_roleName" name="edit_roleName" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please input a Role Name.</div>
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
                            <input value="editRole" name="process" type="hidden">
                            <input id="pk_id" name="pk_id" type="hidden">
                            <input id="role_id" name="role_id" type="hidden">
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

<script src="js/role-js.js"></script>

<?php include '../layout/footer.php'; ?>