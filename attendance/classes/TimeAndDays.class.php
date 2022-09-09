<?php
    class TimeAndDays extends Dbh{
        protected function setTime($startTime, $endTime){
            $sql = "INSERT INTO timerange (startTime, endTime)
                    VALUES (?, ?)";
            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$startTime, $endTime])){
                return "Time Range Added SuccessFully";
            }

            return "Error Adding Time range => ". implode(":",  $stmt->errorInfo() );
        }

        protected function setDay($day){
            $sql = "INSERT INTO days (dayName)
                    VALUES (?)";
            $stmt = $this->connect()->prepare($sql);

            if($stmt->execute([$day])){
                return "Day Added SuccessFully";
            }

            return "Error Adding Day => ". implode(":",  $stmt->errorInfo() );
        }


        protected function getTimeRanges(){
            $sql = "SELECT * FROM timerange order by startTime";
            $stmt = $this->connect()->query($sql);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return "Time Ranges not found";

        }


        protected function getTimeRange($rangeID){
            $sql = "SELECT * FROM timerange where id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$rangeID]);

            if($stmt->rowCount() > 0){
                return $stmt->fetch();
            }

            return "Time Ranges not found";

        }

        protected function getDay($dayID){
            $sql = "SELECT * FROM days where id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$dayID]);

            if($stmt->rowCount() > 0){
                return $stmt->fetch();
            }

            return "Day not found";

        }

        protected function getDays(){
            $sql = "SELECT * FROM days";
            $stmt = $this->connect()->query($sql);

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll();
            }

            return "Days not found";

        }


        protected function deleteTimeRange($id){
            $sql = "DELETE FROM timerange WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            return "Deleting Time Range => ". implode(":",  $stmt->errorInfo() );
        }

        protected function deleteDay($id){
            $sql = "DELETE FROM days WHERE id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            return "Deleting Day => ". implode(":",  $stmt->errorInfo() );
        }

    }
?>