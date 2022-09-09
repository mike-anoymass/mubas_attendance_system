<?php
    require_once "classAutoload.php";
    Session::start();
    if (isset($_POST['action']) && $_POST['action'] == "statistics") {
        $view = new AttendanceView();

        $total = $view->countAttendancesForThisStudent(Session::get("historyVars", "studentID"));
        $present = $view->countPresenceForThisStudent(Session::get("historyVars", "studentID"));
        $absent = $view->countAbsenceForThisStudent(Session::get("historyVars", "studentID"));

        echo json_encode([$total, $present, $absent]);

    }

?>