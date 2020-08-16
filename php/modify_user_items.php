<?php
    require_once 'db_info.php';
    include 'pure_string.php';
    if (!empty($ht) && !empty($ur) && !empty($pw) && !empty($db)) {

        $mysqli = new mysqli($ht,$ur,$pw,$db);

    }
    if(mysqli_connect_errno()){
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    if(isset($_REQUEST['submit']) && isset($_REQUEST['id']) && isset($_REQUEST['old_title'])){
        $modify_type = $_REQUEST['submit'];
        $id = $_REQUEST['id'];
        $old_title = $_REQUEST['old_title'];
        if ($modify_type == "update"){
//            header("location: ../html/items/$id-$old_title.php");
            //unlink("../html/items/$id-$old_title.php");

            header("location: http://geng115.myweb.cs.uwindsor.ca/60334/project/html/create_ad.php?id=$id&old_title=$old_title");
        }

        if ($modify_type == "delete"){
            unlink("../html/items/$id-$old_title.php");
            $result = $mysqli->query("DELETE FROM items WHERE id = $id");
            $mysqli->close();
            header("location: http://geng115.myweb.cs.uwindsor.ca/60334/project/html/buy_and_sell.php");
        }

    }