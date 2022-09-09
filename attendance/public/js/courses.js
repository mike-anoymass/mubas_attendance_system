$(document).ready(function () {

    showAllCourses();

    showCoursesStatistics();

    var clearField = document.getElementById('clearBtn') , rIndex;


    clearField.onclick = function(){
        $("#course-data")[0].reset();
    }

    function showCoursesStatistics() {
        $.ajax({
            url: "statisticsAction.php",
            type: "POST",
            data: {action: "statistics"},
            success: function (response) {
                let data = JSON.parse(response);
                $("#allCoursesLbl").text(data[0]);

            }
        });
    }

    function showAllCourses() {
        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showCourses").html(response);
                $("#coursesTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

                var table = document.getElementById('coursesTable') , rIndex;

                for(var i = 0 ; i < table.rows.length ; i++){
                    table.rows[i].onclick = function(){
                        rIndex = this.rowIndex
                        document.getElementById('courseID').value = this.cells[0].innerHTML
                        document.getElementById('courseName').value = this.cells[1].innerHTML
                        document.getElementById('credit').value = this.cells[2].innerHTML
                        document.getElementById('level').value = this.cells[3].innerHTML
                    }
                };

            }
        });
    }



    //insert Course ajax requests
    $("#saveBtn").click(function (e) {
            if ($("#course-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#course-data").serialize() + "&action=create",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 3500);

                        $("#course-data")[0].reset();
                        showAllCourses();
                        showCoursesStatistics();
                    }
                });
            }else{
                alert("Please Check your input and try again\n Make sure you complete the form");
            }
    });


    //when delete button is clicked
    $("#delBtn").click(function (e) {

        if ($("#course-data")[0].checkValidity()) {
            e.preventDefault();

            if (confirm("Are you Sure, You want to delete this Course!?")) {
                $.ajax({
                    url: "deleteAction.php",
                    type: "POST",
                    data: $("#course-data").serialize() + "&action=delete",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 3500);

                        $("#course-data")[0].reset();
                        showAllCourses();
                        showCoursesStatistics();

                    }
                });
            }
        }else{
            alert("Click the program you want to Delete from the Table ");
        }

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
                        }, 3500);

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