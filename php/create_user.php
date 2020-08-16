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

    if(isset($_REQUEST['fname']) && isset($_REQUEST['lname']) && isset($_REQUEST['username']) && isset($_REQUEST['password'])){
        $fname = $_REQUEST['fname'];
        $lname = $_REQUEST['lname'];
        $username = mysql_entities_fix_string($mysqli, $_REQUEST['username']);
        $password = mysql_entities_fix_string($mysqli, $_REQUEST['password']);
        //hash the user password to secure password values in db
        $password = hash('ripemd128',$password);

        $usercode = 1; //default user

        $query = "INSERT INTO user_profiles (`fname`,`lname`,`usercode`,`username`, `password`) VALUES (?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssiss',$fname,$lname,$usercode,$username,$password);

        if($stmt->execute()){
            header('location: ../html/login.html');
        }else{
            echo 'Create User Failed '.$stmt->error;
        }
        $stmt->free_result();
    }
    $mysqli->close();
