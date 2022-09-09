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
        <?php include '../../../inc/secretary&labTechNav.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="container-fluid">
            <!-- Content Header (Page header) -->

            <div  class="well well-sm text-center text-bold" style="font-size: 18px" >
                <a href="../courses&lecturers/" class="btn btn-danger pull-left">
                    <i class="fa fa-arrow-left">&nbsp;Back</i>
                </a>
                <i class="fa fa-clock-o "></i> Time/Hours and Days of Allocation
            </div>

            <div class="row">
                <div id="message" class="text-center" style="margin: auto; width: 50%" ></div>
            </div>

            <div class="row">

                <div class="col-sm-6">

                    <div class="panel panel-default " style="margin-top:6px" id="panel">
                        <div class="panel-heading">
                            <h4 class="text-center text-bold">Set Days Here</h4>
                        </div>

                        <section class="panel-body">
                            <form name="data" id="form-data"
                                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <div class="form-group all">
                                    <label for="course">Select Day:</label>
                                    <select class="form-control" id="day" name="day">
                                        <option>----Days-----</option>
                                        <option>Sunday</option>
                                        <option>Monday</option>
                                        <option>Tuesday</option>
                                        <option>Wednesday</option>
                                        <option>Thursday</option>
                                        <option>Friday</option>
                                        <option>Saturday</option>
                                    </select>
                                </div>

                        </section>

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <button type="submit" class="button btn-md btn-primary" id="saveDaysBtn">Save</button>
                                </div>

                            </div>

                        </div>
                    </div>
                    </form>

                    <hr class="m-lg-2">

                    <div id="showDays">
                        <div class="alert alert-success text-center text-bold">
                            Loading data...
                        </div>
                    </div>

                </div>

                <div class="col-sm-6" style="border:2px solid dimgrey; border-radius: 10px">

                    <div class="panel panel-default " style="margin-top:6px" id="panel">
                        <div class="panel-heading">
                            <h4 class="text-center text-bold">Set Time/hours</h4>
                        </div>

                        <section class="panel-body">
                            <form name="data" id="data"
                                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <div class="parent">
                                    <div class="form-group child">
                                        <label for="startTime">Start Time</label>
                                        <input type="time" class="form-control" id="startTime" name="startTime">
                                    </div>

                                    <div class="form-group child ">
                                        <label for="finishTime">Finish Time</label>
                                        <input type="time" class="form-control" id="finishTime" name="finishTime">
                                    </div>
                                </div>

                        </section>

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <button type="submit" class="button btn-md btn-primary" id="saveTimeBtn">Save</button>
                                </div>

                            </div>

                        </div>
                    </div>
                    </form>

                    <hr class="m-lg-2">

                    <div id="showTime">
                        <div class="alert alert-success text-center text-bold">
                            Loading data...
                        </div>
                    </div>
                </div>

            </div>

            <?php require_once "../../../inc/edit_password_modal.php"; ?>
            <?php require_once "../../../inc/program_modal.php"; ?>

            <?php include '../../../../inc/footer.php'; ?>
        </div>

        <script src="/attendance/public/js/timeAndDays.js"></script>

        <script src="../../../public/js/secretaryHome.js"></script>

</body>


