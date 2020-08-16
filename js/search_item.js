$(document).ready(function () {
    $("#search_bar").keyup(function () {
        var input = $('#search_bar').val();

        if(input.length > 0){
            $.ajax({
                type: "GET",
                url: "http://geng115.myweb.cs.uwindsor.ca/60334/project/php/search_item.php",
                data: "search_item="+input,
                success: function (data) {
                    $('#result').html(data);
                    $('#result').show();
                }
            });

        }else{
            $('#result').hide();
        }


    });

    var flag = false;
    $('#result').mouseleave(function () {
        flag = false;
    });
    $("#result").mouseenter(function () {
        flag = true;
    });
    $("#search_bar").focusout(function () {

        if(!flag){
            $('#result').hide();
        }
    });
});