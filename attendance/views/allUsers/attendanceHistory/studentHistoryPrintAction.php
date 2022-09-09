<?php
    require_once "classAutoload.php";
    require_once __DIR__ . '../../../../vendor/autoload.php';
    Session::start();

    if(isset($_GET['print']) && $_GET['print'] == "pdf"){
        $mpdf = new \Mpdf\Mpdf();

        $output = '';
        $view = new AttendanceView();
        $data = $view->getAttendanceForThisStudent(Session::get("historyVars", "studentID"));

        $lView = new StudentsView();
        $row = $lView->getDetailsForThisStudent(Session::get("historyVars", "studentID"));

        $user = Session::get("sessionVars", "firstName")
            . " " .Session::get("sessionVars", "lastName");
        $total = $view->countAttendancesForThisStudent(Session::get("historyVars", "studentID"));
        $present = $view->countPresenceForThisStudent(Session::get("historyVars", "studentID"));
        $absent = $view->countAbsenceForThisStudent(Session::get("historyVars", "studentID"));

        $date = date('Y-m-d H:i:s');

        $output .="
            <div class='row'>
                <img src='/attendance/public/img/city&guildsLogo.png' width='90px' height='65px' >
                <code class='pull-left'>CIT Weekend Classes Attendance System</code>
                  <hr>
                <code class='pull-right'>Attendance Report by $user on $date</code>
            </div>
            
            <br><br>
        
        ";


        $output .= "<div class='panel panel-default'>

                            <div class='panel-heading text-bold' style='background-color: dimgrey; color: white'>
                                Student Details
                            </div>
                            <div class='panel-body'>

                                <table class='table table-sm table-bordered table-hover'>
                                    <thead>
                                    <tr>
                                        <th>Student ID: </th>
                                        <td>
                                            $row[id]
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Full Name: </th>
                                        <td>
                                            $row[firstname] $row[lastname]
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Program: </th>
                                        <td>
                                         
                                             $row[program]

                                         
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Intake</th>
                                        <td>
                                         $row[start] - $row[end] $row[year]
                                        
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
            $mpdf->Output(Session::get("historyVars", "studentID")."_".$date.".pdf", "D");

        } else {
            echo '<h3 class="text-center text-secondary mt-5">:
                            Attendance History is Empty
                        </h3>';
        }

    }
