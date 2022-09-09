<?php

    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] === "view") {
        $output = '';
        $lecturerView = new LecturersView();
        $data = $lecturerView->getAllLecturers();

        if ($data !== "Lecturers not found") {
            $output .= '
                        <table class="table table-sm table-bordered table-hover" 
                        id="lecturerTable">
                        <thead style="background-color: #93a1a1">
                            <tr class="text-center">
                                <th>Lecturer ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Email Address</th>
                                <th>Date Registered</th>  
                                                    
                            </tr>
                        </thead>
            
                        <tbody>';

            foreach ($data as $rows) {
                $output .= '
                            <tr class="text-secondary">
                                <td>'.$rows['id'].'</td> 
                                <td>'.$rows['firstname'].'</td>
                                <td>'.$rows['lastname'].'</td>
                                <td>'.$rows['gender'].'</td>
                                <td>'.$rows['phone'].'</td>
                                <td>'.$rows['email'].'</td>
                                <td>'.$rows['dateRegistered'].'</td>
                                
                            </tr>
                            ';
            }

            $output .= '</tbody></table>';
            echo $output;

        } else {
            echo '<h3 class="text-center text-secondary mt-5">:
                            No any Lecturers in the database
                        </h3>';
        }
    }
?>