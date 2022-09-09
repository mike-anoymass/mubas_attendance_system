$(document).ready(function () {
    showStudents();

    $('#intake').change(function(e){
        showStudents(e.target.value)

        if(e.target.value === "----Intakes-----")
            showStudents();
    })



    function showStudents(value = "none") {
        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "view", value: value},
            success: function (response) {
                $("#showTable").html(response);
                $("#studentsTable").dataTable();

                $("#checkAll").click(function () {
                    $("input[name='students']").prop('checked', this.checked);
                })

                $("#studentRegister").click(function (e) {
                    e.preventDefault();
                    var absentStudents = []
                    var presentStudents = []
                    var absentLecturer = []
                    var presentLecturer = []

                    $(".studentR:checked").each(function(i){
                        presentStudents[i] = $(this).val()
                    })

                    $(".studentR:checkbox:not(:checked)").each(function(i){
                        absentStudents[i] = $(this).val()
                    })

                    $(".lecturerR:checked").each(function(i){
                        presentLecturer[i] = $(this).val()
                    })

                    $(".lecturerR:checkbox:not(:checked)").each(function(i){
                        absentLecturer[i] = $(this).val()
                    })

                    if (confirm("Are you Sure, You want to Register This attendance?")) {
                        $.ajax({
                            url: "registerAttendanceAction.php",
                            type: "POST",
                            data: {
                                presentStudents: presentStudents,
                                absentStudents:absentStudents,
                                presentLecturer: presentLecturer,
                                absentLecturer:absentLecturer
                            },
                            success: function (response) {
                                $("#message").slideDown();

                                $("#message").html(response);
                                setTimeout(function (){
                                    $("#message").hide()
                                    //location = "/attendance/views/secretary&labTech/courses&lecturers/";
                                }, 2500);

                            }
                        });
                    }


                })
            }
        });
    }

});