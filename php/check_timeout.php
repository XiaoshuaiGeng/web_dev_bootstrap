<?php
/*This file is used to logout user when user stay inactive after 10 min
 * */

session_start();
//set a 10 min timeout interval
$timeoutInterval = 600;
if(isset($_SESSION['timeout'])){
    $sessionTTL = time() - $_SESSION['timeout'];
    if($sessionTTL > $timeoutInterval){
        //set session data to an empty array
        $_SESSION = array();
        //Destroy session if exceed timeout interval
        session_destroy();
    }
}