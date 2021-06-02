<?php
										
										 
	$nDate = date("r");
    //$action = "Deleted supervisor account: \nID Number - ".$idnumber;
    if($_SESSION['vartype'] == 'admin')
    {
		$modifiedby = 'admin';
    }
    else
    {
    	$modifiedby = $_SESSION['vartype']." - ".$_SESSION['varname']." - ".$_SESSION['fullname'];
    }
    

    $logsql="INSERT INTO historylog(nDate,action,modifiedby) VALUES(:nDate,:action,:modifiedby)";
    $logquery = $dbh->prepare($logsql);
    $logquery->bindParam(':nDate',$nDate,PDO::PARAM_STR);
    $logquery->bindParam(':action',$action,PDO::PARAM_STR);
    $logquery->bindParam(':modifiedby',$modifiedby,PDO::PARAM_STR);
    $logquery->execute();


?>