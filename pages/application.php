<?php include '../layout/header.php'; ?>

          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Application</h3>
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

                    <div class="card"  id="tbl_application">
                      <div class="card-header pb-0">
                          <h5>Application Page</h5>
                      </div>
                    <div class="card-body">
                      <div class="row" style="margin-bottom: 10px;">
                          <div class="col-sm-12" style="text-align: right;">  
                          <button class="btn btn-primary" id="addApplication"><i class="fa fa-plus"></i> Search Application</button>
                          </div>
                      </div>
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link application-tab active" data-value="PND" id="pending-tabs" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">Pending</a></li>
                            <li class="nav-item"><a class="nav-link application-tab" data-value="FORDISB" id="fordisb-tabs" data-bs-toggle="tab" href="#fordisb" role="tab" aria-controls="fordisb" aria-selected="false">For Disbursement</a></li>
                            <li class="nav-item"><a class="nav-link application-tab" data-value="DISB" id="disb-tabs" data-bs-toggle="tab" href="#disb" role="tab" aria-controls="disb" aria-selected="false">Disbursed</a></li>
                            <li class="nav-item"><a class="nav-link application-tab" data-value="CNCL" id="cancel-tabs" data-bs-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false">Cancelled</a></li>
                            </ul>
                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="table-responsive">
                                    <table class="display" id="basic-1">
                                        <thead>
                                        <tr>
                                            <th>Client ID</th>
                                            <th>Application No</th>
                                            <th>Client Name</th>
                                            <th>Branch</th>
                                            <th>Loan Amount</th>
                                            <th>DisbursementDate</th>
                                            <th>LoanType</th>
                                            <th>ClosedDate</th>
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

                    
                <!-- EDIT LOAN APPLICATION FORM -->
                <div class="card"  id="edit_application" style="display:none">
                    <div class="card-header pb-0">
                        <h5>Client Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="a_clientID">Client ID </label>
                                    <input class="form-control" id="a_clientID" name="a_clientID" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="a_applicationNo">Application No </label>
                                    <input class="form-control" id="a_applicationNo" name="a_applicationNo" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="a_clientName">Client Name </label>
                                    <input class="form-control" id="a_clientName" name="a_clientName" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="a_branch">Branch Name </label>
                                    <input class="form-control" id="a_branch" name="a_branch" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>
                        
                    <form  class="needs-validation" novalidate="" id="application_form">
                        <!-- loan/ product  -->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                <label class="form-label" for="a_loan_product">Product <span style="color: red;">*</span></label>
                                <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="a_loan_product" name="a_loan_product" required="">
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
                                <label class="form-label" for="a_loan_rate">Rate <span style="color: red;">*</span></label>
                                <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="a_loan_rate" name="a_loan_rate" required="">
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
                                <label class="form-label" for="a_loan_term_type">Term Type<span style="color: red;">*</span></label>
                                <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="a_loan_term_type" name="a_loan_term_type" required="">
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
                                <div class="invalid-feedback">Please Select Term.</div>
                                </div>
                            </div>
                        </div>

                        <!-- disb date  -->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="a_loan_disbDate">Disbursement Date <span style="color: red;">*</span></label>
                                    <input class="form-control" id="a_loan_disbDate" name="a_loan_disbDate" type="date" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please input a Disbursement Date.</div>
                                </div>
                            </div>
                        </div>
                       

                        
                    </div>
                        <div class="card-footer text-end">
                         <!-- hidden value process name and sessionid primaryid ,roleid-->
                         <input value="editApplication" name="process" type="hidden">
                        <input id="pk_id" name="pk_id" type="hidden">
                        <input id="a_application_no" name="a_application_no" type="hidden">
                        <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                        <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <input class="btn btn-light" type="reset" id="back" value="Cancel">
                        </div>
                    </form>
                </div>
                <!-- END LOAN APPLICATION FORM -->

                <!-- View LOAN APPLICATION FORM -->
                <div class="card"  id="view_application" style="display:none">
                    <div class="card-header pb-0">
                        <h5>Application Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_applicationNo">Application No </label>
                                    <input class="form-control" id="v_applicationNo" name="v_applicationNo" type="text" readonly style="text-transform:uppercase">
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
                        
                        <!-- loan/ product  -->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_loan_product">Product </label>
                                    <input class="form-control" id="v_loan_product" name="v_loan_product" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>

                         <!-- Term  -->
                         <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_loan_term">Term </label>
                                    <input class="form-control" id="v_loan_term" name="v_loan_term" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>

                        <!-- disb date  -->
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="v_loan_disbDate">Disbursement Date </label>
                                    <input class="form-control" id="v_loan_disbDate" name="v_loan_disbDate" type="text" readonly style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">ID Photo</label>
                                    <?php include 'components/image-viewer.php'; ?>
                                </div>
                            </div>
                        </div>

                    <form  class="needs-validation" novalidate="" id="process_application_form">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                <label class="form-label" for="v_loan_status">Application Status<span style="color: red;">*</span></label>
                                <select class="form-control col-sm-12 js-example-basic-single" style="width: 100%;" id="v_loan_status" name="v_loan_status" required="">
                                    <option value="">Select Status...</option>
                                        <?php
                                                $result_type = mysqli_query($con,"SELECT * FROM t_status WHERE StatusID IN ('APR','REJ','CNCL') AND isActive = 0");
                                                
                                                while($row_type = mysqli_fetch_array($result_type)) {
                                        ?>
                                        <option value="<?php echo $row_type["StatusID"]; ?>"><?php echo $row_type["StatusName"]; ?></option>
                                        <?php
                                        
                                        }
                                        ?>
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please Select Status.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="remarks">Remarks</label>
                                    <textarea class="form-control" id="remarks" name="remarks" rows="3" required=""></textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Select Status.</div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                        <div class="card-footer text-end">
                         <!-- hidden value process name and sessionid primaryid ,roleid-->
                         <input value="processApplication" name="process" type="hidden">
                        <input id="v_pk_id" name="v_pk_id" type="hidden">
                        <input id="v_clientID" name="v_clientID" type="hidden">
                        <input id="v_application_no" name="v_application_no" type="hidden">
                        <input value="<?php echo $_SESSION['EmployeeID']; ?>" name="EmployeeID" type="hidden">
                        <input value="<?php echo $_SESSION['RoleID']; ?>" name="RoleID" type="hidden">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <input class="btn btn-light" type="reset" id="cancel_process" value="Cancel">
                        </div>
                    </form>
                </div>
                <!-- END View APPLICATION FORM -->

                </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>

<script src="js/application-js.js"></script>

<?php include '../layout/footer.php'; ?>