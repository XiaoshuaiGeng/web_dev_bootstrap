$(document).ready(function () {
    var user_profile = $('#UserDropdownMenu');
    user_profile.addClass('dropdown mx-3');
    var dropdown_menu = "<a class=\"nav-link dropdown-toggle\" href=\"#\" role=\"button\" id=\"userProfile\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
        "                        Profile\n" +
        "                    </a>\n" +
        "                    <div class=\"dropdown-menu\" aria-labelledby=\"userProfile\">\n" +
        "                        <a class=\"dropdown-item\" href=\"#\">Edit Profile</a>\n" +
        "                    </div>"
    user_profile.html(dropdown_menu);

    $('#signIn').remove();//remove sign in button
});