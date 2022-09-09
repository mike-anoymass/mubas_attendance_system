<div style="background-color: #0E2231; color: white; border-radius: 5px">

<div class="container">
    <nav class="navbar navbar-static-top " >

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
                         height="50px" width="40px" style="margin-top:10px" ></li>
                <li style="margin-left:30px; " >
                    <h3 class="text-center" ><b>CIT WEEKEND CLASSES ATTENDANCE SYSTEM</b></h3>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown" >
                    <li  style="margin-top:5px; " class="dropdown-toggle" data-toggle="dropdown">
                        <h5 class="text-capitalize" ">
                            <span class="glyphicon glyphicon-user"></span>
                            <?php
                                echo Session::get("sessionVars", "firstName")
                                    . " " .Session::get("sessionVars", "lastName")
                                    ."<br>" . Session::get("sessionVars", "typeOfUser");
                                ?>
                        <span class="caret"></span>
                    </li>

                    <ul class="dropdown-menu pull-right" style="position: relative; margin-left: 5px">
                       <li>
                           <a type="button" style="margin-right:3px"
                                   data-toggle="modal" data-target="#editPassword">
                               <i class="fa fa-lock fa-lg">&nbsp; Change Password </i>
                           </a>
                       </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</div>

<nav class="navbar navbar-static-top"
     style="margin-top: -15px;  background-color:#93a1a1; border-radius: 20px" >

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
                <li class="active" ><a  style="color:black" href="/attendance/views/secretary&labTech/">HOME</a></li>
                <li id="certified" ><a style="color:black" href="/attendance/views/admin&secretary/students">CERTIFICATES</a></li>
                <li><a href="/attendance/views/allUsers/attendanceHistory/" style="color:black">ATTENDANCE</a></li>
                <li><a href="/attendance/views/secretary&labTech/programsCourses" style="color:black">PROGRAMS & COURSES</a></li>
                <li><a href="/attendance/views/secretary&labTech/courses&lecturers" style="color:black">COURSES & LECTURERS</a></li>
                <li><a href="/attendance/views/secretary&labTech/timeTable" style="color:black">TIMETABLE</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/attendance/logout.php" style="color:black">
                        <span class="glyphicon glyphicon-log-out"></span> LOGOUT</a></li>
            </ul>
        </div>
    </div>
</nav>
</div>

<form>
    <input type="hidden" value="<?php echo Session::get("sessionVars", "password"); ?>"
    id="userPassword">

    <input type="hidden" value="<?php echo Session::get("sessionVars", "typeOfUser"); ?>"
           id="userType">
</form>