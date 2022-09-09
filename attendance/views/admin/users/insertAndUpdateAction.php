<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "create") {
        insertUser();
    }

    //handle update button click
    if (isset($_POST['action']) && $_POST['action'] == "update") {
        updateUser();
    }

    function insertUser()
    {
        global $firstName, $lastName, $username, $phone, $email, $gender, $passwd, $tOS;
        global $userController;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();


        $results = $userController->setUser($firstName, $lastName, $username, $phone, $email, $gender, $passwd, $tOS);
        if($results === "User Added SuccessFully") {
            echo '<div class="alert alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }





    }


    function updateUser()
    {
        global $firstName, $lastName, $username, $phone, $email, $gender, $passwd, $tOS;
        global $userController;

        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        $results = $userController->editUser($firstName, $lastName, $username, $phone, $email, $gender, $passwd, $tOS);

        echo '<div class="alert alert-success alert-dismissible">
                            <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                            User updated Successfully
                       </div>';
    }

    function initializeVars(){
        global $firstName, $lastName, $username, $phone, $email, $gender, $passwd,$tOS;

        //this objects will be used to insert and update user data
        global $userController;
        $userController = new UsersController();

        //These literal variables wll be used get data from the insert and update form
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $passwd = $_POST['passwd1'];
        $tOS = $_POST['typeOfUser'];


    }


?>
