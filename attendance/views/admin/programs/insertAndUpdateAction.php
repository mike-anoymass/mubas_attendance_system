<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "create") {
        insertProgram();
    }

    //handle update button click
    if (isset($_POST['action']) && $_POST['action'] == "update") {
        updateProgram();
    }

    function insertProgram()
    {
        global $id, $name, $tuition;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $programController;


        $results = $programController->setProgram($id, $name, $tuition);
        if($results === "Program Added SuccessFully") {
            echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }





    }


    function updateProgram()
    {
        global $id, $name, $tuition;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $programController;

        $results = $programController->editProgram($id, $name, $tuition);

        echo '<div class="alert alert-success alert-dismissible">
                            <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                           '. $results.
                       '</div>';
    }

    function initializeVars(){
        global $id, $name, $tuition;

        //this objects will be used to insert and update user data
        global $programController;
        $programController = new programsController();

        //These literal variables wll be used get data from the insert and update form
        $id = $_POST['programID'];
        $name = $_POST['programName'];
        $tuition = $_POST['tuition'];

    }


?>
