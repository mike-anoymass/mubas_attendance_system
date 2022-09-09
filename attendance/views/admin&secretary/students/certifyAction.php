<?php
    require_once "classAutoload.php";


    if(!empty($_POST["studentIDs"])){
        $controller = new StudentsController();

        $rowCount = count($_POST["studentIDs"]);
        for($i=0; $i<$rowCount; $i++){
            $results = $controller->certifyStudent($_POST["studentIDs"][$i]);
        }

        echo '<div class="alert alert-sm alert-success alert-dismissible">
                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
            $results . ': Loading data...</div>';

    }else{

        echo '<div class="alert alert-danger alert-dismissible">
                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            No Student Select</div>';

    }


?>
