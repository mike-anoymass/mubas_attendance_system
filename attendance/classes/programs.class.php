<?php
    class Programs extends Dbh{
        protected function setProgram($id , $name, $tuition){
            $sql = "INSERT INTO programs (id,name, tuitionFee, dateRegistered) VALUES (?, ? ,? , NOW())";
            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$id, $name, $tuition])){
                return "Program Added SuccessFully";
            }
            return "Error Adding Program => ". implode(":",  $stmt->errorInfo() );
        }

        protected function getAllPrograms(){
            $sql = "SELECT * FROM programs";
            $stmt = $this->connect()->query($sql);

            if($this->countPrograms() > 0){
                return $stmt->fetchAll();
            }
            return "Programs not found";

        }

        protected function getProgram($id){
            $sql = "SELECT * FROM programs WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);

            if( $stmt->rowCount() > 0){
                return $stmt->fetch();
            }else{
                return "Program not found";
            }
        }

        protected function editProgram($id, $name, $tuition){
            $sql = "UPDATE programs SET name=?, tuitionFee=? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $tuition, $id]);
            return "Editing Program ". implode(":",  $stmt->errorInfo() );

        }

        protected function deleteProgram($id){
            $sql = "DELETE FROM programs WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            return "Deleting Program ". implode(":",  $stmt->errorInfo() );
        }

        protected function countPrograms(){
            $sql = "SELECT * FROM programs";
            $stmt = $this->connect()->query($sql);
            return $stmt->rowCount();
        }
    }
?>