<?php
    require_once "classAutoload.php";

    Session::start();

    if(isset($_POST['action']) && $_POST['action'] === "changePassword"){
        $username = Session::get("sessionVars", "username");

        $password = $_POST['newPassword'];

        $userContr = new usersController();

        $results = $userContr->updatePassword($username, $password);

        Session::set("sessionVars", array(
            "username" => Session::get("sessionVars", "username"),
            "firstName" => Session::get("sessionVars", "firstName"),
            "lastName" => Session::get("sessionVars", "lastName"),
            "typeOfUser" => Session::get("sessionVars", "typeOfUser"),
            "dateRegistered" => Session::get("sessionVars", "dateRegistered"),
            "password" => $_POST['newPassword']
        ));

        echo $results;

    }
