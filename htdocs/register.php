<?php

    session_start();
    //include('config.php');
    date_default_timezone_set('Asia/Manila');

        if($_SESSION['vartype'] == 'supervisor')
        {
            echo '<script>window.location.href="index.php";alert("No Access!")</script>';
        }

    


    if(isset($_POST['submit']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $idnumber = $_POST['idnumber'];
        $accpass = strtoupper($_POST['lname']);


        include('login_config.php');
        $sql = "SELECT * FROM account WHERE idnumber = '$idnumber' LIMIT 1";
        $result = mysqli_query($dbh,$sql);
        $row = $result -> fetch_assoc();
        if(mysqli_num_rows($result))
        {
            echo '<script>alert("ID number already exists!")</script>';
        }
        else
        {
            echo '<script>alert("Added successfully!")</script>';
        }

        include('config.php');
        

        $sql="INSERT INTO account(idnumber,fname,lname,accpass,issupervisor,supervisorid) VALUES(:idnumber,:fname,:lname,:accpass,1,-1)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':idnumber',$idnumber,PDO::PARAM_STR);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':lname',$lname,PDO::PARAM_STR);
        $query->bindParam(':accpass',$accpass,PDO::PARAM_STR);
        $query->execute();


        
        $action = "Added supervisor account: \nID Number - ".$idnumber."\nName - ".$fname." ".$lname;
        include('addtolog.php');

        
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
                    <br><br><br>
                    
                    <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header" style="background-color:#d1f2ff; color: black"><h3 class="text-center font-weight-light my-4">Add Supervisor Account</h3></div>
                                    <div class="card-body">

                                        <form method="POST">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="fname">First Name</label>
                                                        <input class="form-control py-4" name="fname" id="fname" type="input" placeholder="Enter first name" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="lname">Last Name</label>
                                                        <input class="form-control py-4" id="lname" name="lname" type="input" placeholder="Enter last name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="idnumber">ID Number</label>
                                                <input class="form-control py-4" name="idnumber" id="idnumber" type="input" placeholder="Enter ID Number" required/>
                                            </div>
                                            <style>
                                                .btn-primary {
                                                  color: black;
                                                  background-color: #d1f2ff;
                                                  border-color: #d1f2ff;
                                                }
                                                .btn-primary:hover {
                                                  color: #d1f2ff;
                                                  background-color: #ebb1ff;
                                                  border-color: #ebb1ff;
                                                }
                                                .btn-primary:focus, .btn-primary.focus {
                                                  color: #d1f2ff;
                                                  background-color: #ebb1ff;
                                                  border-color: #ebb1ff;
                                                  box-shadow: 0 0 0 0.2rem rgba(98,18,153, 0.5);
                                                }
                                                .btn-primary.disabled, .btn-primary:disabled {
                                                  color: #d1f2ff;
                                                  background-color: #d1f2ff;
                                                  border-color: #ebb1ff;
                                                }
                                                .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
                                                  color: #d1f2ff;
                                                  background-color: #ebb1ff;
                                                  border-color: #ebb1ff;
                                                }
                                                .btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .show > .btn-primary.dropdown-toggle:focus {
                                                  box-shadow: 0 0 0 0.2rem rgba(98,18,153, 0.5);
                                                }
                                            </style>
                                            <div class="form-group mt-4 mb-0">
                                            <button type="submit" id="submit" name="submit" class="btn btn-primary btn-block">Add Supervisor Account</button>
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
