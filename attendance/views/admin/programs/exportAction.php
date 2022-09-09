<?php
    require_once "classAutoload.php";

    if(isset($_GET['export']) && $_GET['export'] == "excel"){
        $output = "";
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=programs.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $programView = new ProgramsView();
        $data = $programView->getAllPrograms();

        if ($data != "Programs not found") {
            $output .= '
                        <table class="table table-sm table-bordered table-hover" 
                        id="programsTable" >
                        <thead style="background-color: #93a1a1">
                            <tr class="text-center">
                                <th>Program ID</th>
                                <th>Program Name</th>
                                <th>Date Registered</th>
                            </tr>
                        </thead>
            
                        <tbody>';

            foreach ($data as $rows) {
                $output .= '
                            <tr class="text-secondary">
                                <td>'.$rows['id'].'</td>
                                <td>'.$rows['name'].'</td>
                                <td>'.$rows['dateRegistered'].'</td>
                            </tr>
                            ';
            }

            $output .= '</tbody></table>';
            echo $output;

        }
    }


?>