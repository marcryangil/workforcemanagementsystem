<?php 
// DB credentials.
$hostname = "sql207.epizy.com";
$rootname = "epiz_28592834";
$password = "HkyVyAU7745h2Np";
$db_name = "epiz_28592834_workforce";
// Establish database connection.
try
{

	$dbh = mysqli_connect($hostname,$rootname,$password,$db_name);

}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

?>