<?php
    require_once 'db_info.php';
    include 'pure_string.php';
    //check if the variable passed from db_info is empty
    if (!empty($ht) && !empty($ur) && !empty($pw) && !empty($db)) {

        $mysqli = new mysqli($ht,$ur,$pw,$db);

    }
    if(mysqli_connect_errno()){
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    if(isset($_REQUEST['username'])){
        $username = mysql_entities_fix_string($mysqli,$_REQUEST['username']);
        $query = "SELECT `username` FROM user_profiles WHERE username = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('s',$username);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $rows = $result->num_rows;

            //if rows > 0 means username already exist in the database
            if($rows){
                echo "Username already exist";
            }else{
                echo "OK";
            }
        }
        $stmt->free_result();
    }

    $mysqli->close();
