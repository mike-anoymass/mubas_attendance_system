<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "statistics") {
        $view = new ProgramsView();

        $data = $view->countPrograms();

        echo json_encode([$data]);

    }












?>