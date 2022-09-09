<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "create") {
        insertLecturer();
    }

    //handle update button click
    if (isset($_POST['action']) && $_POST['action'] == "update") {
        updateLecturer();
    }

    function insertLecturer()
    {
        global $lecturerID , $firstName, $lastName, $gender , $phone, $email;
        global $lecturerController;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();


        $results = $lecturerController->setLecturer($lecturerID, $firstName, $lastName, $phone,$email , $gender);
        if($results === "Lecturer Added SuccessFully") {
            echo '<div class="alert alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }





    }


    function updateLecturer()
    {
        global $lecturerID , $firstName, $lastName, $gender , $phone, $email;
        global $lecturerController;

        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        $results = $lecturerController->editLecturer($lecturerID, $firstName, $lastName, $phone,$email , $gender);

        echo '<div class="alert alert-success alert-dismissible">
                            <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                            '.$results.'
                       </div>';
    }

    function initializeVars(){
        global $lecturerID , $firstName, $lastName, $gender , $phone, $email;

        //this objects will be used to insert and update user data
        global $lecturerController;
        $lecturerController = new LecturersController();

        //These literal variables wll be used get data from the insert and update form
        $lecturerID = $_POST['lecturerID'];
        $firstName = $_POST['lecturerFname'];
        $lastName = $_POST['lecturerLname'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
    }

?>
