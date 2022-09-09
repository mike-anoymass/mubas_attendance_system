<?php

require_once "classAutoload.php";

Session::start();

if (isset($_POST['action']) && $_POST['action'] === "view") {
    $output = '';
    $view = new AttendanceView();
    $data = $view->getAttendanceForThisLecturer(Session::get("historyVars", "lecturerID"));

    if ($data !== 0) {
        $output .= '
                       <button id="deleteBtn" class="btn btn-danger">
                            Clear History
                      </button>
                      <br>
                       <br>
                        <table class="table table-sm table-bordered table-hover" 
                        id="historyTable">
                        <thead style="background-color: #93a1a1">
                            <tr class="text-center">
                                <th>Course</th>
                                <th>Program</th>
                                <th>Status</th> 
                                <th>Date</th>
                                <th class="text-center">Actions</th>                         
                            </tr>
                        </thead>
            
                        <tbody>';

        foreach ($data as $rows) {

            $status = "";
            if($rows["attended"] ===  "1"){
                $status = "present";
            }else{
                $status = "absent";
            }

            $output .= '
                            <tr class="text-secondary">
                                <td>'.$rows['course'].'</td> 
                                <td>'.$rows['program'].'</td>
                                <td>'.$status.'</td>
                                <td>'.$rows['date'].'</td>
                                 <td align="center"><a href="#" title="View More Details" 
                                  data-toggle="modal" data-target="#historyDetails"
                                    class="text-aqua infoBtn" id="'.$rows['lecturerID']."~".$rows['course'].'">
                                        <i class="fa fa-info fa-lg"></i>
                                    </a>
                                  </td>
                            </tr>
                            ';
        }

        $output .= '</tbody></table>';
        echo $output;

    } else {
        echo '<h3 class="text-center text-secondary mt-5">:
                            Attendance History is Empty
                        </h3>';
    }
}
