<?php

    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] === "view") {
        $output = '';
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
                                <th>Tuition Fee</th>
                                <th>Date Registered</th>
                            </tr>
                        </thead>
            
                        <tbody>';

            foreach ($data as $rows) {
                $output .= '
                            <tr class="text-secondary">
                                <td>'.$rows['id'].'</td>
                                <td>'.$rows['name'].'</td>
                                <td>'.$rows['tuitionFee'].'</td>
                                <td>'.$rows['dateRegistered'].'</td>
                            </tr>
                            ';
            }

            $output .= '</tbody></table>';
            echo $output;

        } else {
            echo '<h3 class="text-center text-secondary mt-5">:
                            No any Programs in the database
                        </h3>';
        }
    }
?>