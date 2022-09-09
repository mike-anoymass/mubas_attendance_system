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
        <?php include '../../../inc/adminNav.php'; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="container-fluid">
            <!-- Content Header (Page header) -->
                <div  class="well well-sm text-center text-bold" style="font-size: 20px" >
                    <i class="fa fa-pencil"></i> Courses
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <h4>
                            <a href="#">All Courses&nbsp; <span class="badge" id="allCoursesLbl"></span></a>
                        </h4>
                    </div>

                    <div class="col-sm-6">
                         <div id="message" class="text-center"></div>
                    </div>

                    <div class="col-sm-3">
                        <a href="exportAction.php?export=excel" class="btn btn-primary pull-right">
                            <i class="fa fa-table fa-lg">&nbsp;Export Courses list to Excel</i>
                        </a>

                    </div>
                </div>

            <!-- Main content -->

                <hr class="m-lg-2">

            <div class="row">
                <div class="col-sm-5">
                    <div class="panel panel-default" style="margin-top:6px">
                        <div class="panel-heading">
                            <h4 class="text-center text-bold">Courses Form</h4>
                        </div>

                        <section class="panel-body">
                            <form id="course-data"
                                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <div class="form-group">
                                    <label for="courseID" class="form-check-label" >Course ID</label>
                                    <input type="text" name="courseID" class="form-control"
                                           autocomplete="off" placeholder="Enter Course ID" id="courseID"
                                           required>
                                </div>

                                <br>

                                <div class="form-group">
                                    <label for="courseName" class="form-check-label" >Course Name</label>
                                    <input type="text" name="courseName" class="form-control"
                                           autocomplete="off" placeholder="Enter Course Name"
                                           id="courseName"
                                           pattern="[a-zA-Z\s]+" title="only text allowed" required>
                                </div>

                                <div class="form-group">
                                    <label for="credit" class="form-check-label" >Credit</label>
                                    <input type="text" name="credit" class="form-control"
                                           autocomplete="off" placeholder="Enter Course Credit"
                                           id="credit"
                                           pattern="[0-9]+" title="only numbers allowed" required>
                                </div>

                                <div class="form-group">
                                    <label for="level" class="form-check-label" >Level</label>
                                    <input type="text" name="level" class="form-control"
                                           autocomplete="off" placeholder="Enter Level"
                                           id="level"
                                           pattern="[0-9]+" title="only numbers allowed" required>
                                </div>

                        </section>

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-2">
                                    <button type="submit" class="button btn-primary" id="saveBtn">Save</button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="button btn-success" id="editBtn">Update</button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="button btn-warning" id="clearBtn">Clear</button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="button btn-danger" id="delBtn">Delete</button>
                                </div
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-sm-7">

                    <div id="showCourses">
                        <div class="alert alert-success text-center text-bold">
                            Loading data...
                        </div>
                    </div>
                </div>

            </div>

            <?php include '../../../inc/footer.php'; ?>
        </div>


    <script src="/attendance/public/js/courses.js"> </script>

</body>

