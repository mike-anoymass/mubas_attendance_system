$(document).ready(function () {
    showAllPrograms();

    showProgramsStatistics();

    var clearField = document.getElementById('clearBtn') , rIndex;


    clearField.onclick = function(){
        $("#form-data")[0].reset();
    }

    function showProgramsStatistics() {
        $.ajax({
            url: "statisticsAction.php",
            type: "POST",
            data: {action: "statistics"},
            success: function (response) {
                let data = JSON.parse(response);
                $("#allPrgLbl").text(data[0]);

            }
        });
    }

    function showAllPrograms() {
        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showPrograms").html(response);
                $("#programsTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

                var table = document.getElementById('programsTable') , rIndex;

                for(var i = 0 ; i < table.rows.length ; i++){
                    table.rows[i].onclick = function(){
                        rIndex = this.rowIndex

                        document.getElementById('programID').value = this.cells[0].innerHTML
                        document.getElementById('programName').value = this.cells[1].innerHTML
                        document.getElementById('tuition').value = this.cells[2].innerHTML
                    }
                }
            }
        });
    }

    //insert Program ajax requests
    $("#saveBtn").click(function (e) {

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
                        }, 3500);

                        $("#form-data")[0].reset();
                        showAllPrograms();
                        showProgramsStatistics();

                    }
                });
            }else{
                alert("Please Check your input and try again\n Make sure you complete the form");
            }
    });


    //when delete button is clicked
    $("#delBtn").click(function (e) {

        if ($("#form-data")[0].checkValidity()) {
            e.preventDefault();

            if (confirm("Are you Sure, You want to delete this Program!?")) {
                $.ajax({
                    url: "deleteAction.php",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=delete",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 3500);


                        $("#form-data")[0].reset();
                        showAllPrograms();
                        showProgramsStatistics();

                    }
                });
            }
        }else{
            alert("Click the program you want to Delete from the Table ");
        }

    });


    //update program ajax requests
    $("#editBtn").click(function (e) {

            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=update",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 3500);

                        $("#form-data")[0].reset();
                        showAllPrograms();
                        showProgramsStatistics();

                    }
                });
            }else{
                    alert("Click the program you want to Update from the Table ");
                }


    });

});