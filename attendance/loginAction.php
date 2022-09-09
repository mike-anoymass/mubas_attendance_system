<?php
    require_once "classAutoload.php";

    Session::start();

    if(isset($_POST['action']) && $_POST['action']=="login"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userCredentials = new UsersView();

        $results = $userCredentials->checkCredentials($username, $password);

        if($results == "Invalid Login Credentials"){
            echo "<i class='fa fa-lg fa-warning'> &nbsp;". $results .", Failed to Login_> Enter Valid Credentials</i></p>";
        }else{
            Session::set("sessionVars", array(
                "username" => $results['username'],
                "firstName" => $results['firstname'],
                "lastName" => $results['lastname'],
                "typeOfUser" => $results['typeOfUser'],
                "dateRegistered" => $results['dateRegistered'],
                "password" => $results['password'],
            ));

        }
    }
