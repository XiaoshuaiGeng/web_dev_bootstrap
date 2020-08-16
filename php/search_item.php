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
    if(isset($_REQUEST['search_item'])){
        $input = $_REQUEST['search_item'];
        $input = mysql_entities_fix_string($mysqli,$input);

        $query = "SELECT items.`id`,`title`,`description`,`category_name`
                    FROM items
                    JOIN category
                    ON items.category = category.id
                    WHERE MATCH (`title`,`description`) AGAINST ('$input')
                    LIMIT 5";

        $result = $mysqli->query($query);
        if($result){
            if($result->num_rows == 0){

                echo <<<END
                
                <h6 class="dropdown-header">No Results Found</h6>
END;
            }else{
                foreach ($result as $row){
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $category = $row['category_name'];
                    $link = "/60334/project/html/items/$id-$title.php";
                    echo <<<END
                        <a class="dropdown-item" href="$link">
                            <div class="row row-cols-2 justify-content-between">
                                <div class="col">
                                    <div class="text-muted overflow-hidden">$title | $description</div>
                                </div>
                                <div class="col text-muted text-right">$category</div>
                            </div>
                        </a>
END;
                }
                $result->free();
            }
        }else{
            echo "Search Error ".$result->error;
        }
    }
    $mysqli->close();
