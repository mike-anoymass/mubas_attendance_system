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
?>

<body>

        <?php
            if(Session::get("sessionVars", "typeOfUser") === "Administrator"){
                include '../../../inc/adminNav.php';
            }else{
                include '../../../inc/secretary&labTechNav.php';
            }

        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div  class="well well-sm text-center text-bold" style="font-size: 18px" >
                <a href="../attendanceHistory/" class="btn btn-danger pull-left">
                    <i class="fa fa-arrow-left">&nbsp;Back</i>
                </a>
                <i class="fa fa-history"></i> Lecturer Attendance History
            </div>

            <div class="row">
                <div class="col-sm-5" >
                    <h4>
                        <a href="#" style="border-right: 3px solid green">Total Classes&nbsp;
                            <span class="badge" id="totalLbl"></span>&nbsp</a>
                        <a href="#" style="border-right: 3px solid green">Present&nbsp;
                            <span class="badge" id="presentLbl"></span>&nbsp</a>
                        <a href="#" >Absent&nbsp;
                            <span class="badge" id="absentLbl"></span>&nbsp</a>

                    </h4>

                </div>

                <div class="col-sm-5">
                    <div id="message" class="text-center"></div>
                </div>

                <div class="col-sm-2">
                    <a href="lecturerHistoryPrintAction.php?print=pdf" class="btn btn-primary pull-right" id="report">
                        <i class="fa fa-print fa-lg">&nbsp;Report</i>
                    </a>
                </div>

            </div>
            <br>

            <!-- Main content -->

                <hr class="m-lg-2">

            <div class="row">

                <div class="col-sm-5">
                    <div class="row">
                        <div class="panel panel-default">

                            <div class="panel-heading text-bold" style="background-color: dimgrey; color: white">
                                Lecturer Details
                            </div>
                            <div class="panel-body">

                                <table class="table table-sm table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Full Name: </th>
                                        <td>
                                            <?php
                                            $view = new LecturersView();

                                            $row = $view->getLecturer(Session::get("historyVars", "lecturerID"));
                                            echo $row["firstname"]." ".$row["lastname"];
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Gender: </th>
                                        <td>
                                            <?php
                                            echo $row["gender"];

                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Phone Number:</th>
                                        <td>
                                            <?php

                                                echo $row["phone"];
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Teaches:</th>
                                        <td>
                                            <?php
                                                $lView = new LecturersAndCoursesView();

                                                $rows = $lView->getCoursesForThisLecturer(
                                                    Session::get("historyVars", "lecturerID"));
                                                foreach($rows as $rw){
                                                    echo $rw['name']. ", ";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    </thead>
                                </table>



                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: dimgrey; color: white">
                                Attendance Summary for <?php echo $row['firstname']?>
                            </div>
                            <div class="panel-body">

                                    <div id="showChart">
                                    <canvas id="canvas"></canvas>
                                    </div>

                            </div>
                        </div>

                    </div>



                </div>

                <div class="col-sm-7">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-bold" >
                            Attendance History
                        </div>

                        <div class="panel-body">
                            <div id="showHistory">
                                <div class="alert alert-success text-center text-bold">
                                    Loading data...
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <?php require_once "../../../inc/lecturer_history_modal.php"; ?>

            <?php require_once "../../../inc/edit_password_modal.php"; ?>

            <?php include '../../../inc/footer.php'; ?>
        </div>

        <script src="/attendance/public/js/lecturerAttendanceHistory.js"></script>

        <script src="../../../public/js/secretaryHome.js"></script>

</body>


