<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "statistics") {
        $view = new StudentsView();

        $viewL = new LecturersView();

        $data = $viewL->countLecturers();

        $allStudentsNo = 0;

        $allStudents = $view->getAllStudents();

        if($allStudents !== 0 ){
            $allStudentsNo = count($allStudents);
        }else{
            $allStudentsNo = $allStudents;
        }

        echo json_encode([$allStudentsNo, $data]);

    }

?>