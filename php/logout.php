<?php
session_start();

if (isset($_SESSION['login']) && $_REQUEST['logout'] == true){
    //assign session to an empty array(clear session data)
    $_SESSION = array();
    //destroy current session
    session_destroy();
}
header("Location: http://geng115.myweb.cs.uwindsor.ca/60334/project/html/index.php");

