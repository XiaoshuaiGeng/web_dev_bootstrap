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

$query = "SELECT * FROM items";


$result = $mysqli->query($query);

if(!$result) die('Database access failed: '. $mysqli->error);

foreach ($result as $row){
    $image = $row['image'];
    if(empty($image)){
        $image = "https://via.placeholder.com/200";
    }
    $title = $row['title'];
    $description = $row['description'];
    $price = "$".$row['price'];


    echo <<<END
                <div class="card mt-5 mx-3 d-flex flex-fill">
                    <div class="row">
                        <div class="col-auto no-gutters">
                            <img src="$image" class="image-thumbnail im p-0" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title">$title</h4>
                                <p class="card-text">$description</p>
                                <div class="dropdown-divider my-3"></div>
                                <div class="d-flex justify-content-between">

                                    <span class="text-success" style="font-size:larger">$price</span>
                                    <a href="#" class="btn btn-primary align-self-end">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
END;


}
