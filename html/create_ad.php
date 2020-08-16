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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <!-- Import custom css   -->
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/all.css">


    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="../node_modules/@fortawesome/fontawesome-free/js/all.js"></script>
    <script>
        function buy_sell_check(btn) {
            let buy = document.getElementById('buying');
            let sell = document.getElementById('selling');
            if(btn.value == 'buy'){
                sell.checked = false;
            }else{
                buy.checked = false;
            }
        }
    </script>
    <title>FIBER - Post Ad</title>
</head>
<body style="background-color: #F7F7F7">
    <nav class="navbar navbar-nav navbar-expand-sm navbar-light shadow-lg fixed-top rounded-bottom">
        <div class="container-fluid justify-content-around">
            <a class="navbar-brand mx-sm-5" style="font-family: 'Lobster', cursive; font-size: xx-large; color: #27293D" href="index.php">FIBER</a>
            <div class="nav justify-content-center align-self-center ">
                <span class="nav-link h3">Post Ad</span>
            </div>
            <a class="nav-link text-muted" href="index.php">
                <i class="far fa-times-circle" style="font-size: 2rem"></i>
            </a>
        </div>

    </nav>

    <div class="container rounded shadow" style="margin-top: 100px; background-color: white">

        <div class="container p-5">

            <form class="was-validated" action="../php/post_ad.php" method="post" enctype="multipart/form-data">
                <?php
                    if(isset($_REQUEST['id']) && isset($_REQUEST['old_title'])){
                        $id = $_REQUEST['id'];
                        $old_title = $_REQUEST['old_title'];
                        echo "<input type='hidden' name='id' value='$id'>";
                        echo "<input type='hidden' name='old_title' value='$old_title'>";
                    }
                ?>
                <div class="h5 pt-3">Ad Details</div>
                <hr class="pb-3">

<!--                ad type (buy or sell)-->
                <div class="form-group row">
                    <div class="col-sm-2 my-2">
                        <span class="my-3">Ad Type</span>
                    </div>
                    <div class="col-sm-10 my-2">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="selling" name="type" value="sell" checked onclick="buy_sell_check(this)">
                            <label for="selling" class="form-check-label">I'm selling</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="buying" name="type" value="buy"  onclick="buy_sell_check(this)">
                            <label for="buying" class="form-check-label">I'm buying</label>
                        </div>

                    </div>
                </div>

<!--                ad title-->
                <div class="form-group row">
                    <div class="col-sm-2 my-2">
                        <span class="my-2">Ad Title</span>
                    </div>
                    <div class="col-sm-10 my-2 ">
                        <input class="form-control" name="ad_title"  type="text" placeholder="Please type the ad title here" required>
                    </div>
                </div>

<!--                ad category-->
                <div class="form-group row">
                    <div class="col-sm-2 my-2">
                        <span class="my-2">Select Category</span>
                    </div>
                    <div class="col-sm-10 my-2 ">
                        <select class="custom-select" name="category" id="category" required>
                            <option selected disabled hidden value="">Please select item categories here</option>
<!--                                php auto load categories from database-->
                            <?php
                                require_once '../php/db_info.php';
                                if (!empty($ht) && !empty($ur) && !empty($pw) && !empty($db)) {

                                    $mysqli = new mysqli($ht,$ur,$pw,$db);

                                }
                                if(mysqli_connect_errno()){
                                    echo "Connect failed: ".mysqli_connect_error();
                                    exit();
                                }

                                $query = "SELECT * FROM category";
                                $result = $mysqli->query($query);
                                foreach ($result as $row){
                                    $category = $row['category_name'];
                                    $category_id = $row['id'];
                                    echo "<option value='$category_id'>$category</option>";

                                }
                                $mysqli->close();
                            ?>

                        </select>
<!--                        <small class="text-muted">Category does not exist? Click here to add a new category</small>-->
                    </div>
                </div>

<!--                ad description-->
                <div class="form-group row">
                    <div class="col-sm-2 my-2">
                        <span class="my-2">Ad Description</span>
                    </div>
                    <div class="col-sm-10 my-2 ">
                        <textarea class="form-control" name="ad_description" id="ad_description" cols="30" rows="2" required></textarea>
                    </div>
                </div>


<!--              Item Price-->
                <div class="h5 pt-3">Prices</div>
                <hr class="pb-3">

                <div class="form-group row">
                    <div class="col-sm-2 my-2">
                        <span class="my-2">Item Price</span>
                    </div>
                    <div class="col-sm-4 my-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="price" class="form-control" maxlength="15" step="0.01" required>
                        </div>

                    </div>
                </div>


<!--                ad images-->
                <div class="h5 pt-3">Images</div>
                <hr class="pb-3">
                <div class="form-group row">
                    <div class="col-sm-2 my-2">
                        <span class="my-2">Item Images</span>
                    </div>

                    <div class="col-sm-4 my-2">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label for="image" class="custom-file-label">Select a image to upload</label>
                        </div>
                    </div>


                </div>

                <div class="form-group row justify-content-center">
                    <button class="btn btn-outline-primary btn-lg" type="submit">Post Ad</button>
                </div>
            </form>

        </div>

    </div>
</body>
</html>