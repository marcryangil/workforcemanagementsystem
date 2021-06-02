<?php
session_start();
//error_reporting(0);
include('config.php');
date_default_timezone_set('Asia/Manila');
	

		if($_SESSION['vartype'] == 'supervisor')
        {
            echo '<script>window.location.href="index.php";alert("No Access!")</script>';
        }


    if(isset($_POST['btnstatus']))
    {
        $idnumber = $_POST['idnumber'];
        $savestatus = $_POST['savestatus'];
        $supervisorid = $_POST['savesupid'];

        //echo '<script>alert("'.$idnumber.'")</script>';

        if ($savestatus == "Activate") {
            $updatesql="UPDATE account SET status='Deactivated'  WHERE idnumber='$idnumber'";
            $updatequery = $dbh->prepare($updatesql);
            $updatequery->execute();

            $action = "Account Deactivated: \nID Number - ".$idnumber;
            include('addtolog.php');

            
            $sql="SELECT * FROM account WHERE supervisorid = '$idnumber' AND status = 'Active'";
            $query0 = $dbh->prepare($sql);
            $query0->execute();
            $results0=$query0->fetchAll(PDO::FETCH_OBJ);
            $cnt0=1;
            if($query0->rowCount() > 0)
            {
            foreach($results0 as $result0)
                {  
                    //echo '<script>alert("'.$result0->idnumber.'")</script>';
                    //$result0->status
                    $action = "New Supervisor: \nID Number - ".$result0->idnumber."\nSup. ID Number - ".$idnumber." -> ".$supervisorid;
                    include('addtolog.php');
                }
            }
            
            

        }
        else{
            $updatesql="UPDATE account SET status='Active'  WHERE idnumber='$idnumber'";
            $updatequery = $dbh->prepare($updatesql);
            $updatequery->execute();

            $action = "Account Activated: \nID Number - ".$idnumber;
            include('addtolog.php');
        }


        

        //echo '<script>alert("'.$supervisorid.'")</script>';

        $updatesql="UPDATE account SET supervisorid='$supervisorid'  WHERE supervisorid='$idnumber'";
        $updatequery = $dbh->prepare($updatesql);
        $updatequery->execute();

        


        //$query->execute();
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId)
        {
            $msg="Student info added successfully";
            header("Location:index.php");
        }
        else 
        {
            $msg="Something went wrong. Please try again";
        }

    }


	if(isset($_POST['savechanges']))
	{
	    $fname = $_POST['fname'];
	    $lname = $_POST['lname'];
	    $idnumber = $_POST['idnumber'];

	    

	    $saveid = $_POST['saveid'];

	    $updatesql="UPDATE account SET fname = '$fname', lname = '$lname', idnumber = '$idnumber' WHERE idnumber='$saveid'";
	    $updatequery = $dbh->prepare($updatesql);
	    $updatequery->execute();

	    $updatesql="UPDATE account SET supervisorid = '$idnumber' WHERE supervisorid='$saveid'";
	    $updatequery = $dbh->prepare($updatesql);
	    $updatequery->execute();

	    $action = "Updated supervisor information: \nID Number - ".$idnumber;
		include('addtolog.php');


	    //$query->execute();
	    $lastInsertId = $dbh->lastInsertId();

	    if($lastInsertId)
	    {
	        $msg="Student info added successfully";
	        header("Location:index.php");
	    }
	    else 
	    {
	        $msg="Something went wrong. Please try again";
	    }

	}

	if(isset($_POST['btnmakeemp']))
	{
		$fname = $_POST['fname'];
	    $lname = $_POST['lname'];
	    $idnumber = $_POST['idnumber'];
	    $accpass = intval(0);
	    $supervisorid = $_POST['savesupid'];

	    $saveid = $_POST['saveid'];

	    $updatesql="DELETE FROM account WHERE idnumber='$saveid'";
	    $updatequery = $dbh->prepare($updatesql);
	    $updatequery->execute();

        $sql="INSERT INTO account(idnumber,fname,lname,accpass,supervisorid) VALUES(:idnumber,:fname,:lname,:accpass,0)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':idnumber',$idnumber,PDO::PARAM_STR);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':lname',$lname,PDO::PARAM_STR);
        $query->bindParam(':accpass',$accpass,PDO::PARAM_STR);
        $query->execute();

        $action = "Demoted supervisor to employee: \nID Number - ".$idnumber;
		include('addtolog.php');

        $dayoftheweek = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
        
        foreach ($dayoftheweek as $day) {
            $sql="INSERT INTO productivity(idnumber,productivitylevel,dayoftheweek) VALUES(:idnumber,0,'$day')";
            $query = $dbh->prepare($sql);
            $query->bindParam(':idnumber',$idnumber,PDO::PARAM_STR);
            $query->execute();
        }




	    //$query->execute();
	    $lastInsertId = $dbh->lastInsertId();

	    if($lastInsertId)
	    {
	        $msg="Student info added successfully";
	        header("Location:index.php");
	    }
	    else 
	    {
	        $msg="Something went wrong. Please try again";
	    }

	}
	
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
                    <style>
                        .center {
                          margin: auto;
                          //width: 60%;
                        }
                    </style>
                    <style>
                                                .btn-primary {
                                                  color: #621299;
                                                  background-color: #d1f2ff;
                                                  border-color: #d1f2ff;
                                                }
                                                .btn-primary:hover {
                                                  color: #621299;
                                                  background-color: #d1f2ff;
                                                  border-color: #d1f2ff;
                                                }
                                                .btn-primary:focus, .btn-primary.focus {
                                                  color: #621299;
                                                  background-color: #d1f2ff;
                                                  border-color: #d1f2ff;
                                                  box-shadow: 0 0 0 0.2rem rgba(98,18,153, 0.5);
                                                }
                                                .btn-primary.disabled, .btn-primary:disabled {
                                                  color: #621299;
                                                  background-color: #d1f2ff;
                                                  border-color: #d1f2ff;
                                                }
                                                .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
                                                  color: #621299;
                                                  background-color: #d1f2ff;
                                                  border-color: #d1f2ff;
                                                }
                                                .btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .show > .btn-primary.dropdown-toggle:focus {
                                                  box-shadow: 0 0 0 0.2rem rgba(98,18,153, 0.5);
                                                }
                                            </style>



                    <div class="container-fluid">
                    <div class="container-flex">
                        
                        <h1 class="mt-3" style="font-size: 30px;color: #621299; margin-bottom: 0">Manage Supervisor Account</h1>
                        <style>
                            hr.solid {
                              border-top: 2px solid #B3B3B3;
                              margin-top: 0;
                            }
                        </style>
                        <hr class="solid">

										<?php
										if(isset($_POST['delete']))
										{
										// if(isset($_POST['studentid'])){
										foreach($_POST['idnumber']as $idnumber){

										//  echo $studentid;

										 $query="Delete from account where idnumber=:idnumber";
										 $query1 = $dbh->prepare($query);
										 $query1->bindValue('idnumber',$idnumber);
										 $query1->execute();
										 
										
								         $action = "Deleted supervisor account: \nID Number - ".$idnumber;
								         include('addtolog.php');

										}
										            
										//}

										}

										?>
                                        <div class="card mb-4">
                                        <div class="card-body" style="padding:10px">
                                            
                                            <div class="container-fluid " style="margin: auto; padding-left: 0; padding-right: 0">
                                                                <form action="" method="post">

                                                                    <table id="example3" class="center display table table-striped" cellspacing="0" width="100%" style="table-layout:fixed;">
                                                                        <thead>
                                                                            <tr>
                                                                                <td><input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to Delete!')" class="btn btn-danger"></td> 
                                                                            </tr>                                                                 
                                                                                <tr>
                                                                                <th style="text-align: left; font-size: 9px"><input type="checkbox" id="checkAll"><center>Select All</center></th>
                                                                                <th style="font-size: 9px">ID Number</th>
                                                                                <th style="font-size: 9px">Last Name</th>
                                                                                <th style="font-size: 9px">Status</th>
                                                                                <th style="font-size: 9px">Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php $sql="SELECT * FROM account WHERE issupervisor = 1 ORDER BY status ASC";
                                                                            $query = $dbh->prepare($sql);
                                                                            $query->execute();
                                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                                            $cnt=1;
                                                                            if($query->rowCount() > 0)
                                                                            {
                                                                            foreach($results as $result)
                                                                                {   ?>
                                                                                <tr>
                                                                                <td style="text-align:left"><input type="checkbox" class="checkItem" value="<?php echo $result->idnumber;?>" name="idnumber[]"></td>
                                                                                <td style="font-size: 10px"><?php echo htmlentities($result->idnumber);?></td>
                                                                                <td style="font-size: 10px"><?php echo htmlentities($result->lname);?></td>
                                                                                <?php 
                                                                                    $statusColor = "";
                                                                                if (htmlentities($result->status) == "Active") {
                                                                                    $statusColor = "green";
                                                                                }
                                                                                else{
                                                                                    $statusColor = "red";
                                                                                }
                                                                                ?>
                                                                                <td style="font-size: 10px; color: <?php echo $statusColor ?>"><?php echo htmlentities($result->status);?></td>
                                                                                <td>
                                                                                    
                                                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" 
                                                                                    onclick="editInfo(
                                                                                        '<?php echo htmlentities($result->fname);?>',
                                                                                        '<?php echo htmlentities($result->lname);?>',
                                                                                        '<?php echo htmlentities($result->idnumber);?>',
                                                                                        '<?php echo htmlentities($result->status);?>'
                                                                                        )">
                                                                                    Edit</button> 
                                                                                </td>
                                                                                </tr>
                                                                                <?php $cnt=$cnt+1;
                                                                                }
                                                                            } ?>
                                                                                                                    
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                            </div>

                                        </div>
                                        </div>
                                        
                                            
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <form method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Employee Information</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="fname" >First Name</label>
                                                        <input class="form-control py-4" name="fname" id="fname" type="input" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="lname" required>Last Name</label>
                                                        <input class="form-control py-4" id="lname" name="lname" type="input" />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="small mb-1" for="idnumber" required>ID Number</label>
                                                <input class="form-control py-4" name="idnumber" id="idnumber" type="input" placeholder="Enter ID Number" />

                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1 " for="btnmakeemp">Other</label>
                                                <button type="submit" id="btnmakeemp" name="btnmakeemp" class="btn btn-warning form-control">Demote to Employee</button>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" id="btnstatus0" name="btnstatus0" class="btn btn-warning form-control" onclick="openModal()">Activate</button>
                                                <input type="hidden" id="savestatus" name="savestatus" value="0"/>
                                            </div>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" id="saveid" name="saveid" value="0"/>
                                            <button type="button" class="btn btn-info mr-auto" onclick="location.href='gethistory.php'">History</button> 
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="savechanges" name="savechanges" class="btn btn-success">Save changes</button> 
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>


                                <div class="modal fade" id="changeSup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <form id="formfield" method="POST">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Deactivate Supervisor Account</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label class="small mb-1 " for="btnmakeemp">Choose the new supervisor for the team: </label>
                                                        <div class="dropdown">
                                                            
                                                            <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="SupervisorData" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value="Dropdown button"><label id="supmodal" >Choose </label></button>
                                                            <input type="hidden" id="supinput" name="supinput" value="0"/>
                                                                <div class="dropdown-menu">
                                                                    
                                                                        <?php 

                                                                        $sql="SELECT * FROM account WHERE issupervisor = 1 AND status = 'Active'";
                                                                        $query = $dbh->prepare($sql);
                                                                        $query->execute();
                                                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                                        $cnt=1;
                                                                        if($query->rowCount() > 0)
                                                                        {
                                                                        foreach($results as $result)
                                                                            {   ?>
                                                                            <option class="dropdown-item" id="bt" name="bt"  
                                                                                onclick="updateInfo('<?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->lname);?>',
                                                                                <?php echo htmlentities($result->idnumber);?>)">

                                                                                <?php echo htmlentities($result->fname);?>
                                                                                <?php echo htmlentities($result->lname);?>

                                                                            </option>
                                                                            <?php $cnt=$cnt+1;
                                                                            }
                                                                        } ?>
                                                                </div>
                                                    </div>
                                                    
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" id="savestatus2" name="savestatus" value="0"/>
                                                    <input type="hidden" id="idnumber2" name="idnumber" value="0"/>
                                                    <input type="hidden" id="savesupid" name="savesupid" value="0"/>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" id="btnstatus" name="btnstatus" class="btn btn-success">Save changes</button> 
                                                </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>



                    </div>
                    </div>
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
        <script>

            function openModal() {

                document.getElementById("idnumber2").value = document.getElementById("idnumber").value;
                document.getElementById("savestatus2").value = document.getElementById("savestatus").value;

                status2 = document.getElementById("savestatus2").value;

                if (status2 != "Deactivate") {
                    $('#changeSup').modal('show');
                }
                else{
                        $('#changeSup').modal('show');
                        document.getElementById("btnstatus").click();
                    
                }
            } 

            function updateInfo(variable,variable2) {
                let supmodalText = document.getElementById('supmodal');
                supmodalText.innerText = variable;       // TREATS EVERY CONTENT AS TEXT.
                document.getElementById("savesupid").value = variable2;
            }

            function editInfo(fname,lname,idnumber,status) {
                document.getElementById("fname").value = fname;
                document.getElementById("lname").value = lname;
                document.getElementById("idnumber").value = idnumber;
            

                document.getElementById("saveid").value = idnumber;
               
                document.cookie="empID="+idnumber;

                if (status == "Active") {
                    document.getElementById("btnstatus0").innerHTML = "Deactivate";
                    document.getElementById("savestatus").value = "Activate";
                }
                else{
                    document.getElementById("btnstatus0").innerHTML = "Activate";
                    document.getElementById("savestatus").value = "Deactivate";
                }
            } 
            
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "400px",
                     "scrollX":        "400px",
                    "scrollCollapse": true,
                    "paging":         true
                } );

                $('#example3').DataTable();
                $('#example4').DataTable();
            });
        </script>
        <script>
                    $(document).ready(function (){

                    $('#checkAll').click(function() {

                    if($(this).is(':checked')){

                    $('.checkItem').prop('checked',true);
                    }
                    else
                    {
                    $('.checkItem').prop('checked',false);   
                    }
                    });

                    });
        </script>
    </body>
</html>
