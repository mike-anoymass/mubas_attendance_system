
$(document).ready(function () {

    //hide certified students from Lab Technician
    typeOfUser = $("#userType").val();

    if(typeOfUser === "Technician"){
        $("#certified").hide();
    }

    //validate changing of password
    $("#pwdBtn").click(function (e) {
        let password = $("#userPassword").val();
        let oldPassword = $("#oldPassword").val();
        let newPassword = $("#newPassword").val();
        let confirmPassword = $("#confirmPassword").val();

        let error = "";
    
        if ($("#password-form")[0].checkValidity()) {
            e.preventDefault();

            if(oldPassword != password){
                error = "You have Entered a Wrong old password"
            }else if(newPassword != confirmPassword){
                error = "New password doesnt Match"
            }

            if (error === ""){
                $.ajax({
                    url: "changePasswordAction.php",
                    type: "POST",
                    data: $("#password-form").serialize() + "&action=changePassword",
                    success: function (response) {
                    $("#editPassword").hide();
                    alert(response);
                    location.reload();
                }});
            }else{
                alert(error);
            }
        }else{
            alert("Please check your Input.. Make sure you complete the form ");
        }

    });
});
