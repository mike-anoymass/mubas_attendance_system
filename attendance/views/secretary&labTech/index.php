<?php
require_once "../../inc/header.php";
require_once "../../inc/scripts.php";
require_once "../../inc/classAutoload.inc.php";
?>

<?php
Session::start();

if(Session::get("sessionVars")){

}else{
    header("Location: ../../");
}
?>

<body>
    <?php include '../../inc/secretary&labTechNav.php'; ?>
    <div  class="well well-sm text-center text-bold" style="font-size: 18px" >
        <i class="fa fa-home"></i> Home
    </div>
    <div class="container">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <h3 class="box-title text-center">Attendance Statistics</h3>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <?php
                        $view = new AttendanceView();
                        $number = $view->countLecturerAttendanceForToday();
                        echo "<h3> $number </h3>";
                        ?>

                        <p>Today's Lecturer Attendance</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="../allUsers/attendanceHistory/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <?php
                        $view = new AttendanceView();
                        $number = $view->countLecturerPresenceForToday();
                        echo "<h3> $number </h3>";
                        ?>

                        <p>Attended Classes Today (Lecturers)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clock"></i>
                    </div>
                    <a href="../allUsers/attendanceHistory/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <?php
                        $view = new AttendanceView();
                        $number = $view->countStudentAttendanceForToday();
                        echo "<h3> $number </h3>";
                        ?>
                        <p>Today's Student Attendance</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="../allUsers/attendanceHistory/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-fuchsia">
                    <div class="inner">
                        <?php
                        $view = new AttendanceView();
                        $number = $view->countStudentPresenceForToday();
                        echo "<h3> $number </h3>";
                        ?>

                        <p>Attended Classes Today (Students)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-alert-circled"></i>
                    </div>
                    <a href="../allUsers/attendanceHistory/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <h3 class="box-title text-center">Attendance Summary</h3>

                    <div style="width:25px; height:20px;
                                background-color: rgba(210, 214, 222, 1); display: inline-block"></div>Total Classes
                    &nbsp;&nbsp;&nbsp;

                    <div style="width:25px; height:20px; background-color: green; display: inline-block"></div>Present
                    &nbsp;&nbsp;&nbsp;
                    <div style="width:25px; height:20px; background-color: red; display: inline-block"></div> Absent

                    <div class="box-body">

                        <div class="chart">
                            <br>
                            <div id="legend" class="text-center"></div>
                            <canvas id="barChart" style="height:350px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    </div>
    </div>

    <?php include '../../inc/footer.php'; ?>

    <?php
    $view = new AttendanceView();

    $totalLecturer = $view->countAttendanceForLecturers();
    $totalStudent = $view->countAttendanceForStudents();

    $totalPresenceLect = $view->countAllLecturerPresence();
    $totalPresenceStud = $view->countAllStudentPresence();

    $totalAbsenceLect = $view->countAllLecturerAbsence();
    $totalAbsenceStud = $view->countAllStudentAbsence();

    ?>

    <script>
        $(function(){
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChart = new Chart(barChartCanvas)
            var barChartData = {
                labels  : ['Lecturers', 'Students' ],
                datasets: [
                    {
                        label               : 'Total Classes',
                        fillColor           : 'rgba(210, 214, 222, 1)',
                        strokeColor         : 'rgba(210, 214, 222, 1)',
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [<?php echo $totalLecturer;?>,<?php echo $totalStudent;?>]
                    },
                    {
                        label               : 'Present',
                        fillColor           : 'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [<?php echo $totalPresenceLect;?>,<?php echo $totalPresenceStud;?>]
                    },
                    {
                        label               : 'Absent',
                        fillColor           : 'red',
                        strokeColor         : 'blue',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [<?php echo $totalAbsenceLect;?>,<?php echo $totalAbsenceStud;?>]
                    }
                ]
            }
            barChartData.datasets[1].fillColor   = '#00a65a'
            barChartData.datasets[1].strokeColor = '#00a65a'
            barChartData.datasets[1].pointColor  = '#00a65a'
            var barChartOptions                  = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero        : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : true,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                //Boolean - If there is a stroke on each bar
                barShowStroke           : true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth          : 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing         : 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing       : 1,
                //Boolean - whether to make the chart responsive
                responsive              : true,
                maintainAspectRatio     : true
            }

            barChartOptions.datasetFill = false
            var myChart = barChart.Bar(barChartData, barChartOptions)
            //document.getElementById('legend').innerHTML = myChart.generateLegend();
        });
    </script>


</body>
