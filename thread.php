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
    <!-- To include navbar and database-->
    <?php
  include 'addon/_header.php';
  include 'addon/_dbconnect.php';
?>
    <br><br><br>
    <!-- THIS IS TO DISPLAY ABOUT THE CURRENT USER THAT HAS ASKED THE QUESTION ON THE PAGE. 
        AND THIS ALSO SHOWS THE DISCUSSION THAT IS GOING ON THE TOPIC THAT IS RAISED BY THE USER.
    -->
    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `thread` WHERE thread_cat_id = $id";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $cat = $row['thread_title'];
            $desc = $row['thread_desc'];
        }
    ?>

    <!-- To give alert of inserting a comment. -->
    <?php
        $showalert=false;
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $commentdesc =$_POST['comment'];
            $sno =$_POST['sno'];
            $sql = "INSERT INTO `comments` (`comment_desc`, `thread_id`, `comment_time`, `comment_user`) VALUES ('$commentdesc', '$id', current_timestamp(), '$sno')";
            $result = mysqli_query($conn,$sql);
            
            $showalert = true;
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!Your Comment has been added successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }
    ?>

    <!-- To show the thread title and its desccription that is posted by any particular user. -->
    <div class="container p-2 mb-4 bg-light rounded-3">
            <div class="h-100 p-4 text-bg-dark rounded-3">
                <h2 class="text"> <?php echo $cat; ?> </h2>
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


    <!-- This is to insert the comment on any topic. -->
    <!-- CHECKING IF THE USER IS LOGGED IN OR NOT IF NOT LOGGED IN THEN THE USER IS NOT SUPPOSED TO ADD THE COMMENT. -->
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true"){
    echo'
    <div class="container">
        <h1>Post a Commnet</h1>
        <!-- This server[request_uri is to save the form at this file itlsef and request_uri is to take the full path of the url.] -->
        <form action="'.$_SERVER['REQUEST_URI']. '" method ="post">
           
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type a Comment</label>
                <textarea class="form-control" id="comment" name ="comment" rows="3"></textarea>
            </div>
            
            <!-- THIS HIDDEN INPUT TAG IS TO GET THE SNO OF THE CURRENT USER WHO IS LOGGED IN. -->
             <input type="hidden" name="sno" value="'.$_SESSION["sno"].'"> 


            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>

    ';
    }
    else{
        echo'
        <div class="container">
            <h1>Post a Commnet</h1>
            <!-- This server[request_uri is to save the form at this file itlsef and request_uri is to take the full path of the url.] -->
            <p>
            You need to login first to post the comment.
            </p>
        </div>
    
        ';
    }

?>
    <!-- LIST OF QUESTION THAT HAS BEEN ASKED BY THE USER. -->

    <div class="container" id="ques">
        <h1 class="my-3"><u>Discussion</u></h1>
       
        <?php
             $id = $_GET['threadid'];
             $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
             $result = mysqli_query($conn,$sql);
             $enter = true;
             while($row = mysqli_fetch_assoc($result)){
                $enter =false;
                 $commentid = $row['comment_id'];
                 $content = $row['comment_desc'];
                 $time = $row['comment_time'];
                 $user = $row['comment_user'];
                 $sql2 = "SELECT user_name from `users_table` where sno = $user ";
                 $result2 = mysqli_query($conn,$sql2);
                 $row2 = mysqli_fetch_assoc($result2);
                //  $row2['user_name'];

            
        echo '
                <div class="d-flex">
                    <div class="flex-shrink-0 my-3">
                        <img src="img/user.jpg" width="54px" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 my-3">
                    <p class =  "mb-0"> <b> '.$row2['user_name'].' </b> at '.$time.' </p>
                        <p>
                           '.$content.'
                        </p>
                    </div>
                </div>
                ';
             }
            
             if($enter){
                echo '
                <div class="h-100 p-5 bg-light border rounded-3 my-3">
                <h3>No Comments found</h3>
                <p>Be the first person to post commnet.</p>
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