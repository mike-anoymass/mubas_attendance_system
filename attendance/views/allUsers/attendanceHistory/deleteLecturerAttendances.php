<?php
 require_once "classAutoload.php";
 Session::start();

 if(isset($_POST['action']) && $_POST['action']==="delete"){
     if(Session::get("sessionVars", "typeOfUser") === "Administrator"){
         $controller = new AttendanceController();
         $controller->deleteAttendanceForThisLecturer(Session::get("historyVars", "lecturerID"));
         echo "<p class='alert alert-danger' style='width: 70%' >Clearing History ...</p>";
     }else{
         echo "<p class='alert alert-warning' style='width: 70%' >Failed to Clear History, Access Denied </p>";
     }
 }
