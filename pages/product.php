
<?php include '../layout/header.php'; ?>

          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Product</h3>
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

                    <div class="card"  id="tbl_product">
                      <div class="card-header pb-0">
                          <h5>Product</h5>
                      </div>
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-12" style="text-align: right;">  
                          <button class="btn btn-primary" id="addProduct"><i class="fa fa-plus"></i> Add New Product</button>     

                          </div>
                      </div>
                          <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Amount</th>
                                    <th>Collection No</th>
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
                    <div class="card"  id="add_product" style="display:none">
                      <div class="card-header pb-0">
                          <h5>Add New Product</h5>
                      </div>
                      <form class="needs-validation" id="addProduct_form" novalidate="">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_productID">Product ID <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_productID" name="add_productID" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Product ID.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_productName">Product Name <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_productName" name="add_productName" type="text" required="">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Product Name.</div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label" for="add_loanAmount">Amount <span style="color: red;">*</span></label>
                                          <input class="form-control" id="add_loanAmount" name="add_loanAmount" type="text" required="" oninput="validateDecimalInput(this)">
                                          <div class="valid-feedback">Looks good!</div>
                                          <div class="invalid-feedback">Please input a Amount.</div>
                                      </div>
                                  </div>
                              </div>
                            <!-- Product Term Number / collection number -->
                              <div class="row">
                                <div class="col">
                                  <div class="mb-3">
                                    <label class="form-label" for="add_term">Term Number / Collection No</label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="add_term" name="add_term" required="">
                                      <option value="">Select Term Number...</option>
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_product_term WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["TermID"]; ?>"><?php echo $row_type["TermName"]. ' - '. $row_type["TermNo"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Term.</div>
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
                          <input value="addProduct" name="process" type="hidden">
                          <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                          <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">

                          <button class="btn btn-primary" type="submit">Submit</button>
                          <input class="btn btn-light" type="reset" id="cancel_add" value="Cancel">
                          </div>
                      </form>
                      </div>
                     <!-- END ADD FORM -->


                      <!-- EDIT FORM -->
                    <div class="card"  id="edit_product" style="display:none">
                        <div class="card-header pb-0">
                            <h5>Edit Product</h5>
                        </div>
                        <form  class="needs-validation" novalidate="" id="productEdit_form">
                            <div class="card-body">
                            <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_productName">Product Name</label>
                                    <input class="form-control" id="edit_productName" name="edit_productName" type="text" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please input a Product Name.</div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="edit_loanAmount">Amount</label>
                                    <input class="form-control" id="edit_loanAmount" name="edit_loanAmount" type="text" required="" oninput="validateDecimalInput(this)">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please input a Amount.</div>
                                </div>
                                </div>
                            </div>
                             <!-- Product Term Number / collection number -->
                             <div class="row">
                                <div class="col">
                                  <div class="mb-3">
                                    <label class="form-label" for="edit_term">Term Number / Collection No</label>
                                    <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="edit_term" name="edit_term" required="">
                                          <?php
                                                  $result_type = mysqli_query($con,"SELECT * FROM t_product_term WHERE isActive = 0");
                                                  
                                                  while($row_type = mysqli_fetch_array($result_type)) {
                                          ?>
                                          <option value="<?php echo $row_type["TermID"]; ?>"><?php echo $row_type["TermName"]. ' - '. $row_type["TermNo"]; ?></option>
                                          <?php
                                          
                                          }
                                          ?>
                                    </select>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Term.</div>
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
                            <input value="editProduct" name="process" type="hidden">
                            <input id="pk_id" name="pk_id" type="hidden">
                            <input id="product_id" name="product_id" type="hidden">
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

<script src="js/product-js.js"></script>

<?php include '../layout/footer.php'; ?>