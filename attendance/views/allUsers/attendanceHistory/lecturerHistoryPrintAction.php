<?php
    require_once "classAutoload.php";
    require_once __DIR__ . '../../../../vendor/autoload.php';
    Session::start();

    if(isset($_GET['print']) && $_GET['print'] == "pdf"){
        $mpdf = new \Mpdf\Mpdf();

        $output = '';
        $view = new AttendanceView();
        $data = $view->getAttendanceForThisLecturer(Session::get("historyVars", "lecturerID"));

        $lView = new LecturersView();
        $row = $lView->getLecturer(Session::get("historyVars", "lecturerID"));


        $user = Session::get("sessionVars", "firstName")
            . " " .Session::get("sessionVars", "lastName");

        $total = $view->countAttendancesForThisLecturer(Session::get("historyVars", "lecturerID"));
        $present = $view->countPresenceForThisLecturer(Session::get("historyVars", "lecturerID"));
        $absent = $view->countAbsenceForThisLecturer(Session::get("historyVars", "lecturerID"));
        $date = date('Y-m-d H:i:s');


        $output .= "
            <div class='row'>
                <img src='/attendance/public/img/city&guildsLogo.png' width='100px' height='90px' >
            
                <code class='pull-left'>CIT Weekend Classes Attendance System</code>
                  <hr>
                <code class='pull-right'>Attendance Report by $user on $date</code>
              
            </div>
            
            <br><br>
        
        ";


        $output .= "<div class='panel panel-default'>

                            <div class='panel-heading text-bold' style='background-color: dimgrey; color: white'>
                                Lecturer Details
                            </div>
                            <div class='panel-body'>

                                <table class='table table-sm table-bordered table-hover'>
                                    <thead>
                                    <tr>
                                        <th>Full Name: </th>
                                        <td>
                                            $row[firstname] $row[lastname]
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Gender: </th>
                                        <td>
                                         
                                             $row[gender]

                                          
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Phone Number:</th>
                                        <td>
                                         $row[phone]
                                        
                                        </td>
                                    </tr>

                                  
                                    </thead>
                                </table>



                            </div>
                        </div><br><br>";

        $output .= "<div class='panel panel-default'>

                            <div class='panel-heading text-bold' style='background-color: dimgrey; color: white'>
                                Attendance Summary
                            </div>
                            <div class='panel-body'>
                                <ul>
                                    <li>
                                        Total Classes => $total
                                    </li>
                                    
                                    <li>
                                        Present => $present
                                    </li>
                                    
                                    <li>
                                        Absent => $absent
                                    </li>
                                
                                </ul>
                            </div>
                                
                            </div><br>";



        if ($data !== 0) {
            $output .= '
                  
                      <div class="panel panel-default">

                            <div class="panel-heading text-bold" style="background-color: dimgrey; color: white">
                                Attendance History
                            </div>
                            <div class="panel-body">
                        <table class="table table-sm table-bordered table-hover" 
                        id="historyTable">
                        <thead style="background-color: #93a1a1">
                            <tr class="text-center">
                                <th>Course</th>
                                <th></th>
                                <th></th>
                                <th>Program</th>
                                <th></th>
                                <th></th>
                                <th>Status</th> 
                                <th></th>
                                <th></th>
                                <th>Date</th>
                                                     
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
                                <td></td>
                                 <td></td>
                                <td>'.$rows['program'].'</td>
                                 <td></td>
                                  <td></td>
                                <td>'.$status.'</td>
                                 <td></td>
                                  <td></td>
                                <td>'.$rows['date'].'</td>
                                 
                            </tr>
                            ';
            }

            $output .= '</tbody></table></div></div>';

            //write to PDF
            $mpdf->WriteHTML($output);

            //output tp browser
            $mpdf->Output(Session::get("historyVars", "lecturerID")."_".$date.".pdf", "D");

        } else {
            echo '<h3 class="text-center text-secondary mt-5">:
                            Attendance History is Empty
                        </h3>';
        }

    }
