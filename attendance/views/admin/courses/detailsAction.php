<?php
    require_once "classAutoload.php";

    //get student ID and retrieve all info about the student
    if (isset($_POST['infoBtnID'])) {
        $id = $_POST['infoBtnID'];

        getInfoForThisStudent($id);
    }

    //get User Details to be filled in the Form
    if (isset($_POST['editBtnID'])){
        $id = $_POST['editBtnID'];
        getInfoForThisUser($id);
    }

    function getInfoForThisUser($id){
        $userView = new UsersView();

        $resultsForUserDetails = $userView->getUser($id);

        //sending User details  to the User Interface
        echo json_encode([$resultsForUserDetails]);
    }

?>
