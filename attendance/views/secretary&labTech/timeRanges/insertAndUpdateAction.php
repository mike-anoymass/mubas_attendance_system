<?php
    require_once "classAutoload.php";


    if (isset($_POST['action']) && $_POST['action'] == "createDay") {
        insertDay();
    }

    //handle update button click
    if (isset($_POST['action']) && $_POST['action'] == "createTime") {
        insertTime();
    }

    function insertTime()
    {
        global $startTime, $finishTime;

        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars1();

        global $controller;


        $results = $controller->setTime($startTime, $finishTime);

        if($results === "Time Range Added SuccessFully") {
            echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }

    }


    function insertDay()
    {
        global $day;

        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $controller;


        $results = $controller->setDay($day);

        if($results === "Day Added SuccessFully") {
            echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }

    }

    function initializeVars(){
        global $day;

        //this objects will be used to insert and update user data
        global $controller;
        $controller = new TimeAndDaysController();

        //These literal variables wll be used get data from the insert and update form
        $day = $_POST['day'];
    }

    function initializeVars1(){
        global $startTime, $finishTime;

        //this objects will be used to insert and update user data
        global $controller;
        $controller = new TimeAndDaysController();

        //These literal variables wll be used get data from the insert and update form

        $startTime = $_POST['startTime'];
        $finishTime = $_POST['finishTime'];

    }



?>
