<?php
    require_once "classAutoload.php";

    Session::start();

    if(isset($_POST['programID'], $_POST['programName'])){
        $programID = $_POST['programID'];
        $programName = $_POST['programName'];

        Session::set("programVars", array(
            "programID" => $programID,
            "programName" => $programName
        ));

        echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        You have successfully Selected '.$programName.'<br> Loading Courses ... Please wait</div>';
    }
