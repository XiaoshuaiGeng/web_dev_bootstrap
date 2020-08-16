$(document).ready(function () {
    $("input[type='radio']").click(function () {
        var radioValue = $("input[name='price']:checked").val();
        $.ajax({
            type: "GET",
            url: "http://geng115.myweb.cs.uwindsor.ca/60334/project/php/load_items.php",
            data: "radioValue="+radioValue,
            success: function (data) {
                $('#items').html(data);
            }
        });

    });
});