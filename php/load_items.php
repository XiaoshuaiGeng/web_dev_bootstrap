<?php
require_once 'db_info.php';
//check if the variable passed from db_info is empty
if (!empty($ht) && !empty($ur) && !empty($pw) && !empty($db)) {

    $mysqli = new mysqli($ht,$ur,$pw,$db);

}
if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if(!empty($search_item)){
    $query = "SELECT `id`,`image`,`title`,`description`,`price` FROM items WHERE MATCH(`title`,`description`) AGAINST ('$search_item')";
}else{
    $query = "SELECT `id`,`image`,`title`,`description`,`price` FROM items";
}

if(isset($_GET['radioValue'])){
    $sortValue = $_GET['radioValue'];
    if($sortValue == 'low'){
        $query = "SELECT `id`,`image`,`title`,`description`,`price` FROM items ORDER BY `price` ASC";
    }else{
        $query = "SELECT `id`,`image`,`title`,`description`,`price` FROM items ORDER BY `price` DESC";
    }
}

//if(!empty($username)){
//    $query = "SELECT * FROM `has_items` JOIN items WHERE items.id = has_items.item_id";
//}


$result = $mysqli->query($query);

if(!$result) die('Database access failed: '. $mysqli->error);

foreach ($result as $row){
    $id = $row['id'];
    $image = $row['image'];
    if(empty($image)){
        $image = "https://via.placeholder.com/200";
    }
    $title = $row['title'];
    $description = $row['description'];
    $price = "$".$row['price'];


    echo <<<END
        <div class="media mt-5 mx-3 d-flex flex-fill shadow rounded">
            <div class="overflow-hidden mr-5 p-0 align-self-center rounded-left" style="width: 200px; height: 200px">
                <img src="$image" class="" style="margin-top: -10px; margin-left: -100px;" alt="" width="400" height="220">
            </div>
            <div class="media-body">
                <h4 class="mt-2">$title</h4>
                <p class="text-muted">$description</p>
                <div class="dropdown-divider my-3"></div>
                <div class="d-md-flex justify-content-between d-block">
                    <span class="text-success" style="font-size:larger">$price</span>
                    <a href="../html/items/$id-$title.php" class="btn btn-primary align-self-end mr-md-2">Read More</a>
                </div>
            </div>
        </div>

                
    
END;


}
$result->free();
$mysqli->close();
