<?php
    include_once "session.class.php";
    Session::start();
    class Students extends Dbh{
        protected function setStudent($id , $firstName, $lastName, $prg, $intake){

            $sql = "INSERT INTO students (id, firstname, lastname, programID, intake, dateRegistered) 
                VALUES (?, ?, ?, ?, ?, NOW())";
   
            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$id, $firstName, $lastName, $prg, $intake])){
                return "Students data imported SuccessFully";
            }

            return "Error Importing Students => ". implode(":",  $stmt->errorInfo() );
        }

        protected function getCertifiedStudents(){
            $sql = "SELECT student, firstname, lastname, programID, date, issuer
                        FROM collectedcertificates cc, students s where cc.student=s.id";

            $stmt = $this->connect()->query($sql);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return $stmt->rowCount();
        }

        protected function getCertifiedStudentsForThisIntake($intake){
            $sql = "SELECT student,firstname,lastname, programID
                    FROM collectedCertificates cc, students s
                    WHERE student IN (SELECT id from students where intake=?) AND s.id=cc.student";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$intake]);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return $stmt->rowCount();
        }

        protected function getUncertifiedStudents(){
            $sql = "SELECT * FROM students WHERE id NOT IN (SELECT student from collectedCertificates)";

            $stmt = $this->connect()->query($sql);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return $stmt->rowCount();
        }

        protected function getUncertifiedStudentsForThisIntake($intake){
            $sql = "SELECT * FROM students 
                    WHERE id NOT IN (SELECT student from collectedCertificates) and intake=?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$intake]);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return $stmt->rowCount();
        }

        protected function getAllStudents(){
            $sql = "SELECT * FROM students";

            $stmt = $this->connect()->query($sql);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return $stmt->rowCount();
        }

        protected function getStudentsForThisProgram($program){
            $sql = "SELECT * FROM students 
                    WHERE programID=? and id NOT IN (SELECT student from collectedCertificates)";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$program]);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return $stmt->rowCount();
        }

        protected function getStudentsForThisProgramAtThisIntake($program, $intake){
            $sql = "SELECT * FROM students 
                    WHERE programID=? AND intake=? and id NOT IN (SELECT student from collectedCertificates)";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$program, $intake]);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return $stmt->rowCount();
        }


        protected function getAllStudentsForThisIntake($intake){
            $sql = "SELECT * FROM students 
                    WHERE intake=?";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$intake]);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return $stmt->rowCount();
        }

        protected function deleteStudent($id){

            $sql = "DELETE FROM students WHERE id= :id";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute(['id'=>$id]);

            return "Deleting Student(s) ". implode(":",  $stmt->errorInfo() );
        }

        protected function certifyStudent($id){
            $issuer = Session::get("sessionVars", "firstName")
                . " " .Session::get("sessionVars", "lastName");

            $sql = "INSERT INTO collectedCertificates (student, date, issuer) 
                VALUES (?, NOW(), ?)";

            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$id, $issuer])){
                return "Student(s) Certified";
            }

            return "Error => ". implode(":",  $stmt->errorInfo() );
        }

        protected function uncertifyStudent($id){
            $sql = "DELETE FROM collectedCertificates WHERE student= :id";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute(['id'=>$id]);

            return "Certification Removed";
        }

        protected function getInfoForThisStudent($id){
            $sql = "SELECT s.id AS id , firstname, lastname, name    AS program, 
                    start, end , year, cc.date as date , issuer
                    FROM students s, collectedCertificates cc, intake i, programs p
                    WHERE s.id=? AND s.id=cc.student AND i.id=s.intake AND s.programID=p.id";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$id]);

            if($stmt->rowCount() > 0){
                return $stmt->fetch();
            }

            return $stmt->rowCount();
        }

        protected function getDetailsForThisStudent($id){
            $sql = "SELECT s.id AS id , firstname, lastname, name AS program, 
                    start, end , year
                    FROM students s, intake i, programs p
                    WHERE s.id=? AND i.id=s.intake AND s.programID=p.id";

            $stmt = $this->connect()->prepare($sql);

            $stmt->execute([$id]);

            if($stmt->rowCount() > 0){
                return $stmt->fetch();
            }

            return $stmt->rowCount();
        }

        protected function getNumberOfCollectedCertificatesToday(){

            $date = date("Y-m-d");
            $sql = "SELECT * FROM collectedcertificates where date LIKE  '%$date%'";

            $stmt = $this->connect()->query($sql);

            return $stmt->rowCount();
        }



    }
?>