<?php 
    class Users extends Dbh {

        protected function setUser($firstName, $lastName, $username, $phone, $email,$gender, $passwd,$tOS ){

            $sql = "INSERT INTO users(firstName, lastName, username, phone, email,gender, dateRegistered,
                    password,typeOfUser ) VALUES (?, ?, ?, ?, ?, ?, NOW() ,? ,?)";

            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$firstName, $lastName, $username, $phone, $email, $gender, $passwd,$tOS])){
                return "User Added SuccessFully";
            }else{
                return "Error Adding User => ". implode(":",  $stmt->errorInfo() );
            }

        }

        protected function getUser($id){
            $sql = "SELECT * FROM users WHERE username = :id";

            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute(['id'=>$id])){
                return $stmt->fetch();
            }
            return "Error Searching User => ". implode(":",  $stmt->errorInfo() );
        }



        protected function getUsers(){
            $sql = "SELECT * FROM users";
            $stmt = $this->connect()->query($sql);

            if($this->countUsers() > 0){
                return $stmt->fetchAll();
            }else{
                return "Users not found";
            }
        }

        protected function checkUserCredentials($userName, $passwd){

            $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$userName, $passwd]);

            if($stmt->rowCount() > 0){
                return $stmt->fetch();
            }
            return "Invalid Login Credentials";

        }

        protected function editUser($firstName, $lastName,$username, $phone, $email,$gender, $passwd,$tOS){
            $sql = "UPDATE users 
                    SET firstName=?, lastName=?, phone=?, email=?, gender=?, password=?, typeOfUser=?
                    WHERE username=?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$firstName, $lastName, $phone, $email, $gender, $passwd,$tOS, $username]);

        }

        protected function updatePassword($username, $passwd){
            $sql = "UPDATE users SET password=? WHERE username=?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([ $passwd, $username]);

            return "Editing Password => ". implode(":",  $stmt->errorInfo() );

        }

        protected function countUsers(){
            $sql = "SELECT * FROM users";
            $stmt = $this->connect()->query($sql);
            return $stmt->rowCount();
        }

        protected function deleteUser($id){
            $sql = "DELETE FROM users WHERE username=?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$id]);

        }

        protected function resetPassword($id){
            $sql = "UPDATE users SET password=? WHERE username=?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$id, $id]);

            return "Password has been reset => ". implode(":",  $stmt->errorInfo() );

        }



    }
?>