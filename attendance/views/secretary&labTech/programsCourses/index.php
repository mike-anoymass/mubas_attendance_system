<?php
require_once "../../../inc/header.php";
require_once "../../../inc/scripts.php";
require_once "classAutoload.php";
?>

<?php
Session::start();

if(Session::get("sessionVars")){

}else{
    header("Location: ../../../");
}
?>

<body>
        <?php include '../../../inc/secretary&labTechNav.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div  class="well well-sm text-center text-bold" style="font-size: 18px" >
                <i class="fa fa-archive "></i> Courses and Programs Allocation
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <h4>
                        <a href="#">All Allocations&nbsp; <span class="badge" id="allAllocationsLbl"></span></a>
                    </h4>
                </div>

                <div class="col-sm-5">
                    <div id="message" class="text-center"></div>
                </div>

                <div class="col-sm-5">
                    <select id="category" class="form-control pull-left" style="width:50%;
                         background-color:grey; color: white">
                        <option>----Choose What to See-----</option>
                        <option>Allocations</option>
                        <option>Programs</option>
                        <option>Courses</option>
                    </select>

                    <a href="exportAction.php?export=excel" class="btn btn-primary pull-right">
                        <i class="fa fa-table fa-lg">&nbsp;Export Allocation List to Excel</i>
                    </a>
                </div>
            </div>

            <!-- Main content -->

                <hr class="m-lg-2">

            <div class="row">
                <div class="col-sm-5">
                    <div class="panel panel-default" style="margin-top:6px">
                        <div class="panel-heading">
                            <h4 class="text-center text-bold">Courses and Programs Allocation Form</h4>
                        </div>

                        <section class="panel-body">
                            <form name="data" id="form-data"
                                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <div class="form-group all">
                                    <label for="initCode" class="form-check-label" >Unit Code</label>
                                    <input type="text" name="unitCode" class="form-control"
                                           autocomplete="off" placeholder="Enter Unit Code" id="unitCode"
                                           required>
                                </div>

                                <div class="parent">
                                    <div class="form-group child">
                                        <label for="program">Select Program:</label>
                                        <select class="form-control" id="program" name="program">
                                            <option>----Programs-----</option>
                                            <?php $programView = new ProgramsView();
                                            $rows = $programView->getAllPrograms();

                                            foreach($rows as $row){
                                                echo "<option value='$row[id]'>". $row['name']. "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group child">
                                        <label for="course">Select Course:</label>
                                        <select class="form-control" id="course" name="course">
                                            <option>----Courses-----</option>
                                            <?php $courseView = new CoursesView();
                                            $rows = $courseView->getAllCourses();

                                            foreach($rows as $row){
                                                echo "<option value='$row[id]'>". $row['name']. "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
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

            <?php include '../../../../inc/footer.php'; ?>
        </div>

        <script src="/attendance/public/js/programsCourses.js"></script>

        <script src="../../../public/js/secretaryHome.js"></script>

</body>


