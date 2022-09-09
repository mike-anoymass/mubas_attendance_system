<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "statistics") {
        $view = new StudentsView();

        $allStudentsNo = $certifiedStudentsNo = $uncertifiedStudentsNo = 0;

        $allStudents = $view->getAllStudents();
        $certifiedStudents = $view->getCertifiedStudents();
        $uncertifiedStudents = $view->getUncertifiedStudents();

        if($allStudents !== 0 ){
            $allStudentsNo = count($allStudents);
        }else{
            $allStudentsNo = $allStudents;
        }

        if($certifiedStudents !== 0 ){
            $certifiedStudentsNo = count($certifiedStudents);
        }else{
            $certifiedStudentsNo = $certifiedStudents;
        }

        if($uncertifiedStudents !== 0 ){
            $uncertifiedStudentsNo = count($uncertifiedStudents);
        }else{
            $uncertifiedStudentsNo = $uncertifiedStudents;
        }

        echo json_encode([$allStudentsNo, $certifiedStudentsNo, $uncertifiedStudentsNo]);

    }

?>