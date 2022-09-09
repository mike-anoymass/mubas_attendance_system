<?php

require_once "classAutoload.php";

if (isset($_POST['action']) && $_POST['action'] === "view") {
     $output = '';
    $allocationView = new CourseAllocationView();
    $data = $allocationView->getPrograms();
    $data2 = null;

    if ($data != "Allocations not found") {
        $output .= '<div id="allocationTable" >';

            foreach ($data as $rows) {

                $data2 = $allocationView->getCoursesForThisProgram($rows['id']);

                createCourseTable($rows['name'], $rows['id']);

            }

        $output .= '</div>';
        echo $output;

    } else {
        echo '<h3 class="text-center text-secondary mt-5">:
                            No any Allocations in the database
                        </h3>';
    }

}

function createCourseTable($programName, $programID){
    global $data2, $output;

    $output .= '    
                           <table class="table table-bordered table-hover ">
                           <thead > 
                                <tr>
                                    <h4 style="background-color: lightcyan; color:dimgrey" class="text-center text-bold">
                                    '.$programName.' Has The Following Course(s)
                                    </h4>
                                </tr>
                                <tr style="background-color: lightgrey">
                                    <th>Course Name</th>
                                    <th>Unit Code</th   >
                                    <th>Date of Allocation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead> ';
    foreach ($data2 as $row) {

        $output .= '<body>';
        $output .= '
                           <tr class="text-secondary">
                            
                                <td>'.$row['name'].'</td>
                                <td>'.$row['unitCode'].'</td>
                                <td>'.$row['dateRegistered'].'</td>
                                <td>
                                    <a href="#" title="Delete" 
                                    class="text-danger delBtn" id="'.$row['id'].'~'.$programID.' ">
                                        <i class="fa fa-trash fa-lg"></i>
                                    </a>
                                </td>
               
                            </tr>
                            ';
    }

    $output .= '</body><table> <br><br>';

}
?>