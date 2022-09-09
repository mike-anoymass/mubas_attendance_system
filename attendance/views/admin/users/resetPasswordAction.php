<?php
    require_once "classAutoload.php";

    //get student ID and delete
    if (isset($_POST['resetBtnID'])) {
        $id = $_POST['resetBtnID'];

        $userContr = new UsersController();

        $results = $userContr->resetPassword($id);

        echo '<div class="alert alert-danger alert-dismissible">
                                <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '.
                               $results
                           .'</div>';

    }

?>