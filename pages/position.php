
<?php include '../layout/header.php'; ?>

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


                    <div class="card"  id="tbl_position">
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
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>




                     <!-- ADD FORM -->
                    <div class="card"  id="add_position" style="display:none">
                    <div class="card-header pb-0">
                        <h5>Add New User Account</h5>
                    </div>
                    <form class="needs-validation" id="addPosition_form" novalidate="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="add_positionID">Position ID <span style="color: red;">*</span></label>
                                        <input class="form-control" id="add_positionID" name="add_positionID" type="text" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input a Position ID.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="add_positionName">Position Name <span style="color: red;">*</span></label>
                                        <input class="form-control" id="add_positionName" name="add_positionName" type="text" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input a Position Name.</div>
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
                        <!-- hidden value process name and sessionid, roleid-->
                        <input value="addPosition" name="process" type="hidden">
                        <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                        <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <input class="btn btn-light" type="reset" id="cancel_add" value="Cancel">
                        </div>
                    </form>
                    </div>



                    <!-- EDIT FORM -->
                    <div class="card"  id="edit_position" style="display:none">
                        <div class="card-header pb-0">
                            <h5>Edit Position</h5>
                        </div>
                        <form  class="needs-validation" novalidate="" id="positionEdit_form">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_positionName">Position Name</label>
                                    <input class="form-control" id="edit_positionName" name="edit_positionName" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please input a Position Name.</div>
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
                                <!-- hidden value process name and sessionid primaryid -->
                            <input value="editPosition" name="process" type="hidden">
                            <input id="pk_id" name="pk_id" type="hidden">
                            <input id="pos_id" name="pos_id" type="hidden">
                            <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                            <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">
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

<script src="js/position-js.js"></script>

<?php include '../layout/footer.php'; ?>