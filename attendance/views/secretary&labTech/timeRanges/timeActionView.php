<?php

require_once "classAutoload.php";

if (isset($_POST['action']) && $_POST['action'] === "view") {
    $output = '';
    $view = new TimeAndDaysView();
    $data = $view->getTimeRanges();

    if ($data !== "Time Ranges not found") {
        $output .= '
                        <table class="table table-sm table-bordered table-hover" 
                        id="timesTable" >
                        <thead style="background-color: #93a1a1">
                            <tr class="text-center">
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
            
                        <tbody>';

        foreach ($data as $row) {
            $output .= '
                            <tr class="text-secondary">
                                <td>'.$row['startTime'].'</td>
                                 <td>'.$row['endTime'].'</td>
                               <td>
                                    <a href="#" title="Delete" 
                                    class="text-danger delTimeBtn" id="'.$row['id'].' ">
                                        <i class="fa fa-trash fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                            ';
        }

        $output .= '</tbody></table>';
        echo $output;

    } else {
        echo '<h3 class="text-center text-secondary mt-5">:
                            No any Hours in the database
                        </h3>';
    }
}
?>