<?php
    require_once "classAutoload.php";

    //get Course ID and delete
    if (isset($_POST['action']) && $_POST['action'] == "delete") {
        $id = $_POST['courseID'];

        $courseContr = new CoursesController();

        $results = $courseContr->deleteCourse($id);

        echo '<div class="alert alert-danger alert-dismissible">
                                <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                                '.$results .' 
                           </div>';

    }

?>