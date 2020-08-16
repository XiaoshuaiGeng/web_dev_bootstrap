<?php
/**
 * This file is used in index.html to show user profile dropdown menu
 * */
session_start();

//check user login status
//show user profile dropdown menu if user logged in
//else show the sign in button
if (isset($_SESSION['login'])) {
    $login_status = $_SESSION['login'];
    $username = $_SESSION['username'];

    echo <<<END
    <div class="dropdown mx-3">
        <a class="nav-link dropdown-toggle" href="#" role="button" id="userProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
END;
    echo "Welcome, $username";

    //Logout will send set logout = true and send to logout.php to destroy user session
    echo <<<END
        </a>
        <div class="dropdown-menu" aria-labelledby="userProfile">
            <a class="dropdown-item" href="http://geng115.myweb.cs.uwindsor.ca/60334/project/html/posted_items.php">View Posted Items</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="http://geng115.myweb.cs.uwindsor.ca/60334/project/php/logout.php?logout=true" >Log Out</a>
            
        </div>
    </div>
    
END;

}else{
    echo <<<END
    <a class="nav-link" href="http://geng115.myweb.cs.uwindsor.ca/60334/project/html/login.html" id = "signIn">Sign In</a>
END;
}
?>
