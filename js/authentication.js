$(document).ready(function () {

    $('#sign_in_btn').click( function (){
        var login_result = $('#login_result');
        login_result.html("");
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            type: "POST",
            url: "../php/authentication.php",
            data: "username="+username+"&password="+password,
            success: function (data) {
                if(data === "Login Successfully"){
                    login_result.toggleClass("text-success").removeClass("text-danger");
                    login_result.html("Login Successfully");
                    window.location.href = "index.php";
                }else{
                    login_result.html("No such username & password");
                }
            }
        });


    });

});

