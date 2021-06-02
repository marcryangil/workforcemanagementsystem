<?php
session_start();
//error_reporting(0);
include('config.php');
date_default_timezone_set('Asia/Manila');





?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Workforce Management System</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed" style="background-color: #F5F5F5">
        <?php include('topbar.php');?>
        <div id="layoutSidenav">
            <?php include('sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                     
                      <div> </div>
                    <div class="container-fluid">
                        <h1></h1>
                        <h1 class="mt-3" style="font-size: 30px;color: #621299; margin-bottom: 0">Workforce Team</h1>
                        <style>
                            hr.solid {
                              border-top: 2px solid #B3B3B3;
                              margin-top: 0;
                            }
                        </style>
                        <hr class="solid">
                        
                        
										<form action="" method="post">
											<?php $sql="SELECT * FROM account WHERE issupervisor = 1 AND status = 'Active'";
													$query0 = $dbh->prepare($sql);
													$query0->execute();
													$results0=$query0->fetchAll(PDO::FETCH_OBJ);
													$cnt0=1;
													if($query0->rowCount() > 0)
													{
													foreach($results0 as $result0)
														{   ?>
														<br>
														<table id="example3" class="display table table-striped" cellspacing="0" width="100%" border="3" cellspacing="0" cellpadding="4" style="font-size:12px">
															<thead>
																<tr>
																<ol class="breadcrumb mb-1">
																	<h7><b>TL - <?php echo htmlentities($result0->fname);?> <?php echo htmlentities($result0->lname);?></b></h7>
										                        </ol>
										                    	</tr>
																                                                          
																	<tr>
																	<th>ID Number</th>
																	<th>First Name</th>
																	<th>Last Name</th>
																</tr>
															</thead>
															<tbody>
																<?php 
																$supervisorid =  htmlentities($result0->idnumber);

																$sql="SELECT * FROM account WHERE supervisorid = $supervisorid";
																$query = $dbh->prepare($sql);
																$query->execute();
																$results=$query->fetchAll(PDO::FETCH_OBJ);
																$cnt=1;
																if($query->rowCount() > 0)
																{
																foreach($results as $result)
																	{   ?>
																	<tr>
																	<td><?php echo htmlentities($result->idnumber);?></td>
																	<td><?php echo htmlentities($result->fname);?></td>
																	<td><?php echo htmlentities($result->lname);?></td>
																	
																	</tr>
																	<?php $cnt=$cnt+1;
																	}
																} ?>
													                                                       
															</tbody>
														</table>
														<?php $cnt0=$cnt0+1;
														}
													} ?>
											
										</form>
                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        
                                    
                                    <!-- /.col-md-6 -->

                                                               
                                                
                                                <!-- /.col-md-12 -->
                                            
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Workforce Management System 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        
		
    </body>
</html>
