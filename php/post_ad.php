<?php
    /**
     *Receive post item data and insert into database
     */
    require_once 'db_info.php'; //import db login info
    include 'pure_string.php'; //using function defined in pure_string to deal with special chars in user input

    if (!empty($ht) && !empty($ur) && !empty($pw) && !empty($db)) {

        $mysqli = new mysqli($ht,$ur,$pw,$db);

    }
    if(mysqli_connect_errno()){
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    //use this flag to check if update item or create a new one
    $modifyFlag = false;

    if(isset($_REQUEST['id']) && isset($_REQUEST['old_title'])){
        $id = $_REQUEST['id'];
        $old_title = $_REQUEST['old_title'];
        $modifyFlag = true;
    }

    $type = $_REQUEST['type'];

    $title = $_REQUEST['ad_title'];
    $title = mysql_entities_fix_string($mysqli,$title);

    $category = $_REQUEST['category'];

    $description = $_REQUEST['ad_description'];
    $description = mysql_entities_fix_string($mysqli,$description);

    $price = $_REQUEST['price'];

    //image target directory
    $target_dir = '../images/item_images/';
    if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
        switch ($_FILES['image']['type']){
            case 'image/png':
            case 'image/jpeg':
                $name = $_FILES['image']['name'];
                $image = $target_dir.$name;
                move_uploaded_file($_FILES['image']['tmp_name'],$image);
                break;

        }

    }else{
        $image = null;
    }

    if($modifyFlag){
        unlink("../html/items/$id-$old_title.php");
        $query = "UPDATE items SET `type` = ?,`category` = ?,`title` = ?, `description` = ?, `price` = ?, `image` = ? WHERE `id`=$id";
    }else{
        $query = "INSERT INTO items (`type`,`category`,`title`,`description`,`price`,`image`)
                VALUES (?,?,?,?,?,?)
            ";
    }

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sissds',$type,$category,$title,$description,$price,$image);
    if(!($stmt->execute())){

        echo $stmt->error;
        exit();
    }

    if($modifyFlag){

    }else{
        //get item id of the last inserted item
        $id = $stmt->insert_id;

        //check current user session to get username
        session_start();

        if(isset($_SESSION['login'])) {
            $login_status = $_SESSION['login'];
            $username = $_SESSION['username'];
            //add item to current user who posted the item
            $result = $mysqli->query("INSERT INTO has_items VALUES ($username,$id)");
        }
    }




//get category name
    $result = $mysqli->query("SELECT `category_name` FROM category WHERE id = $category");
    $result->data_seek(0);
    $row = mysqli_fetch_row($result);
    $category_name = $row[0];
    $result->free();

    //create a page for current ad post
    $file = fopen("../html/items/$id-$title.php","w");
    $innerHTML = <<<END
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- import Google fonts: NAV bar fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <!-- import Google fonts: body fonts     -->
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <!-- Import bootstrap css   -->
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <!-- Import custom css   -->
    <link rel="stylesheet" href="../../css/stylesheet.css">
    <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/all.css">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="../node_modules/@fortawesome/fontawesome-free/js/all.js"></script>
    <script src="http://geng115.myweb.cs.uwindsor.ca/60334/project/js/search_item.js"></script>
    <title>FIBER - ITEMS</title>
</head>
<body>
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark nav-bg-dark px-sm-4 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand " style="font-family: 'Lobster', cursive; font-size: xx-large" href="../index.php">FIBER</a>

            <form class="col-6 d-block">

                <div class="input-group">
                    <input type="text" name="search_item" id="search_bar" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-light " type="submit" id="submit">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </button>
                </div>

                <!--                search results will be displayed here-->
                <div class="dropdown-menu mx-3" id="result" style="width: inherit;">
                </div>

            </form>

            <div class="navbar-nav d-flex flex-sm-row flex-column">
                <?php
                    include '../../php/user_profile.php';
                    //check session to show Sign in button / User profile dropdown menu
                    ?>

                <div class="nav-pills">

