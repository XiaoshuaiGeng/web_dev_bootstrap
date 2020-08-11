<?php
session_start();

if(isset($_SESSION['login'])){
    $login_status = $_SESSION['login'];
    $username = $_SESSION['username'];
    $_SESSION['timeout'] = time();
    echo "OK";
}