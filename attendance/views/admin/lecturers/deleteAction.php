<?php
    require_once "classAutoload.php";
    //get Lecturer ID and delete
    if (isset($_POST['action']) && $_POST['action'] == "delete") {
        $id = $_POST['lecturerID'];

        $lecturerContr = new LecturersController();

        $results = $lecturerContr->deleteLecturer($id);

        echo '<div class="alert alert-danger alert-dismissible">
                                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                                    '.$results .' 
                               </div>';

    }

?>