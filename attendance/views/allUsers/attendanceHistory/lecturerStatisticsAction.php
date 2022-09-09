<?php
    require_once "classAutoload.php";
    Session::start();
    if (isset($_POST['action']) && $_POST['action'] == "statistics") {
        $view = new AttendanceView();

        $total = $view->countAttendancesForThisLecturer(Session::get("historyVars", "lecturerID"));
        $present = $view->countPresenceForThisLecturer(Session::get("historyVars", "lecturerID"));
        $absent = $view->countAbsenceForThisLecturer(Session::get("historyVars", "lecturerID"));

        echo json_encode([$total, $present, $absent]);

    }

?>