<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "statistics") {
        $view = new LecturersAndCoursesView();

        $data = $view->countAllocations();

        echo json_encode([$data]);

    }












?>