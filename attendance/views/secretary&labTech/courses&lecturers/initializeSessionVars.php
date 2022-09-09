<?php
    require_once "classAutoload.php";
    Session::start();

    //get program and course ID to delete
    if (isset($_POST['attendanceBtnID'])) {
        $id = $_POST['attendanceBtnID'];

        $courseAndLecturerIDPrgID = explode('~', $id);

        Session::set("attendanceVars", array(
            "courseID" => $courseAndLecturerIDPrgID[0],
            "lecturerID" => $courseAndLecturerIDPrgID[1],
            "programID" => $courseAndLecturerIDPrgID[2]
        ));

       echo '<div class="alert alert-info alert-dismissible">
                                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Please Wait...
                                    </div>';
    }

?>