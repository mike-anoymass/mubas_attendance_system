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
                <i class="fa fa-users"></i> Certificates Panel
            </div>

            <div class="row">
                <div class="col-sm-5" >
                    <h4>
                        <a href="#" style="border-right: 3px solid green">All Students&nbsp;
                            <span class="badge" id="allStudentsLbl"></span>&nbsp</a>
                        <a href="#" style="border-right: 3px solid green">Collected certificates &nbsp;
                            <span class="badge" id="certifiedStudentsLbl"></span>&nbsp</a>
                        <a href="#">Uncollected certificates &nbsp;
                            <span class="badge" id="uncertidiedStudentsLbl"></span>
                            &nbsp
                        </a>
                    </h4>

                </div>

                <div class="col-sm-7">
                    <div id="message" class="text-center"></div>
                </div>
            </div>
            <br>
            <div class="row" >
                <div class="col-md-6" >
                    <form method="post" id="upload_csv" enctype="multipart/form-data" class="form-horizontal">

                        <div class="form-group">
                            <label for="student_file" class="col-md-2 control-label">
                                Import Students
                            </label>

                            <div class="col-md-4">
                                <input type="file" name="student_file" accept=".csv"
                                       class="form-control " required>
                                <span class="help-block">
                                            <strong></strong>
                                        </span>
                            </div>

                            <div class="col-md-2">
                                <input type="submit" id="upload" name="upload"
                                       class="btn btn-primary btn-sm form-control"
                                       value="Upload">
                            </div>
                        </div>

                        <div style="clear: both"></div>
                    </form>
                </div>

                <div class="col-sm-6">
                    <select id="category" class="form-control pull-left" style="width:50%;
                         background-color:grey; color: white">
                        <option>----Choose What to See-----</option>
                        <option>All Students</option>
                        <option>Collected Certificates</option>
                    </select>

                    <a href="exportAction.php?export=excel" class="btn btn-primary pull-right" >
                        <i class="fa fa-table fa-lg">&nbsp;Export Collected Certificates to Excel</i>
                    </a>
                </div>
            </div>

            <!-- Main content -->

                <hr class="m-lg-2">

            <div class="row">

                <div class="col-sm-5">
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

                <span class="col-sm-2">
                    <button class="btn btn-default" id="refresh">
                        <i class="fa fa-refresh fa-lg">&nbsp &nbsp Refresh</i>
                    </button>
                </span>
            </div>


            <div class="row">

                <div class="col-sm-6">
                    <div id="showTable1">
                        <div class="alert alert-success text-center text-bold">
                            Loading data...
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">

                    <div id="showTable">
                        <div class="alert alert-success text-center text-bold">
                            Loading data...
                        </div>
                    </div>
                </div>

            </div>

            <?php require_once "../../../inc/edit_password_modal.php"; ?>
            <?php require_once "../../../inc/student_info_modal.php"; ?>

            <?php include '../../../inc/footer.php'; ?>
        </div>

        <script src="/attendance/public/js/students.js"></script>

        <script src="../../../public/js/secretaryHome.js"></script>

</body>


