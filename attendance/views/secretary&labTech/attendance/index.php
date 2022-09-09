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
                <a href="../courses&lecturers/" class="btn btn-danger pull-left">
                    <i class="fa fa-arrow-left">&nbsp;Back</i>
                </a>
                <i class="fa fa-table "></i> Record Attendance
            </div>

            <div class="row">
                <div class="col-sm-5" >

                </div>

                <div class="col-sm-3">
                    <div id="message" class="text-center"></div>
                </div>

                <div class="col-sm-4">
                    <label for="intake">Select Intake</label>
                    <select id="intake" class="form-control" style="width:40%;
                             background-color:white; color: black">
                        <?php
                        $view = new IntakeView();
                        $rows = $view->getIntake();

                        if(count($rows) === 0){
                            echo "<option> No any intakes found </option>";
                        }else{
                            echo "<option>----Intakes-----</option>";
                        }

                        foreach($rows as $row){
                            echo "<option value='$row[id]'>". $row['start']."-".
                                $row['end']." ". $row['year']. "</option>";
                        }
                        ?>
                    </select>

                </div>
            </div>

            <!-- Main content -->

                <hr class="m-lg-2">

            <div class="row">


                <div class="col-sm-5">
                    <div class="panel panel-default">

                        <div class="panel-heading text-bold" style="background-color: dimgrey; color: white">
                            Attendance Registration Details
                        </div>
                        <div class="panel-body">

                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Register Attendance For: </th>
                                    <td>
                                        <?php
                                        $view = new LecturersView();

                                        $row = $view->getLecturer(Session::get("attendanceVars", "lecturerID"));
                                        echo $row["firstname"]." ".$row["lastname"];
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Course Taught: </th>
                                    <td>
                                        <?php
                                        $cView = new CoursesView();

                                        $cRow = $cView->getCourse(Session::get("attendanceVars", "courseID"));
                                        echo $cRow["name"];

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Program:</th>
                                    <td>
                                        <?php
                                        $view = new ProgramsView();

                                        $row = $view->getProgram(Session::get("attendanceVars", "programID"));

                                        echo $row["name"];

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Day and Time:</th>
                                    <td>
                                        <?php
                                        $view = new LecturersAndCoursesView();

                                        $row = $view->getAllocation(
                                                Session::get("attendanceVars", "lecturerID"),
                                                Session::get("attendanceVars", "courseID")
                                        );

                                        echo $row["dayOfWeek"]." ".$row["startTime"]."-".$row["endTime"];

                                        ?>
                                    </td>
                                </tr>

                                </thead>
                            </table>



                        </div>
                    </div>
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

        <script src="/attendance/public/js/attendance.js"></script>

        <script src="../../../public/js/secretaryHome.js"></script>

</body>


