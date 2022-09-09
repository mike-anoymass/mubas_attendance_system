<?php
    class Lecturers extends Dbh{
        protected function setLecturer($id , $fName , $lName , $phone , $email, $gender){
            $sql = "INSERT INTO lecturers (id, firstname, lastname,phone, email,gender, dateRegistered)
                    VALUES (?, ?, ? ,? ,?, ?, NOW())";
            
            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$id , $fName , $lName , $phone , $email, $gender])){
                return "Lecturer Added SuccessFully";
            }

            return "Error Adding Lecturer => ". implode(":",  $stmt->errorInfo() );
        }

        protected function getAllLecturers(){
            $sql = "SELECT * FROM lecturers";
            $stmt = $this->connect()->query($sql);

            if($this->countLecturers() > 0){
                return $stmt->fetchAll();
            }else{
                return "Lecturers not found";
            }
        }

        protected function getLecturer($id){
            $sql = "SELECT * FROM lecturers WHERE id = ?";

            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$id])){
                return $stmt->fetch();
            }

            return "Error Searching Lecturer => ". implode(":",  $stmt->errorInfo() );
        }

        protected function editLecturer($id , $fName , $lName , $phone , $email, $gender){
            $sql = "UPDATE lecturers
                    SET firstname= ?, lastname= ? ,phone= ?, 
                    email= ?, gender=? WHERE id= ?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$fName , $lName , $phone , $email, $gender, $id]);

            return "Editing Lecturer => ". implode(":",  $stmt->errorInfo() );

        }

        protected function deleteLecturer($id){
            $sql = "DELETE FROM lecturers WHERE id=?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$id]);

            return "Deleting Lecturer => ". implode(":",  $stmt->errorInfo() );
        }

        protected function countLecturers(){
            $sql = "SELECT * FROM lecturers";
            $stmt = $this->connect()->query($sql);
            return $stmt->rowCount();
        }

    }
?>