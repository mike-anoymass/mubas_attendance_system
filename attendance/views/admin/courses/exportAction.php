<?php
    require_once "classAutoload.php";

    if(isset($_GET['export']) && $_GET['export'] == "excel"){
        $output = "";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=courses.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $courseView = new CoursesView();

        $data = $courseView->getAllCourses();

        if ($data !== "Courses not found") {
            $output .= '
                        <table class="table table-sm table-bordered table-hover" 
                        id="coursesTable" >
                        <thead style="background-color: #93a1a1">
                            <tr class="text-center">
                                <th>Course ID</th>
                                <th>Course Name</th>
                                <th>Credit</th>
                                 <th>Level</th>
                                  <th>Date Registered</th>
                            </tr>
                        </thead>
            
                        <tbody>';

            foreach ($data as $rows) {
                $output .= '
                            <tr class="text-secondary">
                                <td>'.$rows['id'].'</td>
                                <td>'.$rows['name'].'</td>
                                <td>'.$rows['credit'].'</td>
                                <td>'.$rows['level'].'</td>
                                <td>'.$rows['dateRegistered'].'</td>
                            </tr>
                            ';
            }

            $output .= '</tbody></table>';
            echo $output;

        } else {
            echo '<h3 class="text-center text-secondary mt-5">:
                            No any Courses in the database
                        </h3>';
        }
    }


?>