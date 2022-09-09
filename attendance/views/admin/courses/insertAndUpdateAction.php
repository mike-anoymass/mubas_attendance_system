<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "create") {
        insertCourse();
    }

    //handle update button click
    if (isset($_POST['action']) && $_POST['action'] == "update") {
        updateCourse();
    }

    function insertCourse()
    {
        global $id, $name, $credit, $level;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $courseController;


        $results = $courseController->setCourse($id, $name, $level, $credit);
        if($results === "Course Added SuccessFully") {
            echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }


    }


    function updateCourse()
    {
        global $id, $name, $level , $credit;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $courseController;

        $results = $courseController->editCourse($id, $name, $level , $credit);

        echo '<div class="alert alert-success alert-dismissible">
                            <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                           '. $results.
                       '</div>';
    }

    function initializeVars(){
        global $id, $name, $credit, $level;

        //this objects will be used to insert and update user data
        global $courseController;
        $courseController = new CoursesController();

        //These literal variables wll be used get data from the insert and update form
        $id = $_POST['courseID'];
        $name = $_POST['courseName'];
        $credit = $_POST['credit'];
        $level = $_POST['level'];

    }


?>
