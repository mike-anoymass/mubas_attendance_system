<?php
    require_once "classAutoload.php";

    if(isset($_GET['export']) && $_GET['export'] == "excel"){
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=courseAllocation.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

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
                           <table class="table table-bordered table-hover "
                           style="border-style: solid; border-width: 2px; border-color: #0b97c4">
                           <thead > 
                                <tr>
                                    <h4 style="background-color: lightcyan" class="text-center text-bold">
                                    '.$programName.' Has The Following Courses
                                    </h4>
                                </tr>
                                <tr style="background-color: lightgrey">
                                    <th>Course Name</th>
                                    <th>Unit Code</th   >
                                    <th>Date of Allocation</th>
                                </tr>
                            </thead> ';
    foreach ($data2 as $row) {

        $output .= '<body>';
        $output .= '
                           <tr class="text-secondary">
                            
                                <td>'.$row['name'].'</td>
                                <td>'.$row['unitCode'].'</td>
                                 <td>'.$row['dateRegistered'].'</td>
                            
                            </tr>
                            ';
    }

    $output .= '</body><table> <br><br>';

}
?>