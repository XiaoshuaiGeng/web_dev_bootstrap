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


if(!empty($username)){
    $query = "SELECT * FROM `has_items` JOIN items WHERE items.id = has_items.item_id";
}


$result = $mysqli->query($query);

if(!$result) die('Database access failed: '. $mysqli->error);
if($result->num_rows < 1){
    echo "<div class='display-4'>No items found</div>>";
}else{
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
                <form action="http://geng115.myweb.cs.uwindsor.ca/60334/project/php/modify_user_items.php" method="get">
                    <input type="hidden" name="id" value="$id">
                    <input type="hidden" name="old_title" value="$title">
                    
                    <div class="row btn-group mt-3 mx-3">
                        
                        <button type="submit" name="submit" class="btn btn-outline-secondary" value="update">Update Item</button>
                        <button type="submit" name="submit" class="btn btn-outline-secondary" value="delete">Delete Item</button>
                    </div>
                    
                </form>
            </div>
        </div>

                
    
END;
}

}
$result->free();
$mysqli->close();
