$(document).ready(function () {

    //User Login ajax requests
    $('#login').click(function (e) {

        if ($("#data")[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: "loginAction.php",
                type: "POST",
                data: $("#data").serialize() + "&action=login",
                success: function (response) {
                    if(response == ""){

                        $('#myalert').slideDown();
                        $('#alerttext').text("Logging In, Please wait...")

                        $('#data')[0].reset();
                        setTimeout(function (){

                            location.reload();
                        }, 2000);
                    }else{
                        $('#myalert').slideDown();
                        $('#alerttext').html(response);
                        //alert(response)
                    }
                }
            });
        }

    });

    $("body").on("click", ".forgot_password", function (e) {
        alert("Contact the administrator to renew your password")
    })
});