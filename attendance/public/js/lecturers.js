$(document).ready(function () {

    showAllLecturers();

    showLecturersStatistics();

    var clearField = document.getElementById('clearBtn') , rIndex;


    clearField.onclick = function(){
        $("#lecturer-data")[0].reset();
    }

    function showLecturersStatistics() {
        $.ajax({
            url: "statisticsAction.php",
            type: "POST",
            data: {action: "statistics"},
            success: function (response) {
                let data = JSON.parse(response);
                $("#allLecturersLbl").text(data[0]);

            }
        });
    }

    function showAllLecturers() {
        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showLecturers").html(response);
                $("#lecturerTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

                var table = document.getElementById('lecturerTable') , rIndex;

                for(var i = 0 ; i < table.rows.length ; i++){
                    table.rows[i].onclick = function(){
                        rIndex = this.rowIndex
                        document.getElementById('lecturerID').value = this.cells[0].innerHTML
                        document.getElementById('lecturerFname').value = this.cells[1].innerHTML
                        document.getElementById('lecturerLname').value = this.cells[2].innerHTML
                        let gender = this.cells[3].innerHTML

                        if(gender === "male"){
                            radio = document.getElementById('male');
                            radio.checked = true;
                        }else{
                            radio = document.getElementById('male');
                            radio.checked = false;
                        }

                        if(gender === "female"){
                            radio = document.getElementById('female');
                            radio.checked = true;
                        }else{
                            radio = document.getElementById('female');
                            radio.checked = false;
                        }

                        if(gender == null){
                            radio = document.getElementById('male');
                            radio.checked = true;
                        }

                        document.getElementById('phone').value = this.cells[4].innerHTML
                        document.getElementById('email').value = this.cells[5].innerHTML
                    }
                };

            }
        });
    }



    //insert Course ajax requests
    $("#saveBtn").click(function (e) {
            if ($("#lecturer-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#lecturer-data").serialize() + "&action=create",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 3500);

                        $("#lecturer-data")[0].reset();
                        showAllLecturers();
                        showLecturersStatistics();

                    }
                });
            }else{
                alert("Please Check your input and try again\n Make sure you complete the form");
            }
    });


    //when delete button is clicked
    $("#delBtn").click(function (e) {

        if ($("#lecturer-data")[0].checkValidity()) {
            e.preventDefault();

            if (confirm("Are you Sure, You want to delete this Lecture!?")) {
                $.ajax({
                    url: "deleteAction.php",
                    type: "POST",
                    data: $("#lecturer-data").serialize() + "&action=delete",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 3500);

                        $("#lecturer-data")[0].reset();
                        showAllLecturers();
                        showLecturersStatistics();

                    }
                });
            }
        }else{
            alert("Click the Lecturer you want to Delete from the Table ");
        }

    });


    //update student ajax requests
    $("#editBtn").click(function (e) {

            if ($("#lecturer-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#lecturer-data").serialize() + "&action=update",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 3500);

                        $("#lecturer-data")[0].reset();
                        showAllLecturers();
                        showLecturersStatistics();

                    }
                });
            }else{
                    alert("Click the Lecturer you want to Edit from the Table ");
                }


    });

});