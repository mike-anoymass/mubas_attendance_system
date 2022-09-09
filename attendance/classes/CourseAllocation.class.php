 <?php
    class CourseAllocation extends Dbh{
        protected function setAllocation($programID, $courseID , $unitCode){
            $sql = "INSERT INTO coursestoprogramsallocation (programID,courseID,unitCode, dateRegistered)
                    VALUES (?, ? , ?,  NOW())";
            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$programID, $courseID, $unitCode])){
                return "Allocation Added SuccessFully";
            }

            return "Error Adding Allocation => ". implode(":",  $stmt->errorInfo() );
        }

        protected function getPrograms(){
            $sql = "SELECT p.name AS name, p.id AS id
                        FROM coursestoprogramsallocation cp, programs p 
                        WHERE cp.programID=p.id
                        GROUP BY p.name";
            $stmt = $this->connect()->query($sql);

            if($this->countallocations() > 0){
                return $stmt->fetchAll();
            }

            return "Allocations not found";

        }

        protected function getCoursesForThisProgram($id){
            $sql = "SELECT c.name AS name, cp.unitCode AS unitCode, c.id AS id,  cp.dateRegistered
                        FROM coursestoprogramsallocation cp, courses c
                        WHERE cp.courseID=c.id AND programID=?
                        " ;
            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$id])){
                return $stmt->fetchAll();
            }

            return "Allocations not found";

        }



        protected function getAllocations(){
            $sql = "SELECT p.name AS programName, c.name AS courseName, cp.unitCode, cp.dateRegistered
                        FROM coursestoprogramsallocation cp, courses c , programs p 
                        WHERE cp.courseID=c.id AND cp.programID=p.id
                        ORDER BY p.name, c.name";
            $stmt = $this->connect()->query($sql);

            if($this->countallocations() > 0){
                return $stmt->fetchAll();
            }

            return "Allocations not found";

        }

        protected function getAllocation($courseID , $programID){
            $sql = "SELECT * FROM coursestoprogramsallocation
                    WHERE courseID=? AND programID=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$courseID, $programID]);

            if( $stmt->rowCount() > 0){
                return $stmt->fetch();
            }else{
                return "Allocation not found";
            }
        }

        protected function editAllocation($courseID , $programID , $unitCode){
            $sql = "UPDATE coursestoprogramsallocation SET unitCode=?
                    WHERE courseID=? AND programID=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$unitCode, $courseID, $programID]);
        }

        protected function deleteAllocation($courseID , $programID){
            $sql = "DELETE FROM coursestoprogramsallocation WHERE courseID=? AND programID=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$courseID, $programID]);
            return "Deleting Allocation => ". implode(":",  $stmt->errorInfo() );
        }

        protected function countAllocations(){
            $sql = "SELECT * FROM coursestoprogramsallocation";
            $stmt = $this->connect()->query($sql);
            return $stmt->rowCount();
        }


    }
?>