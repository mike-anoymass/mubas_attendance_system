<?php 
    class UsersController extends Users{
        public function setUser($firstName, $lastName, $username, $phone, $email,$gender, $passwd, $tOS)
        {
            return parent::setUser($firstName, $lastName, $username, $phone, $email,$gender, $passwd, $tOS); // TODO: Change the autogenerated stub
        }

        public function editUser($username, $firstName, $lastName, $phone, $email, $gender, $passwd, $tOS)
        {
           return parent::editUser($username, $firstName, $lastName, $phone, $email, $gender, $passwd, $tOS); // TODO: Change the autogenerated stub
        }

        public function deleteUser($id)
        {
            parent::deleteUser($id); // TODO: Change the autogenerated stub
        }

        public function updatePassword($username, $passwd)
        {
            return parent::updatePassword($username, $passwd); // TODO: Change the autogenerated stub
        }

        public function resetPassword($id)
        {
            return parent::resetPassword($id); // TODO: Change the autogenerated stub
        }
    }
?>