<?php
    class Courses extends Dbh{
        protected function setCourse($id , $name , $level , $credit){
            $sql = "INSERT INTO courses (id,name,level, credit, dateRegistered)
                    VALUES (?, ? , ?, ?, NOW())";
            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$id, $name, $level, $credit])){
                return "Course Added SuccessFully";
            }

            return "Error Adding Course => ". implode(":",  $stmt->errorInfo() );
        }

        protected function getAllCourses(){
            $sql = "SELECT * FROM courses";
            $stmt = $this->connect()->query($sql);

            if($this->countCourses() > 0){
                return $stmt->fetchAll();
            }

            return "Courses not found";

        }

        protected function getCourse($id){
            $sql = "SELECT * FROM courses WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);

            if( $stmt->rowCount() > 0){
                return $stmt->fetch();
            }else{
                return "Course not found";
            }
        }

        protected function editCourse($id , $name , $level , $credit){
            $sql = "UPDATE courses SET name=?, level=?, credit=? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $level, $credit, $id]);
            return "Updating Course => ". implode(":",  $stmt->errorInfo() );
        }

        protected function deleteCourse($id){
            $sql = "DELETE FROM courses WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            return "Deleting Course => ". implode(":",  $stmt->errorInfo() );
        }

        protected function countCourses(){
            $sql = "SELECT * FROM courses";
            $stmt = $this->connect()->query($sql);
            return $stmt->rowCount();
        }
    }
?>