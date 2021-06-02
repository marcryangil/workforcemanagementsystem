<?php
session_start();
//error_reporting(0);
include('config.php');
date_default_timezone_set('Asia/Manila');

    //if($_SESSION['vartype'] == 'supervisor')
    //    {
    //        echo '<script>window.location.href="index.php";alert("No Access!")</script>';
    //    }
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
    <body class="sb-nav-fixed">
        
       
                <main>
                      <div> </div>
                    <div class="container-fluid">
                        <h1></h1>
                        <h1 class="mt-3" style="font-size: 30px;color: #621299; margin-bottom: 0">History Log</h1>
                        <style>
                            hr.solid {
                              border-top: 2px solid #B3B3B3;
                              margin-top: 0;
                            }
                        </style>
                        <hr class="solid">


                                        <form action="" method="post">

                                            <table id="example3" class="display table table-striped" cellspacing="0" width="100%" style="white-space:pre-wrap; word-wrap:break-word">
                                                                        <thead>
                                                                                                                                            
                                                                                <tr>
                                                                                <th>Date</th>
                                                                                <th>Action</th>
                                                                                <th>Modified By</th>
                                                                                
                                                                                </tr>
                                                                        </thead>
                                                                        
                                                                        <tbody>
                                                                            <?php 
                                                                            $empID = $_COOKIE['empID'];
                                                                            //$sql="SELECT * FROM historylog ORDER BY nDate DESC";

                                                                            //echo '<script>alert('.$empID.')</script>';
                                                                            //$strVal = $_SESSION['vartype']." - ".$_SESSION['varname']." - ".$_SESSION['fullname'];
                                                                            $conditionstr = $empID;
                                                                            $sql="SELECT * FROM historylog WHERE action 
                                                                            LIKE CONCAT('%',$conditionstr,'%') ORDER BY nDate DESC";
                                                                            
                                                                            
                                                                            
                                                                            $query = $dbh->prepare($sql);
                                                                            $query->execute();
                                                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                                            
                                                                            if($query->rowCount() > 0)
                                                                            {
                                                                            foreach($results as $result)
                                                                                {   ?>
                                                                                <tr>
                                                                                
                                                                                <td><?php echo date_format(date_create(htmlentities($result->nDate)),"m/d/Y H:i:s");?></td>
                                                                                <td><?php echo htmlentities($result->action);?></td>
                                                                                <td><?php echo htmlentities($result->modifiedby);?></td>
                                                                                
                                                                                </tr>
                                                                                <?php 
                                                                                }
                                                                            } ?>
                                                                                                                       
                                                                        </tbody>
                                                                    </table>

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

            <nav class="sb-topnav navbar navbar-expand navbar-dark" style="padding-left: 0.5rem; color: blue; background-color: #621299; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
                        <button class="btn" style="color:white" onclick="location.href='viewsupervisors.php'"><i class="fas fa-arrow-left"></i> Go Back</button>
                        
            </nav>
       
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

                $('#example3').DataTable({"order": [[ 0, "desc" ]]});
            });
        </script>
        <script>
            function goBack() {
              window.history.back();
            }
        </script>
    </body>
</html>