<?php
session_start();
//echo date("N");

//$week_number = date("W");
//$year = date("Y");
//for($day=0; $day<=7; $day++)
//{
//    echo date('m/d/Y', strtotime($year."W".$week_number.$day))."\n";
//}

$_SESSION['currentdayval'] = '';


$_SESSION['thisweeknumber'] = date("W");
$_SESSION['thisyearnumber'] = date("Y");

if(isset($_SESSION['varname']) && !empty($_SESSION['varname'])) {
       echo '<script>window.location.href="index.php"</script>';
    }
else
{
        $_SESSION['varname'] = '';
        $_SESSION['vartype'] = '';
        $_SESSION['fullname'] = '';
        $_SESSION['accpass'] = '';
}

//echo '<script>alert("'.$_SESSION['varname'].'")</script>';

include('login_config.php');
include('echomessage.php');
    if(isset($_POST['login']))
    {

        $idnumber = $_POST['idnumber'];
        $accpass = $_POST['accpass'];

        $sql = "SELECT * FROM account WHERE idnumber = '$idnumber' and accpass = '$accpass' LIMIT 1";

        $result = mysqli_query($dbh,$sql);
        $row = $result -> fetch_assoc();

        if(mysqli_num_rows($result) and $row['issupervisor'] == 1)
        {
            $_SESSION['varname'] = $_POST['idnumber'];
            $_SESSION['vartype'] = 'supervisor';
            $_SESSION['fullname'] = $row['fname'].' '.$row['lname'];
            $_SESSION['accpass'] = $row['accpass'];
            echo '<script>window.location.href="index.php"</script>';
        }
        else if(mysqli_num_rows($result) and $row['issupervisor'] == 2)
        {
            $_SESSION['varname'] = $_POST['idnumber'];
            $_SESSION['vartype'] = 'admin';
            $_SESSION['accpass'] = $row['accpass'];

            echo '<script>window.location.href="index.php"</script>';
        }
        else
        {
            echo '<script>alert("incorrect username or password")</script>';
            //$message = "incorrect username or password";
            
        }
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
        <title>Login Page</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="" style="background-color: #621299;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <br><br><br><br><br><br><br>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-group">
                                                <label class="small mb-1" for="idnumber">ID Number</label>
                                                <input class="form-control py-4" id="idnumber" type="input" name="idnumber" placeholder="Enter ID Number" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="accpass">Password</label>
                                                <input class="form-control py-4" id="accpass" type="password" name="accpass" placeholder="Enter password" required/>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <style>
                                                .btn-primary {
                                                  color: #fff;
                                                  background-color: #621299;
                                                  border-color: #621299;
                                                }
                                                .btn-primary:hover {
                                                  color: #621299;
                                                  background-color: #ebb1ff;
                                                  border-color: #ebb1ff;
                                                }
                                                .btn-primary:focus, .btn-primary.focus {
                                                  color: #621299;
                                                  background-color: #ebb1ff;
                                                  border-color: #ebb1ff;
                                                  box-shadow: 0 0 0 0.2rem rgba(98,18,153, 0.5);
                                                }
                                                .btn-primary.disabled, .btn-primary:disabled {
                                                  color: #621299;
                                                  background-color: #621299;
                                                  border-color: #ebb1ff;
                                                }
                                                .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
                                                  color: #621299;
                                                  background-color: #ebb1ff;
                                                  border-color: #ebb1ff;
                                                }
                                                .btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus, .show > .btn-primary.dropdown-toggle:focus {
                                                  box-shadow: 0 0 0 0.2rem rgba(98,18,153, 0.5);
                                                }
                                            </style>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" id="submit" name="login" class="btn btn-primary btn-block" >Login</button>
                                                <!-- onclick="clickanotherbutton()" -->
                                                <button type="button" style="display: none" id="echomessagebutton" name="echomessage" class="dropdown-item" data-toggle="modal" data-target="#echomessage">Change Password</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </main>
            </div>
            
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="scripts.js"></script>
        <script>
            $(document).ready(function(){

            $("submit").click(function(){
            var idnumber = $("#idnumber").val();
            var accpass = $("#accpass").val();


            $.ajax({
               url:'login.php',
               type:'post',
               data:{idnumber:idnumber,accpass:accpass},
               success:function(response){
                  location.reload(); // reloading page
               }
            });

            });
            });


            function clickanotherbutton(){
                document.getElementById("echomessagebutton").click();
            }
        </script>
    </body>
</html>
