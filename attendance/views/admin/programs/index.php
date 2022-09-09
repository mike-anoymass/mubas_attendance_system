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
                    <i class="fa fa-book"></i> Programs
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <h4>
                            <a href="#">All Programs&nbsp; <span class="badge" id="allPrgLbl"></span></a>
                        </h4>
                    </div>

                    <div class="col-sm-6">
                        <div id="message" class="text-center"></div>
                    </div>

                    <div class="col-sm-3">
                        <a href="exportAction.php?export=excel" class="btn btn-primary pull-right">
                            <i class="fa fa-table fa-lg">&nbsp;Export Programs list to Excel</i>
                        </a>

                    </div>
                </div>

            <!-- Main content -->

                <hr class="m-lg-2">

            <div class="row">
                <div class="col-sm-5">
                    <div class="panel panel-default" style="margin-top:6px">
                        <div class="panel-heading">
                            <h4 class="text-center text-bold">Programs Form</h4>
                        </div>

                        <section class="panel-body">
                            <form name="data" id="form-data"
                                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <div class="form-group">
                                    <label for="programID" class="form-check-label" >Program ID</label>
                                    <input type="text" name="programID" class="form-control"
                                           autocomplete="off" placeholder="Enter Program ID" id="programID"
                                            required>
                                </div>

                                <br>

                                <div class="form-group">
                                    <label for="programName" class="form-check-label" >Program Full Name</label>
                                    <input type="text" name="programName" class="form-control"
                                           autocomplete="off" placeholder="Enter Program Name" id="programName"
                                           pattern="[a-zA-Z\s]+" title="only text allowed" required>
                                </div>

                                <div class="form-group">
                                    <label for="tuition" class="form-check-label" >Tuition Fee</label>
                                    <input type="number" name="tuition" class="form-control"
                                           autocomplete="off" placeholder="Enter Tuition Fee" id="tuition"
                                           title="only numbers allowed" required>
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
                                </div>
                            </div>

                        </div>
                    </div>
                    </form>

                </div>

                <div class="col-sm-7">
                    <div id="showPrograms">

                        <div class="alert alert-success text-center text-bold">
                            Loading data...
                        </div>
                    </div>
                </div>

            </div>

            <?php include '../../../inc/footer.php'; ?>
        </div>


    <script src="/attendance/public/js/programs.js"> </script>

</body>

