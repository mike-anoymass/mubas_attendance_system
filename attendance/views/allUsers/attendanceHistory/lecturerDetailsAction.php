<?php
    require_once "classAutoload.php";

    if(isset($_POST['infoBtnID'])){
        $id = $_POST['infoBtnID'];

        $courseAndLecturerID = explode('~', $id);

        $courseID = $courseAndLecturerID[1];
        $lecturerID = $courseAndLecturerID[0];

        $view = new LecturersAndCoursesView();
        $rows = $view->getCourseForThisLecturer($lecturerID, $courseID);

        echo json_encode([$rows]);

    }

