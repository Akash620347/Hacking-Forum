<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hacker Academy - Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
    /* #id {
        min-height: 100px;
    } */
    </style>
</head>

<body>
    <?php 
    session_start();
  echo'
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark >
        <div class="container-fluid mx-0">
            <a class="navbar-brand mx-2" href="first.php">HackAcademy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="first.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            List
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">View-1</a></li>
                            <li><a class="dropdown-item" href="#">View-2</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">View-3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="Contactus.php">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex mx-2 my-0" role="search">';

                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                    echo '
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
     
                        <div class="btn">
                           <p class ="text-white"> Welcome: '.$_SESSION['username'].' </p>
                            <a href = "addon/_logout.php" class="btn btn-success">LogOut </a>
                        </div>
                        ';
                    }
                    else{
                    echo '
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                        <div class="btn">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#LoginModal">Login</button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#SingupModal">SingUp</button>
                        </div>
                        ';
                }
            echo'
            </nav>
                </div>
                </div>

             ';
include 'addon/_login.php';
include 'addon/_singup.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
    <strong>Success!</strong> You can now login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
    echo '<div class="alert alert-Warning alert-dismissible fade show my-0" role="alert">
    <strong>Warning!</strong> Name already in use need to resingup!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>