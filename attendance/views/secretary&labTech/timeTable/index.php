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
        <div class="container-fluid parent">


            <div id="showTable">
                <div class="alert alert-success text-center text-bold">
                    Loading data...
                </div>
            </div>


             <?php require_once "../../../inc/edit_password_modal.php"; ?>
            <?php require_once "../../../inc/program_modal.php"; ?>

            <?php include '../../../inc/footer.php'; ?>
        </div>

        <script src="/attendance/public/js/lecturerCourses.js"></script>

        <script src="../../../public/js/secretaryHome.js"></script>

</body>