END;
                session_start();

                if(isset($_SESSION['login'])){
                    $login_status = $_SESSION['login'];
                    $username = $_SESSION['username'];

                    $innerHTML .= <<<END
                    <a class="nav-link btn-primary text-center" href="../create_ad.php">Post Ad</a>
END;
                }else{
                    $innerHTML .= <<<END
                    <a class="nav-link btn-primary text-center" href="../login.html">Post Ad</a>
END;

                }
    $innerHTML.= <<<END
                </div>

            </div>
            <button class="navbar-toggler btn-outline-secondary" type="button" data-toggle="collapse" data-target="#navLinks" aria-controls="navLinks" aria-expanded="false" aria-label="Toggle searchbar">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>

    </nav>

    <!--    Sub Headers-->
    <nav class="navbar navbar-expand-sm"  >

        <ul class="collapse navbar-collapse nav nav-justified flex-column flex-sm-row navbar-light bg-light" id="navLinks">
            <li class="nav-item">
                <a class="nav-link nav-text" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text" href="../buy_and_sell.php">Buy & Sell</a>
            </li>
        </ul>
    </nav>

    <!--    main content-->
    <div class="container-fluid py-5" style="background-color: #F7F7F7;">

        <div class="container my-5 pb-5 rounded shadow" style="background-color: white">
            <div class="row px-3 display-4 pt-3">$title</div>
            <div class="row px-3 h3 text-success">$$price</div>

            <hr class="my-3">
            <div class="row row-cols-1 row-cols-md-2 ">
                <div class="col">
END;
                if (!$image){
                    $innerHTML .= <<<END
                    <img class="img-fluid rounded shadow" src="https://via.placeholder.com/2560x1440";>
END;
                }else{
                    $innerHTML .= <<<END
                    <img class="img-fluid rounded shadow" src="../$image">
END;
                }
   $innerHTML .= <<<END

                </div>
                <div class="col">
                    <div class="row p-3">
                        <div class="h6">Ad Type: $type</div>
                    </div>
                    <div class="row p-3">
                        <div class="h6">Ad Category: $category_name</div>
                    </div>
                    <div class="row p-3">
                        <div class="h6">Ad Description: </div>
                        <p>$description</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--    footer-->
    <footer class="nav-bg-dark">
        <div class="container py-5">

            <div class="row">
                <div class="col-md-4">
                    <h3>FIBER</h3>
                    <div class="list-group list-group-flush py-3">
                        <a class="list-group-item nav-bg-dark footer-text" href="../index.php">Home</a>
                        <a class="list-group-item nav-bg-dark footer-text" href="../buy_and_sell.php">Buy & Sell</a>

                    </div>
                </div>
            </div>
            <hr class="my-3" style="background-color: #D0D0D4">
            <div class="row p-3 justify-content-between">
                <div class="col-md-8">
                    <small>Developed & Designed by
                        <a href="mailto:geng115@uwindsor.ca">Xiaoshuai Geng - geng115@uwindsor.ca</a>
                    </small>
                </div>

                <div class="col-md-2 my-md-n3 ">
                    <div class="d-flex justify-content-end">

                        <a class="btn btn-dark rounded-circle mx-auto" href="https://github.com/XiaoshuaiGeng"  target="_blank" role="button">
                                <span style="font-size: 25px;">
                                    <i class="fab fa-github"></i>
                                </span>
                        </a>

                        <a class="btn btn-dark rounded-circle mx-auto" href="https://www.linkedin.com/in/xiaoshuai-geng-20804a194/"  target="_blank" role="button">
                                <span style="font-size: 25px;">
                                    <i class="fab fa-linkedin-in"></i>
                                </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </footer>
</body>
</html>
END;
    fwrite($file,$innerHTML) or die("could not write file");
    fclose($file);
    $stmt->close();

    $mysqli->close();



    header('location:../html/buy_and_sell.php');

