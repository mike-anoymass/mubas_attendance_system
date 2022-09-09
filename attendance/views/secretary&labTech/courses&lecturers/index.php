<?php
require_once "../../../inc/header.php";
require_once "../../../inc/scripts.php";
require_once "classAutoload.php";
?>

<?php
    Session::start();


    if(!Session::get("sessionVars")){
        header("Location: ../../../");
    }

    if(Session::get("programVars")){
        $programID = Session::get("programVars","programID");
        $programName = Session::get("programVars","programName");
        echo '<input type="hidden" id="checkIfProgramIsSelected" value= "set" >';
    }else{
        $programName = $programName = "";
        echo '<input type="hidden" id="checkIfProgramIsSelected" value= "" >';
    }

?>



<body>
        <?php include '../../../inc/secretary&labTechNav.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div  class="well well-sm text-center text-bold" style="font-size: 18px" >
                <i class="fa fa-archive "></i> Courses and Lecturers Allocation
            </div>

            <div class="row">
                <div class="col-sm-4" >
                    <a href="../timeRanges/" class="btn btn-primary ">
                        <i class="fa fa-clock-o fa-lg">&nbsp;Set Time Ranges and Days</i>
                    </a>
                    <h4>
                        <a href="#">All Allocations&nbsp; <span class="badge" id="allAllocationsLbl"></span></a>
                    </h4>

                </div>

                <div class="col-sm-3">
                    <div id="message" class="text-center"></div>
                </div>

                <div class="col-sm-5">
                    <select id="category" class="form-control pull-left" style="width:50%;
                         background-color:grey; color: white">
                        <option>----Choose What to See-----</option>
                        <option>Allocations</option>
                        <option>Lecturers</option>
                        <option>Courses</option>
                    </select>

                    <a href="exportAction.php?export=excel" class="btn btn-primary pull-right" >
                        <i class="fa fa-table fa-lg">&nbsp;Export Allocation List to Excel</i>
                    </a>
                </div>
            </div>

            <!-- Main content -->

                <hr class="m-lg-2">

            <div class="row">


                <div class="col-sm-5">
                    <a type="button" style="margin-right:3px" class="btn btn-info btn-lg btn-block"
                       data-toggle="modal" data-target="#selectProgram">
                         Select Program Here
                    </a>

                    <br>

                    <div class="panel panel-default " style="margin-top:6px" id="panel">
                        <div class="panel-heading">
                            <h4 class="text-center text-bold">Make Allocations For <?php echo $programName?>
                                On This Form</h4>
                        </div>

                        <section class="panel-body">
                            <form name="data" id="form-data"
                                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <div class="parent">
                                    <div class="form-group child">
                                        <label for="course">Select Lecturer:</label>
                                        <select class="form-control" id="lecturer" name="lecturer">

                                            <?php
                                            $lecturerView = new LecturersView();
                                            $rows = $lecturerView->getAllLecturers();

                                            if(count($rows) === 0){
                                                echo "<option> Lecturers Do not Exist </option>";
                                            }else{
                                                echo "<option>----Lecturers-----</option>";
                                            }

                                            foreach($rows as $row){
                                                echo "<option value='$row[id]'>".
                                                    $row['firstname']." ".$row['lastname']. "</option>";
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group child ">
                                        <label for="course">Select Course:</label>
                                        <select class="form-control" id="course" name="course">

                                            <?php
                                            $allocationView = new CourseAllocationView();
                                            $rows = $allocationView->getCoursesForThisProgram($programID);

                                            if(count($rows) === 0){
                                                echo "<option> This program does not have courses </option>";
                                            }else{
                                                echo "<option>----Courses-----</option>";
                                            }

                                            foreach($rows as $row){
                                                echo "<option value='$row[id]'>". $row['name']. "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>



                                <div class="parent">
                                    <div class="form-group child">
                                        <label for="course">Select Day:</label>
                                        <select class="form-control" id="day" name="day">
                                            <?php
                                            $view = new TimeAndDaysView();
                                            $rows = $view->getDays();

                                            if($rows === "Days not found"){
                                                echo "<option>Set Time and Days</option>";
                                            }else{
                                                echo "<option>----Days-----</option>";
                                            }

                                            foreach($rows as $row){
                                                echo "<option value='$row[id]'>". $row['dayName']. "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group child">
                                        <label for="course">Select Time Range/Hours:</label>
                                        <select class="form-control" id="time" name="time">
                                            <?php
                                            $view = new TimeAndDaysView();
                                            $rows = $view->getTimeRanges();

                                            if($rows === "Time Ranges not found"){
                                                echo "<option>Set Time and Days</option>";
                                            }else{
                                                echo "<option>----Hours-----</option>";
                                            }

                                            foreach($rows as $row){
                                                echo "<option value='$row[id]'>".
                                                    $row['startTime']."->" .$row['endTime']. "
                                                </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-group all ">
                                    <label for="room">Room</label>
                                    <input type="text" class="form-control" id="room" name="room">
                                </div>

                        </section>

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <button type="submit" class="button btn-lg btn-primary" id="saveBtn">Allocate</button>
                                </div>

                            </div>

                        </div>
                    </div>
                    </form>

                </div>

                <div class="col-sm-7">

                    <div id="showTable">
                        <div class="alert alert-success text-center text-bold">
                            Loading data...
                        </div>
                    </div>
                </div>

            </div>

            <?php require_once "../../../inc/edit_password_modal.php"; ?>
            <?php require_once "../../../inc/program_modal.php"; ?>

            <?php include '../../../inc/footer.php'; ?>
        </div>

        <script src="/attendance/public/js/lecturerCourses.js"></script>

        <script src="../../../public/js/secretaryHome.js"></script>

</body>


