<?php
    class StudentsController extends Students {

       public function setStudent($id, $firstName, $lastName, $prg, $intake)
       {
           return parent::setStudent($id, $firstName, $lastName, $prg, $intake); // TODO: Change the autogenerated stub
       }

       public function certifyStudent($id)
       {
           return parent::certifyStudent($id); // TODO: Change the autogenerated stub
       }

       public function deleteStudent($id)
       {
           return parent::deleteStudent($id); // TODO: Change the autogenerated stub
       }

       public function uncertifyStudent($id)
       {
           return parent::uncertifyStudent($id); // TODO: Change the autogenerated stub
       }

    }
?>