<?php
    require_once "classAutoload.php";

    if(isset($_GET['export']) && $_GET['export'] == "excel"){
        $output = "";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=students.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $view = new StudentsView();

        $data = $view->getCertifiedStudents();

        if ($data !== 0) {
            $output .= '
                        <table class="table table-sm table-bordered table-hover" 
                        id="coursesTable" >
                        <thead style="background-color: #93a1a1">
                            <tr class="text-center">
                                <th>Student ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Program</th>
                                <th>Date of Certification</th>
                                <th>Certificate Issued By</th>
                            </tr>
                        </thead>
            
                        <tbody>';

            foreach ($data as $rows) {
                $output .= '
                            <tr class="text-secondary">
                                <td>'.$rows['student'].'</td>
                                <td>'.$rows['firstname'].'</td>
                                <td>'.$rows['lastname'].'</td>
                                <td>'.$rows['programID'].'</td>
                                <td>'.$rows['date'].'</td>
                                 <td>'.$rows['issuer'].'</td>
                            </tr>
                            ';
            }

            $output .= '</tbody></table>';
            echo $output;

        } else {
            echo '<h3 class="text-center text-secondary mt-5">:
                            No any Certified Students in the database
                        </h3>';
        }
    }


?>