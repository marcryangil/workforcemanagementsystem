<?php 
    $yeartoday = date("Y");
    $weektoday = date("W");
    //echo $weektoday;
    $sqlcount="SELECT productivity.productivitylevel, account.fname, account.lname, account.supervisorid
               FROM productivity INNER JOIN account ON productivity.idnumber = account.idnumber
               where weeknumber='$weektoday' AND yearnumber='$yeartoday'"; 
    $countquery = $dbh->prepare($sqlcount);
    $countquery->execute();
    $countresults=$countquery->fetchAll(PDO::FETCH_OBJ);
    
    $supname = array();
    $supnamegained = array();
    //$supname = $supname + array('test1' => 1);
    //$supname['test'] = $supname['test'] + 2;
    //echo $supname['test'];
    
    $supnamelist = array();
    //$supnamelist[] = 'name';
    //print_r(array_unique($supnamelist));
    

    if($countquery->rowCount() > 0)
    {
        foreach($countresults as $result)
        {  
          //echo $result->productivitylevel;

          $sql = "SELECT fname, lname FROM account WHERE idnumber = $result->supervisorid";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);

          if($query->rowCount() > 0)
          {
            foreach ($results as $key)
            {
              //echo $key->lname;
              //$supname = $supname + array('$key->lname' => 1);
              $supnamelist[] = $key->lname;
              if($result->productivitylevel < 0)
              {
                if(isset($supname[$key->lname]))
                {
                  //echo $supname[$key->lname];
                  $supname[$key->lname] = $supname[$key->lname] + $result->productivitylevel;
                }
                else
                {
                  $supname = $supname + array($key->lname => $result->productivitylevel);
                }
              }
              elseif($result->productivitylevel > 0) {
                if(isset($supnamegained[$key->lname]))
                {
                  //echo $supnamegained[$key->lname];
                  $supnamegained[$key->lname] = $supnamegained[$key->lname] + $result->productivitylevel;
                }
                else
                {
                  $supnamegained = $supnamegained + array($key->lname => $result->productivitylevel);
                }
              }
              else
              {
                if(!isset($supname[$key->lname]))
                {
                  $supname = $supname + array($key->lname => $result->productivitylevel);
                }
                if(!isset($supnamegained[$key->lname]))
                {
                  $supnamegained = $supnamegained + array($key->lname => $result->productivitylevel);
                }
              }
              

              

              //echo $supname[$key->fname]."/";
            }
          }
        }
    }
    //echo $supname['Novel'];
    $supnamelist = array_values(array_unique($supnamelist));
    //print_r(count($supnamelist));
    //echo $supname[$supnamelist[0]];

?>

<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2",
  title:{
    //text: "This week's productivity",
    fontFamily: "arial black",
    fontColor: "#695A42"
  },
  //axisX: {
  //  interval: 1,
  //  intervalType: "year"
  //},
  //axisY:{
  //  title: "hours"
  //},
  toolTip: {
    enabled: false
    //content: toolTipContent
  },

  data: [
    {type: "stackedColumn",
    showInLegend: false,
    dataPoints: [ {y: 0, label: "Hours Recovered"}, {y: 0, label: "Lost Hours"},]}
    ]
});

chart.render();

function testfunction(teamleader, positiveprod, negativeprod)
{
  //var length = chart.options.data[0].dataPoints.length;
  //chart.options.title.text = "New DataPoint Added at the end";
  chart.options.data.push({type: "stackedColumn",
    showInLegend: true,
    
    name: teamleader,
    dataPoints: [ {y: positiveprod, label: "Hours Recovered"}, {y: negativeprod, label: "Lost Hours"},]});
  chart.render();
}

var names = <?php echo json_encode($supnamelist) ?>;
var neg = <?php echo json_encode($supname) ?>;
var pos = <?php echo json_encode($supnamegained) ?>;

for (var i = 0; i < parseInt("<?php echo count($supnamelist) ?>"); i++) {
  testfunction("Team ".concat(names[i]),
               pos[names[i]],
               neg[names[i]] * -1
               );

  
}


function toolTipContent(e) {
  /*var str = "";
  var total = 0;
  var str2, str3;
  for (var i = 0; i < e.entries.length; i++){
    var  str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\"> "+e.entries[i].dataSeries.name+"</span>: $<strong>"+e.entries[i].dataPoint.y+"</strong>bn<br/>";
    total = e.entries[i].dataPoint.y + total;
    str = str.concat(str1);
  }
  str2 = "<span style = \"color:DodgerBlue;\"><strong>"+(e.entries[0].dataPoint.x).getFullYear()+"</strong></span><br/>";
  total = Math.round(total * 100) / 100;
  str3 = "<span style = \"color:Tomato\">Total:</span><strong> $"+total+"</strong>bn<br/>";
  */
  str2 = "";
  str = "";
  str3 = "";
  return (str2.concat(str)).concat(str3);
}

}
</script>
<script>
    
  
</script>
</head>
<body>
<div id="chartContainer" style="height: 500px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>