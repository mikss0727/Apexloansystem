
<?php include '../layout/header.php'; ?>

          <div class="page-body">
            <div class="container-fluid">
              <div class="page-header">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>Loan Application</h3>
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

                  <div class="col-sm-12 col-xl-12">
                      <div class="card">
                        <div class="card-header pb-0">
                            <!-- <h5>Basic Tabs</h5> -->
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="pending-tabs" data-bs-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a></li>
                            <li class="nav-item"><a class="nav-link" id="approved-tabs" data-bs-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="false">Approved</a></li>
                            <li class="nav-item"><a class="nav-link" id="rejected-tabs" data-bs-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">Rejected</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                              <!-- PENDING TAB  -->
                            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tabs">
                                
                                
                            <div class="card"  id="tbl_branch_pnd">
                                <div class="card-header pb-0">
                                    <h5>PENDING</h5>
                                </div>
                                <div class="card-body">
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
                                                                    ON t1.MaritalStatus = t6.MaritalID
                                                                    WHERE t1.StatusID = 'PND'");

                                                

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
                                                <a href="#" class="btn btn-pill btn-outline-info btn-xs" id="viewClient"
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
                                                  data-status_id="<?php echo $row["StatusID"]; ?>"
                                                  data-status_name="<?php echo $row["StatusName"]; ?>">
                                                    <i class="fa fa-eye" title="view"></i>
                                                </a>
                                                
                                                <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="editClient"
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
                                                    <i class="fa fa-edit"
                                                    title="Edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteClient"
                                                data-pk_id="<?php echo $row["id"]; ?>"
                                                data-client_id="<?php echo $row["ClientID"]; ?>">
                                                    <i class="fa fa-trash-o"
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
                                

                            </div>
                            <!-- END PENDING TAB  -->

                            <!-- APPROVED TAB  -->
                            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tabs">
                                
                            <div class="card"  id="tbl_branch_apr">
                                <div class="card-header pb-0">
                                    <h5>APPROVED</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="display" id="basic-2">
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
                                                                    ON t1.MaritalStatus = t6.MaritalID
                                                                    WHERE t1.StatusID = 'APR'");

                                                

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
                                                <a href="#" class="btn btn-pill btn-outline-info btn-xs" id="viewClient"
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
                                                  data-status_id="<?php echo $row["StatusID"]; ?>"
                                                  data-status_name="<?php echo $row["StatusName"]; ?>">
                                                    <i class="fa fa-eye" title="view"></i>
                                                </a>
                                                
                                                <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="editClient"
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
                                                    <i class="fa fa-edit"
                                                    title="Edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteClient"
                                                data-pk_id="<?php echo $row["id"]; ?>"
                                                data-client_id="<?php echo $row["ClientID"]; ?>">
                                                    <i class="fa fa-trash-o"
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

                            </div>
                            <!-- END APPROVED TAB  -->

                            <!-- REJECTED TAB  -->
                            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tabs">
                                
                            <div class="card"  id="tbl_branch_rej">
                                <div class="card-header pb-0">
                                    <h5>REJECTED</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    <table class="display" id="basic-3">
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
                                                                    ON t1.MaritalStatus = t6.MaritalID
                                                                    WHERE t1.StatusID = 'REJ'");

                                                

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
                                                <a href="#" class="btn btn-pill btn-outline-info btn-xs" id="viewClient"
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
                                                  data-status_id="<?php echo $row["StatusID"]; ?>"
                                                  data-status_name="<?php echo $row["StatusName"]; ?>">
                                                    <i class="fa fa-eye" title="view"></i>
                                                </a>
                                                
                                                <a href="#" class="btn btn-pill btn-outline-primary btn-xs" id="editClient"
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
                                                    <i class="fa fa-edit"
                                                    title="Edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-pill btn-outline-danger btn-xs" id="deleteClient"
                                                data-pk_id="<?php echo $row["id"]; ?>"
                                                data-client_id="<?php echo $row["ClientID"]; ?>">
                                                    <i class="fa fa-trash-o"
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

                            </div>
                            <!-- END REJECTED TAB  -->
                            </div>
                        </div>
                      </div>
                  </div>





                </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>

<script src="js/branch-js.js"></script>

<?php include '../layout/footer.php'; ?>