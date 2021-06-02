<html>
<body class="sb-nav-fixed">

        <?php include('topbar.php');?>
        <div id="layoutSidenav">
            <?php include('sidebar.php');?>
            <div id="layoutSidenav_content">
                <div class="container-fluid">   
                    <style>
                        .center {
                          margin: auto;
                          width: 60%;
                        }
                    </style>
                    
                    <div class="center"> 
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Current Week's Productivity Meter
                                </div>
                                <div class="card-body ">
                                    <?php include('testchart.php');?>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                    

                    <?php

                    //echo date("l");

                    $sqlcount="SELECT yearnumber, weeknumber, dayoftheweek, SUM(productivitylevel) as totalprod 
                               FROM productivity 
                               where weeknumber='$weektoday' AND yearnumber='$yeartoday'
                               GROUP BY dayoftheweek"; 
                    $countquery = $dbh->prepare($sqlcount);
                    $countquery->execute();
                    $countresults=$countquery->fetchAll(PDO::FETCH_OBJ);
                    $tickmax = 0;
                    //echo $countquery->rowCount();
                    $dayoftheweek = array("","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
                    $dayoftheweekdate = array(0,0,0,0,0,0,0);
                    //$dayoftheweek = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
                    $dayoftheweekval = array(0,0,0,0,0,0,0);
                    $dayoftheweekindex = array(4,0,5,6,3,1,2);
                    // 1 , 5 , 6 , 4 , 0 , 2 , 3
                    // 4,0,5,6,3,1,2
                    $count = 0;
                    if($countquery->rowCount() > 0)
                    {
                        foreach($countresults as $countresult)
                        {
                            //echo htmlentities($countresult->dayoftheweek);
                            //echo date('m/d/Y', strtotime(htmlentities($countresult->yearnumber)."W".htmlentities($countresult->weeknumber).array_search(htmlentities($countresult->dayoftheweek), $dayoftheweek)));
                            $dayoftheweekdate[$dayoftheweekindex[$count]] = date('m/d/Y', strtotime(htmlentities($countresult->yearnumber)."W".htmlentities($countresult->weeknumber).array_search(htmlentities($countresult->dayoftheweek), $dayoftheweek)));
                            $dayoftheweekval[$dayoftheweekindex[$count]] = $countresult->totalprod;
                            if(abs($dayoftheweekval[$dayoftheweekindex[$count]]) > $tickmax)
                                $tickmax = abs($dayoftheweekval[$dayoftheweekindex[$count]]);
                            $count = $count + 1;
                        }
                    }   
                        //echo $dayoftheweekdate[];
                        //echo $statictotalhours;
                        //echo $dayoftheweekval[0],$dayoftheweekval[1],$dayoftheweekval[2],$dayoftheweekval[3],$dayoftheweekval[4],$dayoftheweekval[5],$dayoftheweekval[6] ;
                    ?>


                        <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                        </div>

                    <?php
                    $sqlcount="SELECT weeknumber, SUM(productivitylevel) as totalprod 
                               FROM productivity 
                               WHERE yearnumber='$yeartoday'
                               GROUP BY weeknumber
                               LIMIT 5"; 
                    $countquery = $dbh->prepare($sqlcount);
                    $countquery->execute();
                    $countresults=$countquery->fetchAll(PDO::FETCH_OBJ);
                    //echo count($countresults);

                    $weekval = array('','','','','');
                    $weekprod = array(0,0,0,0,0);
                    $count = 0;
                    $mintick = 100;
                    if($countquery->rowCount() > 0)
                    {
                        foreach($countresults as $countresult)
                        {
                            //echo $count;
                            //echo $countresult->weeknumber;
                            //$totalhours = 360;
                            $sqltotalhours = "SELECT * FROM productivity where weeknumber='$countresult->weeknumber' AND yearnumber='$yeartoday'";
                            $totalhoursquery = $dbh->prepare($sqltotalhours);
                            $totalhoursquery->execute();
                            $hoursresults=$totalhoursquery->fetchAll(PDO::FETCH_OBJ);
                            
                            $totalhours = $totalhoursquery->rowCount()/7*5*8;
                            //echo $totalhours;

                            $percentvar = 0;
                            if($countresult->totalprod < 0)
                            {
                            $percentvar = $countresult->totalprod / $totalhours;
                            $percentvar = $percentvar + 1;
                            $percentvar = $percentvar * 100;
                            $percentvar = number_format($percentvar, 2, '.', '');
                            }
                            else
                            {
                            $percentvar = 100;
                            $percentvar = number_format($percentvar, 2, '.', '');
                            $totalprod = 0;
                            }
                            //echo $percentvar;
                            if($percentvar < $mintick)
                            {
                                $mintick = $percentvar;
                            }

                            $weekprod[$count] = $percentvar;
                            $weekval[$count] = "WEEK ".$countresult->weeknumber;
                            $count = $count + 1;
                        }
                    }
                    //echo $weekval[0],$weekval[1],$weekval[2],$weekval[3],$weekval[4];
                    //echo $weekprod[0],$weekprod[1],$weekprod[2],$weekprod[3],$weekprod[4];
                    ?>
                        <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display table table-striped" cellspacing="0" width="100%">

                                                <thead> 

                                                    <tr>
                                                        <th>ID Number</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Productivity Level</th>
                                                        <th>Supervisor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $thisweeknumber = $_SESSION['thisweeknumber'];
                                                    $thisyearnumber = $_SESSION['thisyearnumber'];
                                                    $sql= "SELECT productivity.idnumber, account.fname, account.lname, account.supervisorid, 
                                                        sum(productivity.productivitylevel) AS totalprod
                                                        FROM account INNER JOIN productivity ON account.idnumber = productivity.idnumber
                                                        WHERE supervisorid > 0 and weeknumber = '$thisweeknumber' and yearnumber = '$thisyearnumber'
                                                        GROUP BY idnumber";
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
                                                        if(htmlentities($result->totalprod) >= 0){
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
                                                        
                                                        <td><?php echo htmlentities($result->idnumber);?></td>
                                                        <td><?php echo htmlentities($result->fname);?></td>
                                                        <td><?php echo htmlentities($result->lname);?></td>
                                                        <td style="color:<?php echo $color?>"><b><?php echo $positivesign?><?php echo htmlentities($result->totalprod);?></b></td>
                                                        <td><?php echo htmlentities($finalsupid->fname);?> <?php echo htmlentities($finalsupid->lname);?></td>
                                                        
                                                        </tr>
                                                        

                                                        
                                                        <?php $cnt=$cnt+1;
                                                        }
                                                    } ?>
                                                </tbody>
                                            </table>
                            </div>
                        </div>
                    </div>

                </div>
                            
                    
                    
                
                <main>
                    
                
                        
                    
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
            var datevar = new Date();

            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: ["<?php echo $dayoftheweekdate[0]?>",
                         "<?php echo $dayoftheweekdate[1]?>",
                         "<?php echo $dayoftheweekdate[2]?>",
                         "<?php echo $dayoftheweekdate[3]?>",
                         "<?php echo $dayoftheweekdate[4]?>",
                         "<?php echo $dayoftheweekdate[5]?>",
                         "<?php echo $dayoftheweekdate[6]?>"],
                datasets: [{
                  label: "Productivity",
                  lineTension: 0.3,
                  backgroundColor: "rgba(2,117,216,0.2)",
                  borderColor: "rgba(2,117,216,1)",
                  pointRadius: 5,
                  pointBackgroundColor: "rgba(2,117,216,1)",
                  pointBorderColor: "rgba(255,255,255,0.8)",
                  pointHoverRadius: 5,
                  pointHoverBackgroundColor: "rgba(2,117,216,1)",
                  pointHitRadius: 50,
                  pointBorderWidth: 2,
                  data: [parseFloat("<?php echo $dayoftheweekval[0]?>"),
                         parseFloat("<?php echo $dayoftheweekval[1]?>"),
                         parseFloat("<?php echo $dayoftheweekval[2]?>"),
                         parseFloat("<?php echo $dayoftheweekval[3]?>"),
                         parseFloat("<?php echo $dayoftheweekval[4]?>"),
                         parseFloat("<?php echo $dayoftheweekval[5]?>"),
                         parseFloat("<?php echo $dayoftheweekval[6]?>")],
                }],
              },
              options: {
                scales: {
                  xAxes: [{
                    time: {
                      unit: 'date'
                    },
                    gridLines: {
                      display: false
                    },
                    ticks: {
                      maxTicksLimit: 7
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      min: -parseInt("<?php echo $tickmax?>") - 4,
                      max: parseInt("<?php echo $tickmax?>") + 4,
                      maxTicksLimit: 100
                    },
                    gridLines: {
                      color: "rgba(0, 0, 0, .125)",
                    }
                  }],
                },
                legend: {
                  display: false
                }
                
              }
            });
            //echo $weekval[0],$weekval[1],$weekval[2],$weekval[3],$weekval[4];
            //echo $weekprod[0],$weekprod[1],$weekprod[2],$weekprod[3],$weekprod[4];
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ["<?php echo $weekval[0]?>","<?php echo $weekval[1]?>",
                         "<?php echo $weekval[2]?>","<?php echo $weekval[3]?>",
                         "<?php echo $weekval[4]?>"],
                datasets: [{
                  label: "Productivity",
                  backgroundColor: "rgba(2,117,216,1)",
                  borderColor: "rgba(2,117,216,1)",
                  data: [parseFloat("<?php echo $weekprod[0]?>"),parseFloat("<?php echo $weekprod[1]?>"),
                         parseFloat("<?php echo $weekprod[2]?>"),parseFloat("<?php echo $weekprod[3]?>"),
                         parseFloat("<?php echo $weekprod[4]?>")],
                }],
              },
              options: {
                scales: {
                  xAxes: [{
                    time: {
                      unit: 'month'
                    },
                    gridLines: {
                      display: false
                    },
                    ticks: {
                      maxTicksLimit: 6
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      min: <?php echo intval($mintick)?> - 1,
                      max: 100,
                      maxTicksLimit: 10
                    },
                    gridLines: {
                      display: true
                    }
                  }],
                },
                legend: {
                  display: false
                }
              }
            });
        </script>
    </body>
</html>