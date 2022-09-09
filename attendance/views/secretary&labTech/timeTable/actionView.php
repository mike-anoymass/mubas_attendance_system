<?php

require_once "classAutoload.php";

if (isset($_POST['action']) && $_POST['action'] === "view") {
    $output = '';
    $timeAndDateView = new TimeAndDaysView();
    $timeData = $timeAndDateView->getTimeRanges();
    $dayData = $timeAndDateView->getDays();

    $output .= '    <table class="table table-bordered table-hover " id="allocationTable">
                           ';
    $output .= '<thead>  <tr class="text-secondary"> <td></td>';
    foreach ($timeData as $row) {
        $output .= '
                                <td>'.$row['startTime']."-" .$row['endTime'].'</td>
                             
                            ';
    }

    $output .= '</tr></thead>';

    $output .= '<tbody>';

    foreach ($dayData as $row) {
        $output .= '    <tr>
                                <td>'.$row['dayName'].'</td>
                            </tr>
                            ';
    }


    $output .= '<table> <br><br>';

    echo $output;

}
