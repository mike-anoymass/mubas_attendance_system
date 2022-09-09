<?php
    class Intake extends Dbh{
        protected function getIntake(){
            $sql = "SELECT * FROM intake";
            $stmt = $this->connect()->query($sql);

            return $stmt->fetchAll();

        }

    }
?>