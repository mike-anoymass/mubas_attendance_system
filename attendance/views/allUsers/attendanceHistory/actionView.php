<?php

require_once "classAutoload.php";

if (isset($_POST['action'], $_POST['value']) && $_POST['action'] === "viewAllStudents") {
    $output = '';
    $view = new StudentsView();
    $intake = $_POST['value'];
    $data = null;

    if($intake === "none"){
        $data = $view->getAllStudents();
    }else{
        $data = $view->getAllStudentsForThisIntake($intake);
    }

    if($data !== 0){
        $output .= '    
                      
                           <table class="table table-bordered table-hover " id="allStudentsTable">
                           <thead > 
                                <tr style="background-color: lightgrey">
                                   <th>Student ID</th>
                                   <th>First Name</th>
                                   <th>LastName</th>
                                   <th>Program</th>
                                   <th class="text-center">Actions</th>
                                </tr>
                            </thead> ';

        foreach ($data as $row) {

            $output .= '<body>';
            $output .= '
                           <tr class="text-secondary">
                            
                                <td>'.$row['id'].'</td>
                                <td>'.$row['firstname'].'</td>
                                <td>'.$row['lastname'].'</td>
                                <td>'.$row['programID'].'</td>
                                 <td align="center"><a href="#" title="View Attendance History" 
                                    class="text-aqua historyStudBtn" id="'.$row['id'].'">
                                        <i class="fa fa-history fa-lg"></i>
                                    </a>
                                  </td>
                            </tr>
                            ';
        }

        $output .= '</body><table> <br><br>';

        echo $output;
    }else {
        echo '<h3 class="text-center text-secondary mt-5">:
                            No any Students in the database <br> Or There are No any Students For this Intake
                        </h3>';
    }
}

if (isset($_POST['action']) && $_POST['action'] === "viewLecturers") {
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
                                <th class="text-center">Actions</th>                         
                            </tr>
                        </thead>
            
                        <tbody>';

        foreach ($data as $rows) {
            $output .= '
                            <tr class="text-secondary">
                                <td>'.$rows['id'].'</td> 
                                <td>'.$rows['firstname'].'</td>
                                <td>'.$rows['lastname'].'</td>
                                 <td align="center"><a href="#" title="View Attendance History" 
                                    class="text-aqua historyLectBtn" id="'.$rows['id'].'">
                                        <i class="fa fa-history fa-lg"></i>
                                    </a>
                                  </td>
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
