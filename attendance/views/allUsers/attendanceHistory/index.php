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
                <i class="fa fa-shekel"></i> Attendance History Panel
            </div>

            <div class="row">
                <div class="col-sm-5" >
                    <h4>
                        <a href="#" style="border-right: 3px solid green">All Lecturers&nbsp;
                            <span class="badge" id="allLecturersLbl"></span>&nbsp</a>

                        <a href="#">All Students&nbsp;
                            <span class="badge" id="allStudentsLbl"></span>&nbsp</a>


                    </h4>

                </div>

                <div class="col-sm-7">
                    <div id="message" class="text-center"></div>
                </div>
            </div>
            <br>

            <!-- Main content -->

                <hr class="m-lg-2">

            <div class="row">

                <div class="col-sm-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 align="center">Lecturers</h4>
                        </div>
                        <div class="panel-body">
                            <div id="showLecturerTable">
                                <div class="alert alert-success text-center text-bold">
                                    Loading data...
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 align="center">Students</h4>
                        </div>

                        <div class="panel-body">

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

                            <br>

                            <div id="showStudentTable">
                                <div class="alert alert-success text-center text-bold">
                                    Loading data...
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <?php require_once "../../../inc/edit_password_modal.php"; ?>

            <?php include '../../../inc/footer.php'; ?>
        </div>

        <script src="/attendance/public/js/attendanceHistory.js"></script>

        <script src="../../../public/js/secretaryHome.js"></script>

</body>


