<?php

require_once "classAutoload.php";

Session::start();

if (isset($_POST['action'], $_POST['value']) && $_POST['action'] === "view") {
    $output = '';
    $view = new StudentsView();
    $intake = $_POST['value'];
    $data = null;

    if($intake === "none"){
        $data = $view->getStudentsForThisProgram(Session::get("attendanceVars", "programID"));
    }else{
        $data = $view->getStudentsForThisProgramAtThisIntake(Session::get("attendanceVars", "programID"),$intake);
    }

    if($data !== 0){

        $view = new LecturersView();
        $row = $view->getLecturer(Session::get("attendanceVars", "lecturerID"));
        $output .= '    
                            <form method="post" >
                            
                            <input class="btn btn-success" type="submit" 
                                    name="studentRegister" value="Register Attendance" id="studentRegister">     
                                    </div>
                                    <br> <br>
                            
                                    <div class="panel panel-default">
        
                                <div class="panel-heading text-bold">
                                    <h4 align="center">Lecturer</h4>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-hover ">
                                        <thead >
                                        <tr style="background-color: lightgrey">
                                            <th class="text-center">Check</th>
                                            <th>Lecturer ID</th>
                                            <th>First Name</th>
                                            <th>LastName</th>
                                       
                                        </tr>
                                        </thead>
                                        <tr>
                                             <td  align="center">
                                               <input
                                                type="checkbox" class="lecturerR" name="lecturerR"
                                                 value='.$row['id'].'>
                                            </td>
                                             
                                            <td>'.$row['id'].'</td>
                                            <td>'.$row['firstname'].'</td>
                                            <td>'.$row['lastname'].'</td>
                                        </tr>;
                                        
                                        <tbody>
        
                                        </tbody>
        
                                    </table>
                                </div>
                            </div>
                                    <br>
                                    
                            <div class="panel panel-default">
    
                                    <div class="panel-heading text-bold">
                                        <h4 align="center">Students of This Class</h4>
                                    </div>
                                    <div class="panel-body">
                                    <div>
                                    
                                   <table class="table table-bordered table-hover " id="studentsTable">
                                   <thead > 
                                        <tr style="background-color: lightgrey">
                                        <th style="text-align: center">Check All &nbsp<input
                                                type="checkbox" id="checkAll">
                                            </th>
                                           <th>Student ID</th>
                                           <th>First Name</th>
                                           <th>LastName</th>
                                           
                                        </tr>
                                    </thead> ';

                                foreach ($data as $row) {

                                    $output .= '<body>';
                                    $output .= '
                                                   <tr class="text-secondary">
                                                        <td  align="center">
                                                           <input
                                                            type="checkbox" class="studentR" name="students"
                                                             value="'.$row['id'].'">
                                                        </td>
                                                        <td>'.$row['id'].'</td>
                                                        <td>'.$row['firstname'].'</td>
                                                        <td>'.$row['lastname'].'</td>
                                                       
                                                    </tr>
                                                    ';
                                }

            $output .= '</body><table> </div>
                        </div>
    
                    </div></form><br><br>';

            echo $output;
    }else {
        echo '<h3 class="text-center text-secondary mt-5">:
                            No any Students in the database <br> Or There are No any Students For this Intake <br>
                            Or All students in this class graduated
                        </h3>';
    }


}
