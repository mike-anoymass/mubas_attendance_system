<?php

require_once "classAutoload.php";

if (isset($_POST['action']) && $_POST['action'] === "view") {
     $output = '';
    $allocationView = new LecturersAndCoursesView();
    $data = $allocationView->getLecturers();
    $data2 = null;

    if ($data != "Allocations not found") {
        $output .= '<div id="allocationTable" >';

            foreach ($data as $rows) {

                $data2 = $allocationView->getCoursesForThisLecturer($rows['id']);
                createCourseTable($rows['firstname']." ".$rows['lastname'], $rows['id']);

            }

        $output .= '</div>';
        echo $output;

    } else {
        echo '<h3 class="text-center text-secondary mt-5">:
                            No any Allocations in the database
                        </h3>';
    }



}

function createCourseTable($fullName, $lecturerID){
    global $data2, $output;

    $output .= '    
                           <table class="table table-bordered table-hover ">
                           <thead > 
                                <tr>
                                    <h4 style="background-color: lightcyan;color:dimgrey" class="text-center text-bold">
                                    '.$fullName.' Teaches the Following Courses
                                    </h4>
                                </tr>
                                <tr style="background-color: lightgrey">
                                    <th>Course Name</th>
                                    <th>Program</th>
                                    <th>On</th >
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Room</th>
                                    <th>Date of Allocation</th>
                                     <th>Actions</th>
                                </tr>
                            </thead> ';

    foreach ($data2 as $row) {

        $output .= '<body>';
        $output .= '
                           <tr class="text-secondary">
                            
                                <td>'.$row['name'].'</td>
                                 <td>'.$row['programID'].'</td>
                                <td>'.$row['dayOfWeek'].'</td>
                                <td>'.$row['startTime'].'</td>
                                <td>'.$row['endTime'].'</td>
                                <td>'.$row['room'].'</td>
                                <td>'.$row['dateRegistered'].'</td>
                                <td>
                                    <a href="#" title="Delete" 
                                    class="text-danger delBtn" id="'.$row['courseID'].'~'.$lecturerID.'~'
                                    .$row['tID'].'~'.$row['dID'].'">
                                        <i class="fa fa-trash fa-lg"></i>
                                    </a>&nbsp;
                                    
                                     <a href="#" title="Record Attendance" 
                                    class="text-aqua attendanceBtn" id="'.$row['courseID'].'~'.
                                            $lecturerID.'~'.$row['programID'].'">
                                        <i class="fa fa-table fa-lg"></i>
                                    </a>
                                </td>
               
                            </tr>
                            ';
    }

    $output .= '</body><table> <br><br>';

}
?>