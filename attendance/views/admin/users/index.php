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
                <i class="fa fa-user"></i> Users
            </div>

                <div class="row">
                    <div class="col-sm-3">
                        <h4>
                            <a href="#">All Users&nbsp; <span class="badge" id="allUserLbl"></span></a>
                        </h4>
                    </div>

                    <div class="col-sm-6">
                        <div id="message" class="text-center"></div>
                    </div>

                    <div class="col-sm-3">
                        <a href="exportAction.php?export=excel" class="btn btn-sm btn-success pull-right">
                            <i class="fa fa-table fa-lg">&nbsp;Export to Excel</i>
                        </a>

                        <button type="button" class="btn btn-sm btn-primary pull-right" style="margin-right:3px"
                                data-toggle="modal" data-target="#userAdd">
                            <i class="fa fa-user-plus fa-lg">&nbsp; New User </i>
                        </button>
                    </div>
                </div>


            <!-- Main content -->

                <hr class="m-lg-2">
                <div class="table-responsive" id="showUsers">
                    <div class="alert alert-success text-center text-bold">
                        Loading data...
                    </div>
                </div>

            <?php include '../../../inc/footer.php'; ?>
        </div>

    <?php include '../../../inc/new_user_modal.php'; ?>

        <?php include '../../../inc/edit_user_modal.php'; ?>

    <script src="/attendance/public/js/users.js"> </script>

</body>

