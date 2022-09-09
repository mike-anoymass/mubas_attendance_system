<?php
    require_once "classAutoload.php";

    Session::start();

    if(!empty($_POST["studentIDs"])){
        if(Session::get("sessionVars", "typeOfUser") === "Administrator"){
            $controller = new StudentsController();

            $rowCount = count($_POST["studentIDs"]);
            for($i=0; $i<$rowCount; $i++){
                $results = $controller->deleteStudent($_POST["studentIDs"][$i]);
            }

            echo '<div class="alert alert-sm alert-danger alert-dismissible">
                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . ': Loading data...</div>';
        }else{
            echo "<p class='alert alert-warning' style='width: 70%' >Failed to Delete Student(s), Access Denied </p>";
        }

    }else{

        echo '<div class="alert alert-danger alert-dismissible">
                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            No Student Select</div>';

    }


?>
