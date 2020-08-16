$(document).ready(function () {

    $('#sign_up_form').submit(function () {
        var isValid = true;

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var regex = new RegExp("^[a-zA-Z]+$");
        if(regex.test(fname) && fname.length < 30){
            $('#fname').removeClass("is-invalid");
            $('#fname').addClass("is-valid");
        }else{
            $('#fname').removeClass("is-valid");
            $('#fname').addClass("is-invalid");
            isValid = false;
        }

        if(regex.test(lname) && lname.length < 30){
            $('#lname').removeClass("is-invalid");
            $('#lname').addClass("is-valid");
        }else{
            $('#lname').removeClass("is-valid");
            $('#lname').addClass("is-invalid");
            isValid = false;
        }

        if( username.length < 8 || username.length > 20){
            $('#usernameInfo').html("Username has to be 8-20 characters long");
            $('#username').removeClass('is-valid');
            $('#username').addClass('is-invalid');
            isValid = false;

        }else{
            $('#usernameInfo').html(""); //clear former username validation
            $.ajax({
                type: "GET",
                url: "../php/check_username.php",
                data: "username=" + username,
                success: function (data){
                    if(data != 'OK'){
                        $('#username').addClass('is-invalid');
                        $('#usernameInfo').html(data);
                        isValid = false;
                    }else{
                        $('#username').removeClass('is-invalid');
                        $('#username').addClass('is-valid');

                    }
                }
            });
        }

        if(password.length > 8 && password.length < 30){
            $('#password').removeClass('is-invalid');
            $('#password').addClass('is-valid');
        }else{
            $('#password').removeClass('is-valid');
            $('#password').addClass('is-invalid');
            $('#passwordInfo').html("Password has to be 8-20 characters long")
            isValid = false;
        }

        if(!isValid){
            return false;
        }else{
            $('#sign_up_result').html("Sign Up Successfully");
        }
    });

});
