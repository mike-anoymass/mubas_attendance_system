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
               <i class="fa fa-users"></i> Lecturers
            </div>

                <div class="row">
                    <div class="col-sm-3">
                        <h4>
                            <a href="#">All Lecturers&nbsp; <span class="badge" id="allLecturersLbl"></span></a>
                        </h4>
                    </div>

                    <div class="col-sm-6">
                        <div id="message" class="text-center"></div>
                    </div>

                    <div class="col-sm-3">
                        <a href="exportAction.php?export=excel" class="btn btn-sm btn-success pull-right">
                            <i class="fa fa-table fa-lg">&nbsp;Export Lecturer List to Excel</i>
                        </a>
                    </div>
                </div>


            <!-- Main content -->

                <hr class="m-lg-2">
            <div class="row">
                <div class="col-sm-5">
                    <div class="panel panel-default" style="margin-top:6px">
                        <div class="panel-heading">
                            <h4 class="text-center text-bold">Lecturer Form</h4>
                        </div>

                        <section class="panel-body">
                            <form name="data" id="lecturer-data"
                                  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <div class="form-group">
                                    <label for="lecturerID" class="form-check-label" >Lecturer ID</label>
                                    <input type="text" name="lecturerID" class="form-control"
                                           autocomplete="off" placeholder="Enter Lecturer ID" id="lecturerID"
                                           required>
                                </div>

                                <br>

                                <div class="form-group">
                                    <label for="lecturerFname" class="form-check-label" >First Name</label>
                                    <input type="text" name="lecturerFname" class="form-control"
                                           autocomplete="off" placeholder="Enter First name" id="lecturerFname"
                                            pattern="[a-zA-Z\s]+" title="only text allowed" required>
                                </div>

                                <div class="form-group">
                                    <label for="lecturerLname" class="form-check-label" >Last Name</label>
                                    <input type="text" name="lecturerLname" class="form-control"
                                           autocomplete="off" placeholder="Enter Last name" id="lecturerLname"
                                           pattern="[a-zA-Z\s]+" title="only text allowed" required>
                                </div>

                                <div class="form-check">
                                    <input type="radio" name="gender" id="male"
                                           class="form-check-input" value="male" checked>
                                    <label for="male" class="form-check-label" >Male</label>

                                    <?php for ($i = 0; $i < 15; $i++) echo "&nbsp;" ?>

                                    <input type="radio" name="gender" id="female"
                                           class="form-check-input" value="female">
                                    <label for="female" class="form-check-label">Female</label>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="form-check-label" >Phone Number</label>
                                    <input type="phone" name="phone" class="form-control"
                                           autocomplete="off" placeholder="Telephone" id="phone"
                                           pattern="[0-9\s]+" title="Only Numbers allowed" required>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-check-label" >Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           autocomplete="off" placeholder="Email Address" required>
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
                    <div id="showLecturers">

                        <div class="alert alert-success text-center text-bold">
                            Loading data...
                        </div>
                    </div>
                </div>

            </div>

            <?php include '../../../inc/footer.php'; ?>
        </div>

    <script src="/attendance/public/js/lecturers.js"> </script>

</body>

