
$(document).ready(function () {
        showStudents()
        showLecturers()
        showStatistics()

        function refresh() {
            showStudents();
        }


        $('#intake').change(function (e) {
            showStudents(e.target.value)

            if (e.target.value === "----Intakes-----")
                refresh()
        })


        function showStatistics() {
            $.ajax({
                url: "statisticsAction.php",
                type: "POST",
                data: {action: "statistics"},
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#allStudentsLbl").text(data[0]);
                    $("#allLecturersLbl").text(data[1]);

                }
            });
        }

        function showStudents(value = "none") {
            $.ajax({
                url: "actionView.php",
                type: "POST",
                data: {action: "viewAllStudents", value: value},
                success: function (response) {
                    $("#showStudentTable").html(response);
                    $("#allStudentsTable").DataTable({
                        order: [0, 'desc'] ///order by current entry
                    });

                }
            });
        }

        function showLecturers() {
            $.ajax({
                url: "actionView.php",
                type: "POST",
                data: {action: "viewLecturers"},
                success: function (response) {
                    $("#showLecturerTable").html(response);
                    $("#lecturerTable").DataTable({
                        order: [0, 'desc'] ///order by current entry
                    });

                }
            })
        }
    //when delete button from the table is clicked
    $("body").on("click", ".historyLectBtn", function (e) {

        e.preventDefault();
        let historyLectBtnID = $(this).attr('id');

        $.ajax({
            url: "initializeSessionVars.php",
            type: "POST",
            data: {historyLectBtnID :historyLectBtnID },
            success: function (response) {
                $("#message").slideDown();
                $("#message").html(response);

                setTimeout(function (){
                    $("#message").hide()
                    location = "lecturerHistory.php";
                }, 1000);
            }
        });

    });

    //when delete button from the table is clicked
    $("body").on("click", ".historyStudBtn", function (e) {

        e.preventDefault();
        let attendanceBtnID = $(this).attr('id');

        $.ajax({
            url: "initializeSessionVars.php",
            type: "POST",
            data: {attendanceBtnID :attendanceBtnID },
            success: function (response) {
                $("#message").slideDown();
                $("#message").html(response);

                setTimeout(function (){
                    $("#message").hide()
                    location = "studentHistory.php";
                }, 1000);
            }
        });

    });

})

