
$(document).ready(function () {

    showHistory()
    showStatistics();


    function showStatistics() {

        $.ajax({
            url: "lecturerStatisticsAction.php",
            type: "POST",
            data: {action: "statistics"},
            success: function (response) {
                let data = JSON.parse(response);

                $("#totalLbl").text(data[0]);
                $("#presentLbl").text(data[1]);
                $("#absentLbl").text(data[2]);
                showChart(data[1], data[2]);

            }
        });
    }

    function showChart(present, absent) {

        var barChartCanvas = $('#canvas').get(0).getContext('2d')
        var barChart = new Chart(barChartCanvas)
        var barChartData = {
            labels  : ['Present', 'Absent'],
                datasets: [{
                            label : 'Attendance',
                            fillColor: 'rgba(60,141,188,0.9)',
                            strokeColor: 'rgba(60,141,188,0.8)',
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: [present,absent]
                            }
                ]
             }

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
        barStrokeWidth          : 1,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = true

    var myChart = barChart.Bar(barChartData, barChartOptions)
    }

    function showHistory() {
        $.ajax({
            url: "lecturerActionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showHistory").html(response);
                $("#historyTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

                $("#deleteBtn").click(function (e) {

                    if (confirm("Are you Sure, You want to Clear Attendance History!?")) {
                        $.ajax({
                            url: "deleteLecturerAttendances.php",
                            type: "POST",
                            data: {action: "delete"},
                            success: function (response) {
                                $("#message").slideDown();
                                $("#message").html(response);

                                setTimeout(function () {
                                    $("#message").hide()
                                    location.reload();
                                }, 2000);
                            }
                        });

                    }
                });




            }
        });
    }

    $("body").on("click", ".infoBtn", function (e) {
        let infoBtnID = $(this).attr('id');
        $.ajax({
            url: "lecturerDetailsAction.php",
            type: "POST",
            data: {infoBtnID: infoBtnID},
            success: function (response) {
                data = JSON.parse(response);
                $('#course').text(data[0].name);
                $('#program').text(data[0].programID);
                $('#date').text(data[0].dayOfWeek);
                $('#startTime').text(data[0].startTime);
                $('#endTime').text(data[0].endTime);
                $('#room').text(data[0].room);
            }
        })

    });

    $("#report").click(function (e) {
        $("#message").html("<p class='alert alert-info'>Generating Report: Please Wait..</p>");

        setTimeout(function () {
            $("#message").hide()

        }, 3000);
    })




})

