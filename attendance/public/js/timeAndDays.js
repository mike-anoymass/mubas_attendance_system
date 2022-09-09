$(document).ready(function () {
    showTime()
    showDays()


    function validateTime(){
        if($("#startTime").val() === ""){
            alert("Please Enter Starting Time");
            return false;
        }

        if($("#finishTime").val() === ""){
            alert("Please Enter Ending Time");
            return false;
        }

        if($("#finishTime").val() <= $("#startTime").val()){
            alert("Please Check the Start Time and End Time \n=>Time Should be realistic");
            return false;
        }

        return true;
    }

   function validateDay(){
       //validate days
       let daysObj = document.getElementById("day")
       let day = daysObj.options[daysObj.selectedIndex].text


       if (day === "----Days-----") {
           alert("Please Select a Day!");
           return false;
       }

      return true;
   }

    function showTime() {
        $.ajax({
            url: "timeActionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showTime").html(response);
                $("#timesTable").DataTable();
            }
        });
    }

    function showDays() {
        $.ajax({
            url: "daysActionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showDays").html(response);
                $("#daysTable").DataTable();
            }
        });
    }



    $("#saveTimeBtn").click(function (e) {
        if(validateTime()){
            if ($("#data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#data").serialize() + "&action=createTime",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 4000);

                        $("#data")[0].reset();
                        showTime();

                    }
                });
            }else{
                alert("Please Check your input and try again\n Make sure you complete the form");
            }
        }else {
            e.preventDefault();
        }

    });

    $("#saveDaysBtn").click(function (e) {
        if(validateDay()){
            if ($("#form-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#form-data").serialize() + "&action=createDay",
                    success: function (response) {
                        $("#message").slideDown();

                        $("#message").html(response);
                       setTimeout(function (){
                            $("#message").hide()
                        }, 4000);

                        $("#form-data")[0].reset();
                        showDays();

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
    $("body").on("click", ".delTimeBtn", function (e) {

        e.preventDefault();
        let delBtnID = $(this).attr('id');

        if(confirm("Are you Sure, You want to delete \n This action will delete any allocations you have made using this time range!?")){
            $.ajax({
                url: "deleteTimeAction.php",
                type: "POST",
                data: {delBtnID:delBtnID},
                success: function (response) {
                    $("#message").slideDown();
                    $("#message").html(response);

                    setTimeout(function (){
                        $("#message").hide()
                    }, 3500);

                    showTime();

                }
            });
        }

    });

    //when delete button from the table is clicked
    $("body").on("click", ".delDayBtn", function (e) {

        e.preventDefault();
        let delBtnID = $(this).attr('id');

        if(confirm("Are you Sure, You want to delete \n This action will delete any allocations you have made using this day!?!?")){
            $.ajax({
                url: "deleteDayAction.php",
                type: "POST",
                data: {delBtnID:delBtnID},
                success: function (response) {
                    $("#message").slideDown();
                    $("#message").html(response);

                    setTimeout(function (){
                        $("#message").hide()
                    }, 3500);

                    showDays();

                }
            });
        }

    });


});