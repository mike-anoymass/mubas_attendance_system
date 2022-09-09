<?php
class Attendance extends Dbh{
    protected function setStudentAttendance($studentID ,$courseID, $attended){
        $sql = "INSERT INTO studentattendance (studentID, courseID , attended, dateRegistered)
                    VALUES (?, ?, ?, NOW())";
        $stmt = $this->connect()->prepare($sql);

        if($stmt->execute([$studentID ,$courseID, $attended])){
            return "Students Attendance Registered SuccessFully";
        }

        //return "Error Adding Attendance => ". implode(":",  $stmt->errorInfo() );
    }

    protected function setLecturerAttendance($lecturerID ,$courseID, $attended){
        $sql = "INSERT INTO lecturerattendance (lecturerID, courseID , attended, dateRegistered)
                    VALUES (?, ?, ?, NOW())";
        $stmt = $this->connect()->prepare($sql);

        if($stmt->execute([$lecturerID ,$courseID, $attended])){
            return "Lecturer Attendance Registered SuccessFully";
        }

        return "Error Adding Attendance => ". implode(":",  $stmt->errorInfo() );
    }



    protected function getLecturerAttendances(){
        $sql = "SELECT * FROM lecturerattendance";
        $stmt = $this->connect()->query($sql);

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();
        }

        return $stmt->rowCount();

    }

    protected function getAttendanceForThisLecturer($lecturerID){
        $sql = "SELECT lecturerID, cpa.courseID AS course, cpa.programID AS program, attended, la.dateRegistered AS date 
                FROM lecturerattendance la, coursestoprogramsAllocation cpa
                    WHERE la.lecturerID=? and  la.courseID=cpa.courseID ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$lecturerID]);

        if( $stmt->rowCount() > 0){
            return $stmt->fetchAll();
        }else{
            return $stmt->rowCount();
        }
    }

    protected function getAttendanceForThisStudent($studentID){
        $sql = "SELECT  cpa.courseID AS course, cpa.programID AS program, attended, la.dateRegistered AS date 
                FROM studentattendance la, coursestoprogramsAllocation cpa
                    WHERE la.studentID=? and  la.courseID=cpa.courseID ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$studentID]);

        if( $stmt->rowCount() > 0){
            return $stmt->fetchAll();
        }else{
            return $stmt->rowCount();
        }
    }

    protected function deleteAttendanceForThisLecturer($id){
        $sql = "DELETE FROM lecturerattendance WHERE lecturerID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function deleteAttendanceForThisStudent($id){
        $sql = "DELETE FROM studentattendance WHERE studentID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function countAttendancesForThisLecturer($lecturerID){
        $sql = "SELECT * FROM lecturerattendance
                where lecturerID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$lecturerID]);
        return $stmt->rowCount();
    }

    protected function countPresenceForThisLecturer($lecturerID){
        $sql = "SELECT * FROM lecturerattendance
                where lecturerID = ? and attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$lecturerID, 1]);
        return $stmt->rowCount();
    }

    protected function countAbsenceForThisLecturer($lecturerID){
        $sql = "SELECT * FROM lecturerattendance
                where lecturerID = ? and attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$lecturerID, 0]);
        return $stmt->rowCount();
    }

    protected function countAttendancesForThisStudent($id){
        $sql = "SELECT * FROM studentattendance
                where studentID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    protected function countPresenceForThisStudent($id){
        $sql = "SELECT * FROM studentattendance
                where studentID = ? and attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, 1]);
        return $stmt->rowCount();
    }

    protected function countAbsenceForThisStudent($id){
        $sql = "SELECT * FROM studentattendance
                where studentID = ? and attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id, 0]);
        return $stmt->rowCount();
    }

    protected function countLecturerAttendanceForToday(){
        $date = date("Y-m-d");
        $sql = "SELECT * FROM lecturerattendance
                where dateRegistered=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->rowCount();
    }

    protected function countStudentAttendanceForToday(){
        $date = date("Y-m-d");
        $sql = "SELECT * FROM studentattendance
                where dateRegistered=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$date]);
        return $stmt->rowCount();
    }

    protected function countStudentPresenceForToday(){
        $date = date("Y-m-d");
        $sql = "SELECT * FROM studentattendance
                where dateRegistered=? and attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$date, 1]);
        return $stmt->rowCount();
    }

    protected function countLecturerPresenceForToday(){
        $date = date("Y-m-d");
        $sql = "SELECT * FROM lecturerattendance
                where dateRegistered=? and attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$date, 1]);
        return $stmt->rowCount();
    }

    protected function countAttendanceForLecturers(){
        $sql = "SELECT * FROM lecturerattendance";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }

    protected function countAttendanceForStudents(){
        $sql = "SELECT * FROM studentattendance";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }

    protected function countAllStudentPresence(){
        $sql = "SELECT * FROM studentattendance
                where attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([1]);
        return $stmt->rowCount();
    }

    protected function countAllLecturerPresence(){
        $sql = "SELECT * FROM lecturerattendance
                where attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([1]);
        return $stmt->rowCount();
    }

    protected function countAllStudentAbsence(){
        $sql = "SELECT * FROM studentattendance
                where attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([0]);
        return $stmt->rowCount();
    }

    protected function countAllLecturerAbsence(){
        $sql = "SELECT * FROM lecturerattendance
                where attended=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([0]);
        return $stmt->rowCount();
    }
}