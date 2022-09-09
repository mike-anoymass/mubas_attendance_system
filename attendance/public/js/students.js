
$(document).ready(function () {
    $("#upload_csv").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url:"importAction.php",
            method: "POST",
            data: new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                $("#upload_csv")[0].reset();

                $("#message").slideDown();

                $("#message").html(data);
                setTimeout(function (){
                    $("#message").hide()
                    location.reload();
                }, 2000);

            }
        })
    })


    showCertifiedStudents()
    showUncertifiedStudents()
    showStudentsStatistics()

   $('#category').change(function(e){
       switch (e.target.value){
           case "----Choose What to See-----":
               showAllStudents()
               break

           case "All Students":
               showAllStudents()
               break

           case "Collected Certificates":
               showCertifiedStudents()
               break
       }
   })

    $("#refresh").click(function (e) {
        refresh()
    })

    function refresh(){
        showCertifiedStudents("none")
        showUncertifiedStudents("none")
        showStudentsStatistics()
    }


    $('#intake').change(function(e){
        showCertifiedStudents(e.target.value)
        showUncertifiedStudents(e.target.value)

        if(e.target.value === "----Intakes-----")
            refresh()
    })




    function showStudentsStatistics() {
        $.ajax({
            url: "statisticsAction.php",
            type: "POST",
            data: {action: "statistics"},
            success: function (response) {
                let data = JSON.parse(response);
                $("#allStudentsLbl").text(data[0]);
                $("#certifiedStudentsLbl").text(data[1]);
                $("#uncertidiedStudentsLbl").text(data[2]);

            }
        });
    }

    function showAllStudents(value = "none") {
        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "viewAllStudents", value: value},
            success: function (response) {
                $("#showTable").html(response);
                $("#allStudentsTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

            }
        });
    }

    function showUncertifiedStudents(value = "none") {

        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "viewUncertifiedStudents", value: value },
            success: function (response) {
                $("#showTable1").html(response);
                $("#uncertifiedStudentsTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

                $("#checkAll").click(function () {
                    $("input[name='students']").prop('checked', this.checked);
                })

                $("#certify").click(function (e) {
                        e.preventDefault();
                        var studentIDs = []
                        $(".students:checked").each(function(i){
                            studentIDs[i] = $(this).val()
                        })

                        if(studentIDs.length !== 0){
                            $.ajax({
                                url: "certifyAction.php",
                                type: "POST",
                                data: {studentIDs: studentIDs},
                                success: function (response) {
                                    $("#message").slideDown();

                                    $("#message").html(response);
                                    setTimeout(function (){
                                        $("#message").hide()
                                        location.reload();
                                    }, 2500);

                                }
                            });
                        }else{
                            alert("Please Tick on the Students")
                        }


                })

                $("#delete").click(function (e) {
                    e.preventDefault();
                    var studentIDs = []
                    $(".students:checked").each(function(i){
                        studentIDs[i] = $(this).val()
                    })

                    if(studentIDs.length !== 0){

                        if (confirm("Are you Sure, You want to delete student(s)!?")) {
                            $.ajax({
                                url: "deleteAction.php",
                                type: "POST",
                                data: {studentIDs: studentIDs},
                                success: function (response) {
                                    $("#message").slideDown();

                                    $("#message").html(response);
                                    setTimeout(function (){
                                        $("#message").hide()
                                        location.reload();
                                    }, 2500);

                                }
                            });
                        }

                    }else{
                        alert("Please Tick on the Students")
                    }


                })



            }
        });
    }

    function showCertifiedStudents(value = "none") {
        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "viewCertifiedStudents", value: value},
            success: function (response) {
                $("#showTable").html(response);
                $("#certifiedStudentsTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });

                $("#checkAllStudents").click(function () {
                    $("input[name='uncertifiedStudents']").prop('checked', this.checked);
                })

                $("#unCertify").click(function (e) {
                    e.preventDefault();
                    var studentIDs = []
                    $(".uncertifiedStudents:checked").each(function (i) {
                        studentIDs[i] = $(this).val()
                    })

                    if (studentIDs.length !== 0) {

                        if (confirm("Are you Sure, You want to remove certificates !?")){
                            $.ajax({
                                url: "uncertifyAction.php",
                                type: "POST",
                                data: {studentIDs: studentIDs},
                                success: function (response) {
                                    $("#message").slideDown();

                                    $("#message").html(response);
                                    setTimeout(function () {
                                        $("#message").hide()
                                        location.reload();
                                    }, 2500);
                                }
                            });
                        }

                    } else {
                        alert("Please Tick on the Students")
                    }
                })

                $("body").on("click", ".infoBtnii", function (e) {

                    let infoBtnID = $(this).attr('id');
                    $.ajax({
                        url: "detailsAction.php",
                        type: "POST",
                        data: {infoBtnID: infoBtnID},
                        success: function (response) {
                            data = JSON.parse(response);
                            $('#infoID').text(data[0].id);
                            $('#infoFname').text(data[0].firstname);
                            $('#infoLname').text(data[0].lastname);
                            $('#prg').text(data[0].program);
                            $('#date').text(data[0].date);
                            $('#issuer').text(data[0].issuer);

                            var intake = data[0].start + " To " +  data[0].end + " " +  data[0].year

                            $('#intakePeriod').text(intake);

                        }
                    })

                });

            }
        });
    }
});