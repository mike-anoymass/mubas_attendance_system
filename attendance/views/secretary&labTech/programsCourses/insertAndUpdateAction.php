<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "create") {
        insertAllocation();
    }

    //handle update button click
    if (isset($_POST['action']) && $_POST['action'] == "update") {
        updateAllocations();
    }

    function insertAllocation()
    {
        global $program, $course, $unitCode;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $allocationController;

        $results = $allocationController->setAllocation($program, $course, $unitCode);
        if($results === "Allocation Added SuccessFully") {
            echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }

    }


    function updateAllocation()
    {
        global $id, $name;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $programController;

        $results = $programController->editProgram($id, $name);

        echo '<div class="alert alert-success alert-dismissible">
                            <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                           '. $results.
                       '</div>';
    }

    function initializeVars(){
        global $program, $course, $unitCode;

        //this objects will be used to insert and update user data
        global $allocationController;
        $allocationController = new CoursesAndProgramsController();

        //These literal variables wll be used get data from the insert and update form
        $program = $_POST['program'];
        $course = $_POST['course'];
        $unitCode = $_POST['unitCode'];

    }


?>
