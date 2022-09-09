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
                            <h3 align="center">All Students</h3>
                           <table class="table table-bordered table-hover " id="allStudentsTable">
                           <thead > 
                                <tr style="background-color: lightgrey">
                                   <th>Student ID</th>
                                   <th>First Name</th>
                                   <th>LastName</th>
                                   <th>Program</th>
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

if (isset($_POST['action'], $_POST['value']) && $_POST['action'] === "viewUncertifiedStudents") {
    $output = '';
    $view = new StudentsView();
    $data = null;
    $intake = $_POST['value'];

    if($intake === "none"){
        $data = $view->getUncertifiedStudents();
    }else{
        $data = $view->getUncertifiedStudentsForThisIntake($intake);
    }

    if($data !== 0){
        $output .= '    
                            
                            <h3 align="center">Uncollected certificates</h3>
                            <form name="formStudent" method="post" id="formStudent">
                            <div>
                                <input class="btn btn-success" type="submit" 
                                name="certify" value="Issue Certificate(s)" id="certify">
                                
                                <input class="btn btn-danger" type="submit" 
                                name="delete" value="Delete" id="delete">
                            </div>
                            <br>
                            
                           <table class="table table-hover table-bordered" id="uncertifiedStudentsTable"
                           style="background-color: lightgrey">
                           <thead > 
                                <tr style="background-color: dimgrey; color: white">
                                    <th style="text-align: center">Tick All &nbsp<input
                                    type="checkbox" id="checkAll"></th>
                               
                                   <th>First Name</th>
                                   <th>LastName</th>
                                   <th>Program</th>
                                   
                                </tr>
                            </thead> ';

        foreach ($data as $row) {

            $output .= '<body>';
            $output .= '
                           <tr class="text-secondary">
                                 <td align="center" >
                                   <input
                                    type="checkbox" class="students" name="students" value="'.$row['id'].'">
                                </td>
                                <td>'.$row['firstname'].'</td>
                                <td>'.$row['lastname'].'</td>
                                <td>'.$row['programID'].'</td>
                                
                            </tr>
                            ';
        }

        $output .= '
                    </body><table> </form>
                    
                    <br><br>';

        echo $output;
    }else {
        echo '<h3 class="text-center text-secondary mt-5">:
                            All certificate have been collected <br> Or There are No any Students For this Intake
                        </h3>';
    }
}


if (isset($_POST['action'], $_POST['value']) && $_POST['action'] === "viewCertifiedStudents") {
    $output = '';
    $view = new StudentsView();
    $intake = $_POST['value'];

    if($intake === "none"){
        $data = $view->getCertifiedStudents();

    }else{
        $data = $view->getCertifiedStudentsForThisIntake($intake);
    }

    if($data !== 0){
        $output .= '    
                            
                            <h3 align="center">Collected certificates</h3>
                            <form method="post" >
                            <div>
                                <input class="btn btn-success" type="submit" 
                                name="unCertify" value="Remove Certification(s)" id="unCertify">     
                            </div>
                            <br>
                            
                           <table class="table table-hover table-bordered" id="certifiedStudentsTable">
                           <thead > 
                                <tr style="background-color: dimgrey; color: white">
                                   <th style="text-align: center">Tick All &nbsp<input
                                        type="checkbox" id="checkAllStudents">
                                    </th>
                                   <th>First Name</th>
                                   <th>LastName</th>
                                   <th>Program</th>
                                   <th style="text-align: center">Actions</th>
                                </tr>
                            </thead> ';

        foreach ($data as $row) {

            $output .= '<body>';
            $output .= '
                           <tr class="text-secondary">
                                <td  align="center">
                                   <input
                                    type="checkbox" class="uncertifiedStudents" name="uncertifiedStudents"
                                     value="'.$row['student'].'">
                                </td>
                                <td>'.$row['firstname'].'</td>
                                <td>'.$row['lastname'].'</td>
                                <td>'.$row['programID'].'</td>
                                   
                                <td align="center">
                                 <a href="#" title="Full Details" class="infoBtnii" 
                                    data-toggle="modal" data-target="#studentFullDetails" id="'.$row['student'].'">
                                        <i class="fa fa-info-circle fa-lg"></i>
                                    </a>&nbsp
                                    
                                </td>
                               
                            </tr>
                            ';
        }

        $output .= '
                    </body><table> </form>
                    
                    <br><br>';

        echo $output;
    }else {
        echo '<h3 class="text-center text-secondary mt-5">:
                            No any certificates have been collected <br> Or There are No any Students For this Intake
                        </h3>';
    }



}
