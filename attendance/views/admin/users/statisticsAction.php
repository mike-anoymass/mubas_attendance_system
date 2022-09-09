<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] == "statistics") {
        $view = new UsersView();

        $data = $view->countUsers();

        echo json_encode([$data]);

    }












?>