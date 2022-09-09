<?php
    require_once "classAutoload.php";

    //get student ID and delete
    if (isset($_POST['action']) && $_POST['action'] == "delete") {
        $id = $_POST['programID'];

        $programContr = new ProgramsController();

        $results = $programContr->deleteProgram($id);

        echo '<div class="alert alert-danger alert-dismissible">
                                <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                                '.$results .' 
                           </div>';

    }

?>