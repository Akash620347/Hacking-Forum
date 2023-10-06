<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hacker Academy - Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        #ques{
            min-height:444px;
        }
    </style>
</head>

<body>
    <!-- To include navbar -->
    <?php
  include 'addon/_header.php';
  include 'addon/_dbconnect.php';
?>

    <!-- To include carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active carousel slide">
                <img src="img/01.jpg" class="d-block w-100" alt ="Image is loading.">
            </div>
            <div class="carousel-item">
                <img src="img/02.jpg" class="d-block w-100" alt ="Image is loading.">
            </div>
            <div class="carousel-item">
                <img src="img/03.jpg" class="d-block w-100" alt ="Image is loading.">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <!-- To include cards -->
    <div class="container" id="ques">
        <h2 class="text-center my-3">
            Browse Categories
        </h2>
        <div class="row">
            <!-- Inserting php to fetch all the cards one by one -->
            <?php
                $sql = "SELECT * FROM `hacker`";
                $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['categoryid'];
                    $cat = $row['categoryname'];
                    $desc = $row['categorydesc'];
                    echo '
                    <div class="col-md-4 my-3 text-center">
                      <div class="card" style="width: 18rem;">
                          <img src="https://source.unsplash.com/500x400/?'.$cat.',coding" class="card-img-top" alt="...">
                          <div class="card-body">
                          <h5 class="card-title"><a href ="threadlist.php?catid='.$id.'"> '.$cat.' </a></h5>
                              <p class="card-text">'.substr($desc,0,90).'.....</p>
                          </div>
                          <button type="button" class="btn btn-primary "><a class = "text-light text-lg" href="threadlist.php?catid='.$id.'">View Categories </a></button>
                      </div>
                  </div> ';
                }

            ?>

        </div>
    </div>





    <?php
        include 'addon/_footer.php';
     ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>