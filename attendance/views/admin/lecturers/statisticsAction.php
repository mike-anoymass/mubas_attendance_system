<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "statistics") {
        $view = new LecturersView();

        $data = $view->countLecturers();

        echo json_encode([$data]);

    }












?>