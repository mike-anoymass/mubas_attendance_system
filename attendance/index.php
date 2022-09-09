<?php

require_once "classAutoload.php";
Session::start();

if(Session::get("sessionVars")){
    //print_r( Session::get("sessionVars","typeOfUser")) ;

    if(Session::get("sessionVars","typeOfUser") === "Administrator" ){
        header("Location: views/admin/");
    }

    if(Session::get("sessionVars","typeOfUser") === "Secretary" ){
        header("Location: views/secretary&labTech/");
    }

    if(Session::get("sessionVars","typeOfUser") === "Technician" ){
        echo "Tech";
        header("Location: views/secretary&labTech/");
    }
}
?>

<?php
require_once "inc/header.php";
require_once "inc/scripts.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        html,body{
            height:99.7%;
        }

        .parent1{
            height:inherit;
            align-items:center;
            justify-content:center;
            margin-top: 5%;
        }

    </style>
</head>

<body style="background-color: #93a1a1">

<div class="container parent1">



    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">

                    <div class="row">
                        <div class="col-sm-2">
                            <img src="public/img/poly_log.png" height="50px" width="40px">
                        </div>

                        <div class="col-sm-9">
                            <h4 class="text-center text-capitalize">

                                <b>Welcome to The CIT Weekend Classes
                                    <br>Attendance System
                                </b>
                            </h4>
                        </div>

                        <div class="col-sm-1" >
                            <img src="public/img/city&guildsLogo.png" height="50px" width="40px">
                        </div>
                    </div>


                </div>

                <div class="panel-body">
                    <form class="form-horizontal" id="data" method="POST" action="">
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username"
                                       value="" required autofocus>
                                <span class="help-block">
                                            <strong></strong>
                                        </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <span class="help-block">
                                            <strong></strong>
                                        </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id="login">
                                    Login
                                </button>

                                <a class="btn btn-link forgot_password">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

    <script src="public/js/login.js"></script>
</body>

</html>