<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hacker Academy - Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    
</head>

<body>
    <!-- To include navbar and database-->
    <?php
  include 'addon/_header.php';
  include 'addon/_dbconnect.php';
?>
    <br><br><br>
    <!-- To get the relevant threads that is asked for 
(a) If ask for website hacking then the result is for website hacking.
(b) If ask for android hacking then the result is for androd hacking.
(c) If ask for pentester hacking then the result is for pentester hacking.
-->
    <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `hacker` WHERE categoryid = $id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $cat = $row['categoryname'];
            $desc = $row['categorydesc'];
        }
    ?>
<!-- To show the alert that your question has been added successfully. -->
    <?php
        $showalert=false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $th_title =$_POST['title'];
            $th_desc =$_POST['desc'];
            $sno =$_POST['sno'];
            $sql = "INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `datatime`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            
            $showalert = true;
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!Your question has been recorded wait for other to reply.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
    ?>
    <div class="container p-2 mb-4 bg-light rounded-3">
            <div class="h-100 p-4 text-bg-dark rounded-3">
                <h2 class="text-center"><u>Welcome to <?php echo $cat; ?> Forum</u></h2>
                <br>
                <p>
                    <?php echo $desc; ?>
                </p>
                <hr>
                <p>
                    <li>No Spam / Advertising / Self-promote in the forums</li>
                    <li>Do not post copyright-infringing material</li>
                    <li>Do not post “offensive” posts, links or images</li>
                    <li>Remain respectful of other members at all times</li>
                </p>
            </div>
    </div>

    <!-- To post the question. -->
    <!-- WE ARE CHCEKING IF THE USER IS LOGGED IN THEN ONLY THEY WILL BE ABLE TO START THE DISCUSSION ELSE NOT. -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== "true"){
    echo'
    <div class="container mb-4">
        <h1>Start Discussion</h1>
        <!-- This server[request_uri] is to save the form at this file itlsef and request_uri is to take the full path of the url.] -->
        <form action="'.$_SERVER['REQUEST_URI'].'" method ="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Question Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Your question should be precise.</div>
            </div>

            <!-- THIS HIDDEN INPUT TAG IS TO GET THE SNO OF THE CURRENT USER WHO IS LOGGED IN. -->
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Desciption of Question</label>
                <textarea class="form-control" id="desc" name ="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
    ';
    }
    else{
        echo'
        <div class="container">
            <h1>Start Discussion</h1>
            <p>
            You need to login first to start the discussion.
            </p>
        </div>
        ';
    }

    ?>

    <!-- Contains the list of questions that has been asked. -->
    <div class="container" id="ques">
        <h1 class=""><u>Browse Questions</u></h1>
        <?php
             $id = $_GET['catid'];
             $sql = "SELECT * FROM `thread` WHERE thread_cat_id = $id";
             $result = mysqli_query($conn,$sql);
             $enter = true;
             while($row = mysqli_fetch_assoc($result)){
                $enter =false;
                $threadid = $row['thread_id'];
                $threadtitle = $row['thread_title'];
                $threadques = $row['thread_desc'];
                $thread_user_id = $row['thread_user_id'];
                $time = $row['datatime'];
                $sql2 = "SELECT user_name FROM `users_table` where sno = '$thread_user_id'";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                // $row2['user_name'];



            
        echo '
                <div class="d-flex">
                    <div class="flex-shrink-0 my-3">
                        <img src="img/user.jpg" width="54px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 my-3">
                    <p class =  "mb-0"> <b> '.$row2['user_name'].' </b> at '.$time.' </p>
                        <h5><a class = "text-dark" href ="thread.php?threadid='.$id.'">'.$threadtitle.'</a></h5>
                        <p>
                           '.$threadques.' 
                        </p>
                    </div>
                </div>
                ';
             }
            
             if($enter){
                echo '
                <div class="h-100 p-5 bg-light border rounded-3 my-3">
                <h3>No question found</h3>
                <p>Be the first person to ask question.</p>
                </div>
                ';
             }
            
        ?>
    </div>


    <?php
        include 'addon/_footer.php';
     ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>