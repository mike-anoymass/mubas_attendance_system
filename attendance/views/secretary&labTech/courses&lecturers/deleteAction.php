<?php
    require_once "classAutoload.php";

    //get program and course ID to delete
    if (isset($_POST['delBtnID'])) {
        $id = $_POST['delBtnID'];

        $courseAndLecturerID = explode('~', $id);

        $courseID = $courseAndLecturerID[0];
        $lecturerID = $courseAndLecturerID[1];
        $timeRange = $courseAndLecturerID[2];
        $day = $courseAndLecturerID[3];

       $allocationContr = new LecturersAndCoursesController();

       $results = $allocationContr->deleteAllocation($courseID, $lecturerID, $timeRange, $day);

       echo '<div class="alert alert-danger alert-dismissible">
                                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    '.$results.'
                                    </div>';
    }

?>