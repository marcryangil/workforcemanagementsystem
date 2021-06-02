<?php
session_start();
//error_reporting(0);
include('config.php');
date_default_timezone_set('Asia/Manila');
	



	if(isset($_POST['savechanges']))
	{
	    $productivitylevel = $_POST['prod'];
	    $saveid = $_POST['saveid'];
	    $saveday = $_POST['saveday'];
	    $saveyear = $_POST['saveyear'];
		$saveweek = $_POST['saveweek'];
		$savesupid = $_POST['savesupid'];

		//echo '<script>alert("'.$saveweek.'")</script>';

	    $updatesql="UPDATE productivity SET productivitylevel = '$productivitylevel' WHERE idnumber='$saveid' AND dayoftheweek='$saveday' 
	    			AND weeknumber='$saveweek' AND yearnumber='$saveyear'";
	    $updatequery = $dbh->prepare($updatesql);
	    $updatequery->execute();

	    $action = "Set productivity level: \nID Number - ".$saveid."\nSup. ID Number- ".$savesupid."\nProductivity Level - ".$productivitylevel;
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
		$test = '';
		if(isset($_POST['setweek']))
		{
			$thisweeknumber = date("W");
			$thisyearnumber = date("Y");

			$checksql = "SELECT * FROM productivity WHERE weeknumber = '$thisweeknumber' and yearnumber = '$thisyearnumber'";
			$checkquery = $dbh->prepare($checksql);
			$checkquery->execute();
			$checkresults=$checkquery->fetchAll(PDO::FETCH_OBJ);
			//echo '<script>alert("'.$checkquery->rowCount().'")</script>';
			if($checkquery->rowCount() > 0)
			{
				echo '<script>alert("Data already set for the week!")</script>'; 
			}
			else
			{
				$sqlset="SELECT * FROM account WHERE issupervisor = 0 AND status='Active'";
				$setquery = $dbh->prepare($sqlset);
				$setquery->execute();
				$setresults=$setquery->fetchAll(PDO::FETCH_OBJ);

				if($setquery->rowCount() > 0)
				{
					foreach($setresults as $setresult)
					{
						//$test = $test." ".htmlentities($setresult->idnumber);
						$allidnumber = htmlentities($setresult->idnumber);
						$thisweeknumber = date("W");
						$thisyearnumber = date("Y");
						$dayoftheweek = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
				        foreach ($dayoftheweek as $day) {
				            $sql="INSERT INTO productivity(idnumber,productivitylevel,dayoftheweek,weeknumber,yearnumber) 
				            		VALUES('$allidnumber',0,'$day','$thisweeknumber','$thisyearnumber')";
				            $query = $dbh->prepare($sql);
				            $query->execute();
				        }

					}
				}
				$action = "WEEK ".date("W")." HAS BEEN SET BY THE ADMIN";
				include('addtolog.php');
			}
			//echo '<script>alert("'.$test.'")</script>'; 
		}

		if(isset($_POST['resetweek']))
		{
			$thisweeknumber = date("W");
			$thisyearnumber = date("Y");

			$checksql = "SELECT * FROM productivity WHERE weeknumber = '$thisweeknumber' and yearnumber = '$thisyearnumber'";
			$checkquery = $dbh->prepare($checksql);
			$checkquery->execute();
			$checkresults=$checkquery->fetchAll(PDO::FETCH_OBJ);
			//echo '<script>alert("'.$checkquery->rowCount().'")</script>';
			if($checkquery->rowCount() > 0)
			{
				//echo '<script>alert("Data already set for the week!")</script>'; 
				$sqlset="DELETE FROM productivity WHERE weeknumber = '$thisweeknumber' and yearnumber = '$thisyearnumber'";
				$setquery = $dbh->prepare($sqlset);
				$setquery->execute();
				$action = "WEEK ".date("W")." HAS BEEN RESET BY THE ADMIN";
				include('addtolog.php');
			}
			else
			{
				echo '<script>alert("No data set for this week!")</script>'; 
			}
			//echo '<script>alert("'.$test.'")</script>'; 
		}

		$thisweeknumber = $_SESSION['thisweeknumber'];
		$thisyearnumber = $_SESSION['thisyearnumber'];
		

		if(isset($_POST['datepicker']))
		{
			$dateval = $_POST['datevalue'];
			if($dateval != null)
			{
				$dateyear = $dateval[0].$dateval[1].$dateval[2].$dateval[3];
				$dateweek = $dateval[6].$dateval[7];
				//echo '<script>alert("'.$dateval[0].'")</script>';

				$thisweeknumber = $dateweek;
				$thisyearnumber = $dateyear;

				$_SESSION['thisweeknumber'] = $dateweek;
				$_SESSION['thisyearnumber'] = $dateyear;
			}
			
		}



		$dayval=$_SESSION['currentdayval'];
		if (isset($_POST['All'])){
			$dayval= '';}
		if (isset($_POST['Sunday'])){
			$dayval= $_POST['Sunday'];}
		if (isset($_POST['Monday'])){
			$dayval= $_POST['Monday'];}
		if (isset($_POST['Tuesday'])){
			$dayval= $_POST['Tuesday'];}
		if (isset($_POST['Wednesday'])){
			$dayval= $_POST['Wednesday'];}
		if (isset($_POST['Thursday'])){
			$dayval= $_POST['Thursday'];}
		if (isset($_POST['Friday'])){
			$dayval= $_POST['Friday'];}
		if (isset($_POST['Saturday'])){
			$dayval= $_POST['Saturday'];}

		$_SESSION['currentdayval'] = $dayval;

		if($_SESSION['vartype'] == 'admin')
		{
			if($dayval != ''){
				$dayval = "SELECT productivity.idnumber, account.fname, account.lname, productivity.productivitylevel, account.supervisorid, productivity.dayoftheweek,
							productivity.weeknumber, productivity.yearnumber
						FROM account INNER JOIN productivity ON account.idnumber = productivity.idnumber
						WHERE dayoftheweek = '".$dayval."' and supervisorid > 0 and weeknumber = '$thisweeknumber' and yearnumber = '$thisyearnumber'";
			}
			else{$dayval = "SELECT productivity.idnumber, account.fname, account.lname, productivity.productivitylevel, account.supervisorid, productivity.dayoftheweek,
							productivity.weeknumber, productivity.yearnumber
						FROM account INNER JOIN productivity ON account.idnumber = productivity.idnumber
						WHERE supervisorid > 0 and weeknumber = '$thisweeknumber' and yearnumber = '$thisyearnumber'";}
		}
		else
		{
			$idreference = $_SESSION['varname'];
			if($dayval != ''){
				$dayval = "SELECT productivity.idnumber, account.fname, account.lname, productivity.productivitylevel, account.supervisorid, productivity.dayoftheweek,
							productivity.weeknumber, productivity.yearnumber
						FROM account INNER JOIN productivity ON account.idnumber = productivity.idnumber
						WHERE dayoftheweek = '".$dayval."' and supervisorid = $idreference and weeknumber = '$thisweeknumber' and yearnumber = '$thisyearnumber'";
			}
			else{$dayval = "SELECT productivity.idnumber, account.fname, account.lname, productivity.productivitylevel, account.supervisorid, productivity.dayoftheweek,
							productivity.weeknumber, productivity.yearnumber
						FROM account INNER JOIN productivity ON account.idnumber = productivity.idnumber
						WHERE supervisorid = $idreference and weeknumber = '$thisweeknumber' and yearnumber = '$thisyearnumber'";}
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
    <style>
	hr.solid {
	  border-top: 2px solid #B3B3B3;
	}
	
	}
	</style>
    <body class="sb-nav-fixed" style="background-color: #F5F5F5">
        <?php include('topbar.php');?>
        <div id="layoutSidenav">
            <?php include('sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                      
                    <div class="container-fluid">
                        

                        <h1 class="mt-3" style="font-size: 30px;color: #621299; margin-bottom: 0">Set Productivity Level</h1>
                        <style>
                            hr.solid {
                              border-top: 2px solid #B3B3B3;
                              margin-top: 0;
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
                        <hr class="solid">
                        <form method="post" class="form-inline" >

                                    <div class="container-fluid" style="margin-bottom: 3px; padding: 0; vertical-align: center; text-align: center"> 
                                                        <input type="submit" name="All" value="ALL" class="btn btn-secondary" style="font-size: 15px;height: 36px; width: 22%; padding: 5px;"> 
                                                        <input type="submit" name="Monday" value="Monday" class="btn btn-secondary" style="font-size: 15px;height: 36px; width: 22%; padding: 5px">
                                                        <input type="submit" name="Tuesday" value="Tuesday" class="btn btn-secondary" style="font-size: 15px;height: 36px; width: 22%; padding: 5px">
                                                        <input type="submit" name="Wednesday" value="Wednesday" class="btn btn-secondary" style="font-size: 13px;height: 36px; width: 22%; padding: 5px">
                                    </div>
                                    <div class="container-fluid" style="margin-bottom: 3px; padding: 0; vertical-align: center; text-align: center"> 
                                                        <input type="submit" name="Thursday" value="Thursday" class="btn btn-secondary" style="font-size: 15px;height: 36px; width: 22%; padding: 5px">
                                                        <input type="submit" name="Friday" value="Friday" class="btn btn-secondary" style="font-size: 15px;height: 36px; width: 22%; padding: 5px">
                                                        <input type="submit" name="Saturday" value="Saturday" class="btn btn-secondary" style="font-size: 15px;height: 36px; width: 22%; padding: 5px">
                                                        <input type="submit" name="Sunday" value="Sunday" class="btn btn-secondary" style="font-size: 15px;height: 36px; width: 22%; padding: 5px">
                                    </div>
                                    <div class="container-fluid row" style="margin-bottom: 3px; padding: 2%;  text-align: center;"> 
                                                        <div style="font-size: 15px;height: 36px; width: 30%; padding: 5px; text-align: right" >
                                                        <label>Date:</label style="font-size: 15px;">
                                                        </div>
                                                        <input type="week" id="datevalue" name="datevalue" class="form-control" style="font-size: 15px;height: 36px; width: 30%; padding: 5px;">
                                                        <button class="btn btn-primary form-control" type="submit" id="datepicker" name="datepicker" style="font-size: 15px;height: 36px; width: 30%; padding: 5px;">
                                                        <i class="fas fa-search"></i></button>
                                    </div>
                                    <div class="container-fluid" style="margin-bottom: 3px; padding: 0; vertical-align: center; text-align: center">       
                                                        <input type="submit" name="setweek" value="Set this week's productivity" class="btn btn-success">
                                                        <input type="submit" name="resetweek" value="Reset" class="btn btn-danger">
                                    </div>
                        </form>
                        
                        

                        <div class="card mb-4 mt-3">
                        <div class="card-body" style="padding:10px">
                                            
                                            <div class="container-fluid " style="margin: auto; padding-left: 0; padding-right: 0">
                                            <form action="" method="post">
                                                    <table id="example3" class="center display table table-striped table-responsive" cellspacing="0" width="100%" style="font-size: 12px;">

                                                        <thead> 

                                                            <tr>
                                                                <th>Date</th>
                                                                <th>ID Number</th>
                                                                <th>First Name</th>
                                                                <th>Last Name</th>
                                                                <th>Productivity Level</th>
                                                                <th>Supervisor</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $sql= $dayval;
                                                            $query = $dbh->prepare($sql);
                                                            $query->execute();
                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt=1;
                                                            if($query->rowCount() > 0)
                                                            {
                                                                foreach($results as $result)
                                                                {   ?>

                                                                <?php 
                                                                $supid = htmlentities($result->supervisorid);

                                                                $supidsql = "SELECT * FROM account WHERE  idnumber='$supid' LIMIT 1";
                                                                $supidquery = $dbh->prepare($supidsql);
                                                                $supidquery->execute();
                                                                $supidresults = $supidquery->fetchAll(PDO::FETCH_OBJ);
                                                                
                                                                foreach($supidresults as $supidresult)
                                                                {
                                                                    $finalsupid = $supidresult;
                                                                }


                                                                $color = '';
                                                                $positivesign = '';
                                                                if(htmlentities($result->productivitylevel) >= 0){
                                                                    $color = 'green';
                                                                    $positivesign = '+';
                                                                }
                                                                else{
                                                                    $color = 'red';
                                                                }
                                                                ?>
                            

                                                                <tr>
                                                                <?php 
                                                                    $dayoftheweek = array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

                                                                ?>
                                                                <td>
                                                                    W<?php echo htmlentities($result->weeknumber)?>, 
                                                                    <?php echo date('m/d/Y', strtotime(htmlentities($result->yearnumber)."W".htmlentities($result->weeknumber).array_search(htmlentities($result->dayoftheweek), $dayoftheweek)))?>	
                                                                </td>
                                                                <td><?php echo htmlentities($result->idnumber);?></td>
                                                                <td><?php echo htmlentities($result->fname);?></td>
                                                                <td><?php echo htmlentities($result->lname);?></td>
                                                                <td style="color:<?php echo $color?>"><b><?php echo $positivesign?><?php echo htmlentities($result->productivitylevel);?></b></td>
                                                                <td><?php echo htmlentities($finalsupid->fname);?> <?php echo htmlentities($finalsupid->lname);?></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"
                                                                    onclick="updateInfo('<?php echo htmlentities($result->productivitylevel);?>','<?php echo htmlentities($result->idnumber);?>','<?php echo htmlentities($result->dayoftheweek);?>','<?php echo htmlentities($result->weeknumber);?>','<?php echo htmlentities($result->yearnumber);?>','<?php echo htmlentities($result->supervisorid);?>'
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
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Productivity Level</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            


                                            <div class="form-group">
                                                <label class="small mb-1" for="prod">Productivity Level:</label>
                                                <input class="form-control py-4" name="prod" id="prod" type="number" min="-8" max="8" step=".01" />

                                            </div>
                                            
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" id="saveid" name="saveid" value="0"/>
                                            <input type="hidden" id="saveday" name="saveday" value="0"/>
                                            <input type="hidden" id="saveyear" name="saveyear" value="0"/>
                                            <input type="hidden" id="saveweek" name="saveweek" value="0"/>
                                            <input type="hidden" id="savesupid" name="savesupid" value="0"/>


                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="savechanges" name="savechanges" class="btn btn-primary">Save changes</button>
                                        </div>
                            </form>
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
            function updateInfo(productivitylevel,idnumber,dayoftheweek,weeknumber,yearnumber,supidnumber) {
                document.getElementById('prod').value = productivitylevel;  // TREATS EVERY CONTENT AS TEXT.
                document.getElementById("saveid").value = idnumber;
                document.getElementById("saveday").value = dayoftheweek;
                document.getElementById("saveyear").value = yearnumber;
                document.getElementById("saveweek").value = weeknumber;
                document.getElementById("savesupid").value = supidnumber;
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
