<?php

class LecturersAndCourses extends Dbh{
    protected function setAllocation($lecturerID, $courseID , $day, $timeRange, $room){
        $sql = "INSERT INTO coursestolecturerallocation (lecturerID, courseID , dayOfWeek, 
                    timeRange, room, dateRegistered)
                    VALUES (?, ?, ?, ? , ? , NOW())";
        $stmt = $this->connect()->prepare($sql);

        if($stmt->execute([$lecturerID, $courseID , $day, $timeRange, $room])){
            return "Allocation Added SuccessFully";
        }

        return "Error Adding Allocation => ". implode(":",  $stmt->errorInfo() );
    }


    protected function getLecturers(){
        $sql = "SELECT l.firstname AS firstname, l.lastname AS lastname, l.id AS id
                        FROM coursestolecturerallocation cl, lecturers l
                        WHERE cl.lecturerID=l.id
                        GROUP BY l.lastname";
        $stmt = $this->connect()->query($sql);

        if($this->countallocations() > 0){
            return $stmt->fetchAll();
        }

        return "Allocations not found";

    }

    protected function getCoursesForThisLecturer($id){
        $sql = "SELECT c.name AS name, dayName as dayOfWeek, startTime, endTime, room,
                cl.dateRegistered, c.id AS courseID, programID, t.id AS tID, d.id AS dID
                        FROM coursestolecturerallocation cl, courses c, coursestoprogramsallocation cp,
                         days d, timeRange t
                        WHERE cl.courseID=c.id AND cl.lecturerID=? AND cl.courseID=cp.courseID AND
                         cl.dayOfWeek=d.id AND cl.timeRange=t.id";
        $stmt = $this->connect()->prepare($sql);

        if($stmt->execute([$id])){
            return $stmt->fetchAll();
        }

        return "Allocations not found->". implode(":",  $stmt->errorInfo() );;

    }

    protected function getCourseForThisLecturer($id, $course){
        $sql = "SELECT c.name AS name, dayName as dayOfWeek, startTime, endTime, room,
                cl.dateRegistered, c.id AS courseID, programID
                        FROM coursestolecturerallocation cl, courses c, coursestoprogramsallocation cp,
                         days d, timeRange t
                        WHERE cl.courseID=c.id AND cl.lecturerID=? and cl.courseID=? AND cl.courseID=cp.courseID AND
                         cl.dayOfWeek=d.id AND cl.timeRange=t.id ";
        $stmt = $this->connect()->prepare($sql);

        if($stmt->execute([$id,$course])){
            return $stmt->fetch();
        }

        return "Allocations not found->". implode(":",  $stmt->errorInfo() );;

    }

    protected function getAllAllocations(){
        $sql = "SELECT * FROM coursestolecturerallocation";
        $stmt = $this->connect()->query($sql);

        if($this->countallocations() > 0){
            return $stmt->fetchAll();
        }

        return "Allocations not found";

    }

    protected function getAllocationsForThisLecturer($lecturerID){
        $sql = "SELECT c.name AS courseName, l.firstname AS name, dayName as dayOfWeek, startTime, endTime
                FROM coursestolecturerallocation cl, lecturers l, courses c, days d, timeRange t
                WHERE cl.lecturerID=l.id AND lecturerID=? AND cl.courseID=c.id AND
                 cl.dayOfWeek=d.id AND cl.timeRange=t.id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$lecturerID]);

        if( $stmt->rowCount() > 0){
            return $stmt->fetchAll();
        }else{
            return "Allocation not found";
        }
    }


    protected function getAllocation($lecturerID, $courseID){
        $sql = "SELECT startTime, endTime , dayName as dayOfWeek
                FROM coursestolecturerallocation cl, days d, timeRange t
                    WHERE lecturerID=? AND courseID=? AND cl.timeRange=t.id AND cl.dayOfWeek=d.id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$lecturerID, $courseID]);

        if( $stmt->rowCount() > 0){
            return $stmt->fetch();
        }else{
            return "Allocation not found";
        }
    }

    protected function editAllocation($lecturerID, $courseID , $roomID, $day, $start, $end){

        $sql = "UPDATE coursestolecturerallocation SET dayOfWeek=?, startTime=? , endTime
                    WHERE courseID=? AND programID=? AND roomID=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$lecturerID, $courseID , $roomID]);
    }

    protected function deleteAllocation($courseID , $lecturerID, $timeRange, $day){
        $sql = "DELETE FROM coursestolecturerallocation WHERE courseID=? AND lecturerID=? AND timeRange=? AND dayOfWeek=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$courseID, $lecturerID, $timeRange, $day]);
        return "Deleting Allocation => ". implode(":",  $stmt->errorInfo() );
    }

    protected function countAllocations(){
        $sql = "SELECT * FROM coursestolecturerallocation";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }

    protected function getDays(){
        $sql = "SELECT DISTINCT dayOfWeek
                        FROM coursestolecturerallocation
                        ";
        $stmt = $this->connect()->query($sql);

        if($this->countallocations() > 0){
            return $stmt->fetchAll();
        }

        return "Allocations not found";
    }
}