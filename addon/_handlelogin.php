<?php
$showalert = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    // This loginname and loginpass are the name and password that is send by the user.
    $name = $_POST['loginname'];
    $pass = $_POST['loginpass'];

    // this sql is to get the name from the users_table that is given by the user at the time of singup.    
    $sql = "select *from `users_table` where user_name = '$name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if($row == 1){
        $numrow = mysqli_fetch_assoc($result);
        if(password_verify($pass, $numrow['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $name;
            $_SESSION['sno'] =  $row['sno'];
            echo "Logged in: " .$name;
        }
       header("Location:/php/forum/first.php");
    }
}

?>