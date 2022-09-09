<?php
    require_once "classAutoload.php";
    Session::start();

    if (isset($_POST['historyLectBtnID'])) {
        $id = $_POST['historyLectBtnID'];

        Session::set("historyVars", array("lecturerID" => $id));

       echo '<div class="alert alert-info alert-dismissible">
                                    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Please Wait...
                                    </div>';
    }

    if (isset($_POST['attendanceBtnID'])) {
        $id = $_POST['attendanceBtnID'];

        Session::set("historyVars", array("studentID" => $id));

        echo '<div class="alert alert-info alert-dismissible">
                                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        Please Wait...
                                        </div>';
    }

?>