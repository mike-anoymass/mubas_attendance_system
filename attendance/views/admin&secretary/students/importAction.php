<?php
    require_once "classAutoload.php";

    if(!empty($_FILES['student_file']['name'])){
        $controller = new StudentsController();
        $results = "";
        $fileData = fopen($_FILES["student_file"]["tmp_name"], "r");
        fgetcsv($fileData);


        while($row = fgetcsv($fileData)){
            $results = $controller->setStudent($row[0], $row[1], $row[2], $row[3], $row[4]);
        }

        if($results === "Students data imported SuccessFully") {
            echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '<br> Loading data...</div>';
        }else{
            echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results . '</div>';
        }
    }else{
        echo "No file Selected";
    }


?>
