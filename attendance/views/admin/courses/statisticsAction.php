<?php
    require_once "classAutoload.php";

    if (isset($_POST['action']) && $_POST['action'] === "statistics") {
        $view = new CoursesView();

        $data = $view->countCourses();

        echo json_encode([$data]);

    }












?>