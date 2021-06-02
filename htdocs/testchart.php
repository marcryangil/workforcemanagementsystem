<?php
  
  date_default_timezone_set('Asia/Manila');
  $yeartoday = date("Y");
  $weektoday = date("W");
  //echo date("r");
  $sqlcount="SELECT * FROM productivity where weeknumber='$weektoday' AND yearnumber='$yeartoday'"; 
  $countquery = $dbh->prepare($sqlcount);
  $countquery->execute();
  $countresults=$countquery->fetchAll(PDO::FETCH_OBJ);
  
  $totalprod=0;
  $totalhours = $countquery->rowCount()/7*5*8;
  //echo $countquery->rowCount();
  //$statictotalhours = $totalhours;
  //echo $totalhours;
  if($countquery->rowCount() > 0)
  {
      foreach($countresults as $countresult)
      {
          $totalprod = $totalprod + intval(htmlentities($countresult->productivitylevel));
      }
  
      if($totalprod < 0)
      {
        $percentvar = $totalprod / $totalhours;
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
      if($totalprod < 0)
      {
        $totalhours = $totalhours + $totalprod;
      }
  }
  else{
    $percentvar = 0;
    $percentvar = number_format($percentvar, 2, '.', '');
  }
?>
<html>
  <head>
    


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"/>
  </head>
  <body>
            <style>
                        .center {
                          margin: auto;
                          //width: 60%;
                        }
            </style>

    <div class="container-fluid">
      <div class="column">
          <div class="col-xl-5 col-md-6 " style="margin: auto;">
              <canvas id="mychart" width="75" height="50"></canvas>
              
          </div>
         
            
            
          <div style="text-align:center;">
          <label style="font-size: 50px; color: #5A5A5A; vertical-align: middle;" for="nextchart"><b><?php echo$percentvar?>%</b></label>
          </div> 
          
            
          

        </div>
    </div>
   
    
    
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
  <script type="text/javascript">
    var ctx = document.getElementById("mychart");
    var mychart = new Chart(ctx, {
      type: 'doughnut',
    data: {
      labels: ["Productivity Reached", "Productivity Lost"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["rgba(0, 250, 0, .8)","rgba(250, 0, 0, .8)"],
          data: [parseInt("<?php echo $totalhours?>"), parseInt("<?php echo $totalprod?>")]
        }
      ]
    },
   /* options: {
      title: {
        display: true,
        fontSize: 50,
        fontColor: 'black'//,
        //text: 'Current Week\'s Productivity Meter'
      }
    }*/
    
  });

  </script>

  </body>
</html>