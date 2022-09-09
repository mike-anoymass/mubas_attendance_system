<?php
    require_once "classAutoload.php";

    //get student ID and retrieve all info about the student
    if (isset($_POST['infoBtnID'])) {
        $id = $_POST['infoBtnID'];

        getStudent($id);
    }else{
        echo "nothing";
    }

    function getStudent($id){
        $view = new StudentsView();

        $results = $view->getInfoForThisStudent($id);

        //sending Student details  to the User Interface
        echo json_encode([$results]);
    }

?>
