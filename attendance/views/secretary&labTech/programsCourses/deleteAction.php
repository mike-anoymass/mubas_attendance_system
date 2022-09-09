<?php
    require_once "classAutoload.php";

    //get program and course ID to delete
    if (isset($_POST['delBtnID'])) {
        $id = $_POST['delBtnID'];

        $courseAndProgramID = explode('~', $id);

        $courseID = $courseAndProgramID[0];
        $programID = $courseAndProgramID[1];

       $allocationContr = new CoursesAndProgramsController();

       $results = $allocationContr->deleteAllocation($courseID, $programID);

       echo '<div class="alert alert-danger alert-dismissible">
                                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    '.$results.'
                                    </div>';
    }

?>