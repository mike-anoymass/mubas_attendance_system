<?php
    require_once "classAutoload.php";

    Session::start();

    if(checkCurrentDate()){
        if(isset($_POST["presentLecturer"])){
            $controller = new AttendanceController();

            $rowCount = count($_POST["presentLecturer"]);
            for($i=0; $i<$rowCount; $i++){
                $results1 = $controller->setLecturerAttendance(
                    $_POST["presentLecturer"][$i],
                    Session::get("attendanceVars", "courseID"),
                    1
                );
            }

            echo '<div class="alert alert-sm alert-success alert-dismissible">
                            <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results1. '</div>';

        }

        if(isset($_POST["absentLecturer"])){
            $controller1 = new AttendanceController();

            $rowCount = count($_POST["absentLecturer"]);
            for($i=0; $i<$rowCount; $i++){
                $results = $controller1->setLecturerAttendance(
                    $_POST["absentLecturer"][$i],
                    Session::get("attendanceVars", "courseID"),
                    0
                );
            }

            echo '<div class="alert alert-sm alert-success alert-dismissible">
                                <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results .'</div>';

        }

        if(isset($_POST["presentStudents"])){
            $controller = new AttendanceController();

            $rowCount = count($_POST["presentStudents"]);
            for($i=0; $i<$rowCount; $i++){
                $results1 = $controller->setStudentAttendance(
                    $_POST["presentStudents"][$i],
                    Session::get("attendanceVars", "courseID"),
                    1
                );
            }

            echo '<div class="alert alert-sm alert-success alert-dismissible">
                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results1. '</div>';

        }

        if(isset($_POST["absentStudents"])){
            $controller1 = new AttendanceController();

            $rowCount = count($_POST["absentStudents"]);
            for($i=0; $i<$rowCount; $i++){
                $results = $controller1->setStudentAttendance(
                    $_POST["absentStudents"][$i],
                    Session::get("attendanceVars", "courseID"),
                    0
                );
            }

            echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                $results .'</div>';

        }
    }else{
        echo '<div class="alert alert-sm alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             Attendance for this class has already been recorded today on '.date('Y-m-d').'</div>';
    }

    function checkCurrentDate(){
        $view = new AttendanceView();
        $rows = $view->getLecturerAttendances();

        if($rows !== 0){
            foreach($rows as $row){
                if(($row['lecturerID'] === Session::get("attendanceVars", "lecturerID"))
                    && $row['courseID'] === Session::get("attendanceVars", "courseID")
                    && $row['dateRegistered'] === date('Y-m-d')) {
                    return false;
                }
            }
        }


        return true;

    }






?>
