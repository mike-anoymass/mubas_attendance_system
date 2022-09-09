<?php
    require_once "classAutoload.php";


    if (isset($_POST['action']) && $_POST['action'] == "create") {
        insertAllocation();
    }

    //handle update button click
    if (isset($_POST['action']) && $_POST['action'] == "update") {
        updateAllocations();
    }

    function insertAllocation()
    {
        global $lecturer, $course, $day , $dayName, $timeRange, $startTime, $endTime, $room;

        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $allocationController;

        if(checkIfThisDateHasBeenAllocatedForTheLecture($lecturer, $dayName, $startTime, $endTime)){
            $results = $allocationController->setAllocation($lecturer, $course, $day , $timeRange, $room);
            if($results === "Allocation Added SuccessFully") {
                echo '<div class="alert alert-sm alert-success alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                    $results . '</div>';
            }else{
                echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' .
                    $results . '</div>';
            }
        }



    }


    function updateAllocation()
    {
        global $id, $name;
        //to initialize the objects used to inserting data and
        // variables for getting submitted data from the insert form
        initializeVars();

        global $programController;

        $results = $programController->editProgram($id, $name);

        echo '<div class="alert alert-success alert-dismissible">
                            <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
                           '. $results.
                       '</div>';
    }

    function initializeVars(){
        global $lecturer, $course, $day, $dayName ,$timeRange, $startTime, $endTime, $room;

        //this objects will be used to insert and update user data
        global $allocationController;
        $allocationController = new LecturersAndCoursesController();

        //These literal variables wll be used get data from the insert and update form
        $lecturer = $_POST['lecturer'];
        $course = $_POST['course'];
        $day = $_POST['day'];
        $room = $_POST['room'];
        $timeRange =$_POST['time'];

        $timeAndDate = new TimeAndDaysView();

        $data = $timeAndDate->getTimeRange($timeRange);
        $data2 = $timeAndDate->getDay($day);

        $startTime = $data['startTime'];
        $endTime = $data['endTime'];

        $dayName = $data2['dayName'];
    }

    function checkIfThisDateHasBeenAllocatedForTheLecture($lecturer, $dayName, $startTime, $endTime){
        $view = new LecturersAndCoursesView();
        $rows = $view->getAllocationsForThisLecturer($lecturer);

        if($rows !== "Allocation not found"){

            foreach ($rows as $row) {
                if($row['dayOfWeek'] === $dayName){


                    if($row['startTime'] === $startTime){
                        echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Error => '.$row['name'].' Teaches '.$row['courseName'].' on '.$row['dayOfWeek'].'
                        at '.$row['startTime'].'</div>';
                        return false;
                    }

                    if($row['endTime'] === $endTime){
                        echo '<div class="alert alert-danger alert-dismissible">
                        <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Error => '.$row['name'].' Teaches '.$row['courseName'].' on '.$row['dayOfWeek'].'
                        at '.$row['endTime'].'</div>';
                        return false;
                    }
                }
            }
            return true;
        }else{
            return true;
        }
    }


?>
