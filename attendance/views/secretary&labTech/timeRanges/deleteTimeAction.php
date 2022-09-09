<?php
    require_once "classAutoload.php";

    //get program and course ID to delete
    if (isset($_POST['delBtnID'])) {
        $id = $_POST['delBtnID'];


       $contr = new TimeAndDaysController();

       $results = $contr->deleteTimeRange($id);

       echo '<div class="alert alert-danger alert-dismissible">
                                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    '.$results.'
                                    </div>';
    }

?>