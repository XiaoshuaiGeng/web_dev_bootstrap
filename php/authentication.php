<?php
    $conn = new mysqli('myweb.cs.uwindsor.ca','geng115_pbl','mypassword','geng115_pbl');

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
        $username = mysql_entities_fix_string($conn, $_REQUEST['username']);
        $password = mysql_entities_fix_string($conn, $_REQUEST['password']);
        $password = hash('ripemd128',$password);

        $query = "SELECT `username`, `password` FROM user_profiles WHERE username = ? and password = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss',$username,$password);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $rows = $result->num_rows;

            //check if user / password exist in the database
            if ($rows == 0){
                echo "No such username & password";
            }else{
                echo "Login Successfully";
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['timeout'] = time();

            }

        }else{
            echo "SQL query execution failed $stmt->error <br> $conn->error";
        }
        $stmt->close();
    }
    $conn->close();

    function mysql_entities_fix_string($connection, $string)
    {

        $string = stripslashes($string);
        $string = strip_tags($string);

        return $connection->real_escape_string($string);
    }



