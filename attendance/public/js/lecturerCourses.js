$(document).ready(function () {
    showAllocations();
    showAllocationsStatistics()

   $('#category').change(function(e){
       switch (e.target.value){
           case "----Choose What to See-----":
               showAllocations()
               break

           case "Allocations":
               showAllocations()
               break

           case "Lecturers":
               showAllLecturers()
               break

           case "Courses":
               showAllCourses()
               break
       }
   })

    if($("#checkIfProgramIsSelected").val() === ""){
        $("#panel").hide()
    }else{
        $("#panel").show()
    }


    $('#programBtn').click(function (e) {

        //validate program
        let prgObj = document.getElementById("program");
        let programID = prgObj.options[prgObj.selectedIndex].value;
        let programName = prgObj.options[prgObj.selectedIndex].text;

        if(programID === "----Select Program-----"){
            e.preventDefault();
            alert("Please Select the Program to start Allocation")
        }else{
            $.ajax({
                url: "programAction.php",
                type: "POST",
                data: {programID:programID, programName:programName},
                success: function (response) {
                    $("#message").slideDown();
                    $("#message").html(response);
                    $("#selectProgram").hide()

                    setTimeout(function (){
                        $("#message").hide()
                        location.reload()
                    }, 4000);
                }
            });

        }
    })

   function validateAllocation(){
       //validate program and course
       let lecturerObj = document.getElementById("lecturer");
       let courseObj = document.getElementById("course");
       let daysObj = document.getElementById("day");
       let timeObj = document.getElementById("time");

       let lecturer = lecturerObj.options[lecturerObj.selectedIndex].text;
       let course = courseObj.options[courseObj.selectedIndex].text;
       let day = daysObj.options[daysObj.selectedIndex].text;
       let time = timeObj.options[timeObj.selectedIndex].text;

       if (lecturer === "----Lecturers-----" || lecturer === "Lecturers Do not Exist") {
           alert("Please Select a Lecturer!");
           return false;
       }

       if (course === "----Courses-----" || course === "This program does not have courses" ) {
           alert("Please Select a Course!");
           return false;
       }

       if (day === "----Days-----" || day === "Set Time and Days") {
           alert("Please Select a Day!");
           return false;
       }

       if (day === "----Hours-----" || day === "Set Time and Days") {
           alert("Please Select a Hours/Time Range!");
           return false;
       }

       if($("#room").val() === ""){
           alert("Please Enter room number");
           return false;
       }



       return true;
   }


    function showAllocationsStatistics() {
        $.ajax({
            url: "statisticsAction.php",
            type: "POST",
            data: {action: "statistics"},
            success: function (response) {
                let data = JSON.parse(response);
                $("#allAllocationsLbl").text(data[0]);

            }
        });
    }

    function showAllocations() {
        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showTable").html(response);


            }
        });
    }

    function showAllCourses() {
        $.ajax({
            url: "../../admin/courses/actionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showTable").html(response);
                $("#coursesTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

            }
        });
    }

    function showPrograms() {
        $.ajax({
            url: "../../admin/programs/actionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showTable").html(response);
                $("#programsTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

            }
        });
    }

    function showAllLecturers() {
        $.ajax({
            url: "../../admin/lecturers/actionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showTable").html(response);
                $("#lecturerTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });
            }
        });
    }



    $("#saveBtn").click(function (e) {
        if(validateAllocation()){
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=create",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                       setTimeout(function (){
                            $("#message").hide()
                        }, 4000);

                        $("#form-data")[0].reset();
                        showAllocations();
                        showAllocationsStatistics();
                    }
                });
            }else{
                alert("Please Check your input and try again\n Make sure you complete the form");
            }
        }else {
            e.preventDefault();
        }

    });


    //when delete button from the table is clicked
    $("body").on("click", ".delBtn", function (e) {

        e.preventDefault();
        let delBtnID = $(this).attr('id');

        if(confirm("Are you Sure, You want to delete this Allocation!?")){
            $.ajax({
                url: "deleteAction.php",
                type: "POST",
                data: {delBtnID:delBtnID},
                success: function (response) {
                    $("#message").slideDown();
                    $("#message").html(response);

                    setTimeout(function (){
                        $("#message").hide()
                    }, 2000);

                    showAllocations();
                    showAllocationsStatistics();
                }
            });
        }
    });

    //when delete button from the table is clicked
    $("body").on("click", ".attendanceBtn", function (e) {

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
                    location = "/attendance/views/secretary&labTech/attendance/";
                }, 2000);

                showAllocations();
                showAllocationsStatistics();
            }
        });

    });


    //update Course ajax requests
    $("#editBtn").click(function (e) {

            if ($("#course-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#course-data").serialize() + "&action=update",
                    success: function (response) {

                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 2000);

                        $("#course-data")[0].reset();
                        showAllCourses();
                        showCoursesStatistics();
                    }
                });
            }else{
                    alert("Click the program you want to Update from the Table ");
                }


    });

});