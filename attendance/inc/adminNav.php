<div style="background-color: dimgrey; color: white; border-radius: 5px">

<div class="container">
    <nav class="navbar navbar-static-top " style="border-radius: 10px">

        <div class="navbar-header" >
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#myNavbar1">
                <span style="background-color:white" class="icon-bar"></span>
                <span style="background-color:white" class="icon-bar"></span>
                <span style="background-color:white" class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar1">

            <ul class="nav navbar-nav ">
                <li><img src="/attendance/public/img/city&guildsLogo.png"
                         height="50px" width="40px" style="margin-top:10px"></li>
                <li style="margin-left:30px">
                    <h3 class="text-center"><b>CIT WEEKEND CLASSES ATTENDANCE SYSTEM</b></h3>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li style="margin-top:5px;">
                    <h5 class="text-capitalize" "><span class="glyphicon glyphicon-user"></span>
                    <?php echo Session::get("sessionVars", "firstName")
                            . " " .Session::get("sessionVars", "lastName")
                        ."<br>" . Session::get("sessionVars", "typeOfUser") ; ?> </h5>
                </li>
            </ul>
        </div>
    </nav>
</div>

<nav class="navbar navbar-static-top "
     style="margin-top: -15px;  background-color:#93a1a1; border-radius: 20px">

    <div class="container">
        <div class="navbar-header" >
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                     data-target="#myNavbar">
                <span style="background-color:white" class="icon-bar"></span>
                <span style="background-color:white" class="icon-bar"></span>
                <span style="background-color:white" class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav align-content-center">
                <li class="active"><a href="/attendance/views/admin/" style="color:black">HOME</a></li>
                <li><a href="/attendance/views/admin/programs/" style="color:black">PROGRAMS</a></li>
                <li><a href="/attendance/views/admin/courses/" style="color:black">COURSES</a></li>
                <li><a href="/attendance/views/admin/lecturers/" style="color:black">LECTURERS</a></li>
                <li><a href="/attendance/views/allUsers/attendanceHistory/" style="color:black">ATTENDANCE</a></li>
                <li><a href="/attendance/views/secretary&labTech/timeTable" style="color:black">TIME TABLE</a></li>
                <li><a href="/attendance/views/admin&secretary/students" style="color:black">CERTIFICATES</a></li>
                <li><a href="/attendance/views/admin/users/" style="color:black">USERS</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/attendance/logout.php" style="color:black">
                        <span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
            </ul>
        </div>
    </div>
</nav>
</div>