$(document).ready(function () {

    showAllUsers();

    showUserStatistics();

    function showUserStatistics() {
        $.ajax({
            url: "statisticsAction.php",
            type: "POST",
            data: {action: "statistics"},
            success: function (response) {
                let data = JSON.parse(response);
                $("#allUserLbl").text(data[0]);
            }
        });
    }

    function showAllUsers() {
        $.ajax({
            url: "actionView.php",
            type: "POST",
            data: {action: "view"},
            success: function (response) {
                $("#showUsers").html(response);
                $("#userTable").DataTable({
                    order: [0, 'desc'] ///order by current entry
                });
            }
        });
    }

    //insert student ajax requests
    $("#create").click(function (e) {

        //validate type of user
        let type = document.getElementById("typeOfUser");
        let typeOfUser= type.options[type.selectedIndex].text;

        //validate password
        let password1 = $("#password1").val();
        let password2 = $("#password2").val();

        if (typeOfUser === "----Select Type-----") {
            alert("Please Select type of the user");
            e.preventDefault();
        }else if(password1 !== password2){
            alert("Passwords you entered don't match");
            e.preventDefault();
        } else {
            if ($("#data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#data").serialize() + "&action=create",
                    success: function (response) {

                        $("#userAdd").modal('hide');
                        $("#data")[0].reset();
                        showAllUsers();
                        showUserStatistics();

                        $("#message").slideDown();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 2500);
                    }
                });
            }else{
                alert("Please Check your input and try again\n Make sure you complete the form");
            }

        }

    });

    //when edit button from the table is clicked
    $("body").on("click", ".editBtn", function (e) {
        e.preventDefault();
        let editBtnID = $(this).attr('id');
        $.ajax({
            url: "detailsAction.php",
            type: "POST",
            data: {editBtnID:editBtnID},
            success: function (response) {
                data = JSON.parse(response);

                //filling fields for students personal details
                $('#edit-firstname').val(data[0].firstname);
                $('#edit-lastname').val(data[0].lastname);
                $('#edit-username').val(data[0].username);
                $('#edit-phone').val(data[0].phone);
                $('#edit-email').val(data[0].email);
                $('#edit-password1').val(data[0].password);

                if(data[0].gender == "male"){
                    radio = document.getElementById('edit-male');
                    radio.checked = true;
                }else{
                    radio = document.getElementById('edit-male');
                    radio.checked = false;
                }

                if(data[0].gender == "female"){
                    radio = document.getElementById('edit-female');
                    radio.checked = true;
                }else{
                    radio = document.getElementById('edit-female');
                    radio.checked = false;
                }

                if(data[0].gender == null){
                    radio = document.getElementById('edit-male');
                    radio.checked = true;
                }

                let type = document.getElementById("edit-typeOfUser");
                type.options[type.selectedIndex].text = data[0].typeOfUser;

            }
        });
    });

    //when delete button from the table is clicked
    $("body").on("click", ".delBtn", function (e) {
        e.preventDefault();
        let delBtnID = $(this).attr('id');

        if(confirm("Are you Sure, You want to delete this User!?")){
            $.ajax({
                url: "deleteAction.php",
                type: "POST",
                data: {delBtnID:delBtnID},
                success: function (response) {
                    $("#message").slideDown();
                    $("#message").html(response);
                    setTimeout(function (){
                        $("#message").hide()
                    }, 2500);

                    showAllUsers();
                    showUserStatistics();
                }
            });
        }

    });

    //when delete button from the table is clicked
    $("body").on("click", ".resetBtn", function (e) {
        e.preventDefault();
        let resetBtnID = $(this).attr('id');

        if(confirm("Are you Sure, You want to Reset Password for this user!?")){
            $.ajax({
                url: "resetPasswordAction.php",
                type: "POST",
                data: {resetBtnID:resetBtnID},
                success: function (response) {
                    $("#message").slideDown();
                    $("#message").html(response);
                    setTimeout(function (){
                        $("#message").hide()
                    }, 2500);

                    showAllUsers();
                    showUserStatistics();
                }
            });
        }

    });


    $("#update").click(function (e) {

        //validate type of user
        let type = document.getElementById("edit-typeOfUser");
        let typeOfUser= type.options[type.selectedIndex].text;

        if (typeOfUser === "----Select Type-----") {
            alert("Please Select type of the user");
            e.preventDefault();
        } else {
            if ($("#edit-data")[0].checkValidity()) {
                e.preventDefault();
                $.ajax({
                    url: "insertAndUpdateAction.php",
                    type: "POST",
                    data: $("#edit-data").serialize() + "&action=update",
                    success: function (response) {

                        $("#editUserModal").modal('hide');
                        $("#edit-data")[0].reset();
                        showAllUsers();
                        showUserStatistics();

                        $("#message").html(response);
                        setTimeout(function (){
                            $("#message").hide()
                        }, 2500);

                    }
                });
            }else{
                    alert("Please Check your input and try again\n Make sure you complete the form");
                }

        }

    });

    //when information button from the table is clicked
    $("body").on("click", ".infoBtn", function (e) {
        e.preventDefault();
        let infoBtnID = $(this).attr('id');


        $.ajax({
            url: "detailsAction.php",
            type: "POST",
            data: {infoBtnID:infoBtnID},
            success: function (response) {
                let data = JSON.parse(response);

                //filling table fields for students personal details
                $('#infoID').text(data[0].studentCode);
                $('#infoFname').text(data[0].firstName);
                $('#infoLname').text(data[0].lastName);
                $('#infoDob').text(data[0].dob);
                $('#infoCourse').text(data[0].courseCode);
                $('#infoDregistered').text(data[0].dateRegistered);

                //filling data fields for students qualification details
                $('#infoQ').text(data[1].qName);
                $('#infoSchool').text(data[1].school);

                //filling data fields for students Contact details
                $('#infoAddr').text(data[2].contactAddress);
                $('#infoTel').text(data[2].mobileNumber);
                $('#infoEmail').text(data[2].emailAddress);

                //filling data fields for students Sponsor details
                $('#infoName').text(data[3].sName);
                $('#infoSAddr').text(data[3].contactAddress);
                $('#infoSTel').text(data[3].mobileNumber);
                $('#infoSEmail').text(data[3].emailAddress);

            }
        });


    });

});