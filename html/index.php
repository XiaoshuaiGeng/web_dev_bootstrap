<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
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


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="../node_modules/@fortawesome/fontawesome-free/js/all.js"></script>

    <title>FIBER</title>
</head>
<body style="background-color: #F7F7F7">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark nav-bg-dark px-sm-4 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand " style="font-family: 'Lobster', cursive; font-size: xx-large" href="index.php">FIBER</a>

            <form class="col-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-light " type="submit" id="submit">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg>
                    </button>
                </div>
            </form>

            <div class="navbar-nav d-flex flex-sm-row flex-column">
                <a class="nav-link" href="login.html">Sign In</a>
                <div class="nav-pills">
                    <a class="nav-link btn-primary" href="#">Post Ad</a>
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
                <a class="nav-link nav-text" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text" href="#">Buy & Sell</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-text" href="#">Services</a>
            </li>
        </ul>
    </nav>



    <div class="container" style="background-color: white">
        <div class="container pt-md-5" >
            <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner rounded">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="../images/xbox-trade.png" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../images/19-codpreorder-inline6.webp" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../images/maxresdefault.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <hr class="my-5">
        </div>

        <div class="container my-5 pt-md-5" >
            <div class="d-flex row">

                <div class="col-md-8" style="line-height: 2">
                    <h3 class="display-4">About Us</h3>
                    <p class="mt-md-3 lead" style="text-align: justify">
                        Fiber is a platform that allows people to exchange goods and services.
                        People will be able to post advertisements to sell their unwanted stuff for money/exchange.
                        People who are interested or intend to buy or ask for the service will be able to pay online.
                        For people who are not able to pay online, they are able to direct message each other to meet locally.

                    </p>


                </div>
                <div class = "flex-fill text-center align-self-center">
                    <img class="mt-md-4" src="../images/the_good_exchange.png" alt="The Good Exchange" height="156" width="320"/>
                </div>
            </div>

            <hr class="my-5">
        </div>
    </div>


<!--    footer-->
    <footer class="nav-bg-dark">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4">
                    <h3>FIBER</h3>
                    <div class="list-group list-group-flush py-3">
                        <a class="list-group-item nav-bg-dark footer-text" href="index.php">Home</a>
                        <a class="list-group-item nav-bg-dark footer-text" href="login.html">Sign In</a>

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