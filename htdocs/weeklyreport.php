<?php
session_start();
//error_reporting(0);
include('config.php');
date_default_timezone_set('Asia/Manila');
//echo '<script>alert("'.date("W").'")</script>';



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
         <?php include('topbar.php');?>
        <div id="layoutSidenav">
            <?php include('sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                      
                    <div class="container-fluid">
                        
                        <h1 class="mt-3" style="font-size: 30px;color: #621299; margin-bottom: 0">Weekly Report</h1>
                        <style>
                            hr.solid {
                              border-top: 2px solid #B3B3B3;
                              margin-top: 0;
                            }
                        </style>
                        <hr class="solid">


                                        <form action="" method="post">
                                            <table id="example1" class="display table table-striped table-responsive" cellspacing="0" width="100%" border="3" cellspacing="0" cellpadding="4" style="font-size:12px">
                                                <thead>
                                                                                                                    
                                                        <tr>
                                                        <th>Team</th>
                                                        <th style="text-align: center;">Sunday</th>
                                                        <th style="text-align: center;">Monday</th>
                                                        <th style="text-align: center;">Tuesday</th>
                                                        <th style="text-align: center;">Wednesday</th>
                                                        <th style="text-align: center;">Thursday</th>
                                                        <th style="text-align: center;">Friday</th>
                                                        <th style="text-align: center;">Saturday</th>
                                                        <th style="text-align: center;">Total:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $sql="SELECT * FROM account WHERE issupervisor = 1";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    $prodperweek = array(0,0,0,0,0,0,0);
                                                    if($query->rowCount() > 0)
                                                    {
                                                    foreach($results as $result)
                                                        {   ?>

                                                        <?php 
                                                        //$supid = htmlentities($result->supervisorid);

                                                        //$supidsql = "SELECT * FROM account WHERE  idnumber='$supid' LIMIT 1";
                                                        //$supidquery = $dbh->prepare($supidsql);
                                                        //$supidquery->execute();
                                                        //$supidresults = $supidquery->fetchAll(PDO::FETCH_OBJ);
                                                        
                                                        //if($supidquery->rowCount() > 0)
                                                        {
                                                        //  foreach($supidresults as $supidresult)
                                                            {
                                                        //      $finalsupid = $supidresult;
                                                            }
                                                        //  $finalsupid =  $finalsupid->fname." ".$finalsupid->lname;
                                                        }
                                                        //else
                                                        {
                                                        //  $finalsupid =  "Choose";
                                                        }


                                                        ?>
                                                        

                                                        <tr>
                                                        
                                                        
                                                        <td><?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->lname);?></td>
                                                        <?php 
                                                        
                                                        $supid = htmlentities($result->idnumber);
                                                        //echo '<script>alert("'.$supid.'")</script>';
                                                        $persuptotal = 0;
                                                        $dayoftheweek = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
                                                        $yeartoday = date("Y");
                                                        $weektoday = date("W");
                                                        foreach ($dayoftheweek as $day) {
                                                            $empsql = "SELECT Productivity.productivitylevel
                                                                   FROM Account, Productivity
                                                                   WHERE supervisorid = $supid and Productivity.dayoftheweek='$day' AND Account.idnumber = Productivity.idnumber
                                                                   AND weeknumber='$weektoday' AND yearnumber='$yeartoday'";
                                                            $empquery = $dbh->prepare($empsql);
                                                            $empquery->execute();
                                                            $empresult=$empquery->fetchAll(PDO::FETCH_OBJ);
                                                            $emptotal = 0;
                                                            
                                                            
                                                                foreach($empresult as $emp)
                                                                {
                                                                    $emptotal = $emptotal + htmlentities($emp->productivitylevel);
                                                                    echo '<script>alert("atay")</script>';
                                                                }
                                                            
                                                            $array = array_search("$day", $dayoftheweek);
                                                            $prodperweek[$array] = $prodperweek[$array] + $emptotal;
                                                            $persuptotal = $persuptotal + $emptotal;

                                                            $color = '';
                                                            $positivesign = '';
                                                            if($emptotal > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($emptotal == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>



                                                        <td  style="text-align: center; color: <?php echo $color;?>"><b><?php echo $positivesign; echo $emptotal;?></b></td>


                                                        <?php } 
                                                        if($persuptotal > 0){
                                                            $color = 'green';
                                                            $positivesign = '+';
                                                        }
                                                        elseif ($persuptotal == 0) {
                                                            $color = 'green';
                                                            $positivesign = '';
                                                        }
                                                        else{
                                                            $color = 'red';
                                                            $positivesign = '';
                                                        }

                                                        ?>
                                                        <td style="text-align: center; color: <?php echo $color;?>"><b><?php echo $positivesign; echo $persuptotal;?></b></td>
                                                        </tr>
                                                        <?php 
                                                        }
                                                    } ?>
                                                    <tr>
                                                            <td><b>Total: </b></td>
                                                            <?php
                                                            $totalprod = $prodperweek[0] + $prodperweek[1] + $prodperweek[2] + $prodperweek[3] + 
                                                                         $prodperweek[4] + $prodperweek[5] + $prodperweek[6];
                                                            $color = '';
                                                            $positivesign = '';
                                                            if($prodperweek[0] > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($prodperweek[0] == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>
                                                            <td style="text-align: center; color: <?php echo $color ?>"><b><?php echo $positivesign; echo $prodperweek[0];?></b></td>
                                                            <?php
                                                            $color = '';
                                                            $positivesign = '';
                                                            if($prodperweek[1] > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($prodperweek[1] == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>
                                                            <td style="text-align: center; color: <?php echo $color ?>"><b><?php echo $positivesign; echo $prodperweek[1];?></b></td>
                                                            <?php
                                                            $color = '';
                                                            $positivesign = '';
                                                            if($prodperweek[2] > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($prodperweek[2] == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>
                                                            <td style="text-align: center; color: <?php echo $color ?>"><b><?php echo $positivesign; echo $prodperweek[2];?></b></td>
                                                            <?php
                                                            $color = '';
                                                            $positivesign = '';
                                                            if($prodperweek[3] > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($prodperweek[3] == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>
                                                            <td style="text-align: center; color: <?php echo $color ?>"><b><?php echo $positivesign; echo $prodperweek[3];?></b></td>
                                                            <?php
                                                            $color = '';
                                                            $positivesign = '';
                                                            if($prodperweek[4] > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($prodperweek[4] == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>
                                                            <td style="text-align: center; color: <?php echo $color ?>"><b><?php echo $positivesign; echo $prodperweek[4];?></b></td>
                                                            <?php
                                                            $color = '';
                                                            $positivesign = '';
                                                            if($prodperweek[5] > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($prodperweek[5] == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>
                                                            <td style="text-align: center; color: <?php echo $color ?>"><b><?php echo $positivesign; echo $prodperweek[5];?></b></td>
                                                            <?php
                                                            $color = '';
                                                            $positivesign = '';
                                                            if($prodperweek[6] > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($prodperweek[6] == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>
                                                            <td style="text-align: center; color: <?php echo $color ?>"><b><?php echo $positivesign; echo $prodperweek[6];?></b></td>
                                                            <?php
                                                            $color = '';
                                                            $positivesign = '';
                                                            if($totalprod > 0){
                                                                $color = 'green';
                                                                $positivesign = '+';
                                                            }
                                                            elseif ($totalprod == 0) {
                                                                $color = 'green';
                                                                $positivesign = '';
                                                            }
                                                            else{
                                                                $color = 'red';
                                                                $positivesign = '';
                                                            }
                                                            ?>
                                                            <td style="outline: 1.5px solid black; text-align: center; color: <?php echo $color ?>"><b><?php echo $positivesign; echo $totalprod;?></b></td>

                                                    </tr>
                                                                                               
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
            </div>
        </div>
        <script>
            function updateInfo(variable,variable2) {
                let supmodalText = document.getElementById('supmodal');
                supmodalText.innerText = variable;       // TREATS EVERY CONTENT AS TEXT.
                document.getElementById("savesupid").value = variable2;
            }

            function editInfo(fname,lname,idnumber,supervisorname,supervisorid) {
                document.getElementById("fname").value = fname;
                document.getElementById("lname").value = lname;
                document.getElementById("idnumber").value = idnumber;
                document.getElementById('supmodal').innerText = supervisorname;

                document.getElementById("saveid").value = idnumber;
                document.getElementById("savesupid").value = supervisorid;

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