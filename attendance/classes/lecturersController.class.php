<?php 
    class LecturersController extends Lecturers {

       public function setLecturer($id, $fName, $lName, $phone, $email, $gender)
       {
           return parent::setLecturer($id, $fName, $lName, $phone, $email, $gender); // TODO: Change the autogenerated stub
       }

       public function editLecturer($id, $fName, $lName, $phone, $email, $gender)
       {
           return parent::editLecturer($id, $fName, $lName, $phone, $email, $gender); // TODO: Change the autogenerated stub
       }

       public function deleteLecturer($id)
       {
           return parent::deleteLecturer($id); // TODO: Change the autogenerated stub
       }
    }
?>