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

           case "Programs":
               showPrograms()
               break

           case "Courses":
               showAllCourses()
               break
       }
   })


   function validateAllocation(){
       //validate program and course
       let programObj = document.getElementById("program");
       let courseObj = document.getElementById("course");


       let program = programObj.options[programObj.selectedIndex].text;
       let course = courseObj.options[courseObj.selectedIndex].text;

       if (program === "----Programs-----") {
           alert("Please Select a Program!");
           return false;
       }

       if (course === "----Courses-----") {
           alert("Please Select a Course!");
           return false;
       }

       if($("#unitCode").val() === ""){
           alert("Please Enter unit Code");
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
                        }, 3500);

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
                    }, 3500);

                    showAllocations();
                    showAllocationsStatistics();
                }
            });
        }

    });

});