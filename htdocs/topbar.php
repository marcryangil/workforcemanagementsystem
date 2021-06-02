<?php
date_default_timezone_set('Asia/Manila');
if(isset($_SESSION['varname']) && !empty($_SESSION['varname'])) {
       //echo '<script>alert("Set and not empty, and no undefined index error!")</script>';
    }
    else
    {
        echo '<script>window.location.href="login.php"</script>';
    }


    if(isset($_POST['logout']))
    {

        $_SESSION['varname'] = '';
        echo '<script>window.location.href="login.php"</script>';
        
    }

    if(isset($_POST['savepass1']))
    {
        
        $hostname = "sql207.epizy.com";
		$rootname = "epiz_28592834";
		$password = "HkyVyAU7745h2Np";
		$db_name = "epiz_28592834_workforce";
        // Establish database connection.
        try
        {
        $dbh = new PDO("mysql:host=".$hostname.";dbname=".$db_name,$rootname,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        }
        catch (PDOException $e)
        {
        exit("Error: " . $e->getMessage());
        }


        $idnumber = $_SESSION['varname'];
        $confirmnewpass = $_POST['confirmnewpass'];

        
        $updatesql="UPDATE account SET accpass = '$confirmnewpass' WHERE idnumber='$idnumber'";
        $updatequery = $dbh->prepare($updatesql);
        $updatequery->execute();

        $action = "Changed Password";
        include('addtolog.php');

        $_SESSION['accpass'] = $confirmnewpass;

        //$query->execute();
        $lastInsertId = $dbh->lastInsertId();

        echo '<script>alert("Password changed successfully!")</script>';
    
        
    }


?>
<?php include('echomessage.php'); ?>
<div class="modal fade" id="accountsettings" tabindex="-1" role="dialog" aria-labelledby="accountsettingsTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <form method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="savedpassword" name="savedpassword" value="<?php echo $_SESSION['accpass'] ?>"/>
            <div class="form-group">
                <label class="small mb-1" for="currentpass" id="currentlabel">Current Password:</label>
                <input class="form-control py-4" type="Password" name="currentpass" id="currentpass" type="input" required/>
            </div>            
            <div class="form-group">
                <label class="small mb-1" for="newpass">New Password:</label>
                <input class="form-control py-4" type="Password" name="newpass" id="newpass" type="input" required/>
            </div>
            <div class="form-group">
                <label class="small mb-1" for="confirmnewpass">Confirm New Password:</label>
                <input class="form-control py-4" type="Password" name="confirmnewpass" id="confirmnewpass" type="input" required/>
            </div>
            <label class="small mb-1" id="errorlabel" style="visibility: hidden; color:red;"></label>
        
          </div>
          <div class="modal-footer">
            <button type="submit" style="visibility: hidden;" id="savepass1" name="savepass1" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="savepass" name="savepass" class="btn btn-primary" onclick="savepassword()">Save changes</button>

          </div>
      </form>
    </div>
  </div>
</div>


<nav class="sb-topnav navbar navbar-expand navbar-dark" style="padding-left: 0.5rem; color: blue; background-color: #621299; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            
            <button class="btn" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- <label class="navbar-brand" href="index.php" style="font-size: 16px; padding-left: 0.2rem;  ">Workforce Management System |
            <label style="color:yellow; font-size: 10px; padding-top: 1.2rem; ">Today: Week <?php echo date('W')?></label></label>-->

            <label class="navbar-brand" href="index.php" style="font-size: 16px; padding-left: 0.2rem; color:white; ">Today: Week <?php echo date('W'),", " ,date('l')?></label>
            
                <!-- <label style="color:yellow; font-size: 8px"> Today: Week <?php echo date('W'),", " ,date('l')?></label></a>-->
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>




                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <!--<a class="dropdown-item" href="#">Account Settings</a>-->
                        <button type="button" id="btnaccount" name="btnaccount" class="dropdown-item" data-toggle="modal" data-target="#accountsettings">Change Password</button>
                        <div class="dropdown-divider"></div>
                        <form method="POST">
                        <button type="submit" id="logout" name="logout" class="dropdown-item">Logout</button>
                        </form>
                    </div>

                    
                    

                </li>
            </ul>
</nav>
<script>
    function savepassword()
    {
        //document.getElementById("currentlabel").innerHTML = "xoxo";
        if(document.getElementById("savedpassword").value != document.getElementById("currentpass").value)
        {
            document.getElementById("errorlabel").innerHTML = "Incorrect password.";
            document.getElementById("errorlabel").style.visibility = "visible"; 
        }
        else if(document.getElementById("newpass").value != document.getElementById("confirmnewpass").value)
        {
            document.getElementById("errorlabel").innerHTML = "New password and confirm new password does not match.";
            document.getElementById("errorlabel").style.visibility = "visible"; 
        }
        else
        {
            document.getElementById("errorlabel").style.visibility = "hidden"; 
            document.getElementById("savepass1").click();
        }
    }

</script>