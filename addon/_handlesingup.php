<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $name = $_POST['signupname'];
    $pass = $_POST['signuppass'];
    $cpass = $_POST['signupcpass'];

    // Check whether this email exists
    $existSql = "SELECT * from `users_table` where user_name = '$name'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Name already in use.";
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users_table` (`user_name`, `user_pass`, `datetime`) VALUES ( '$name', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            if($result){
                $showAlert = true;
                header("Location:/php/forum/first.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError = "Passwords do not match"; 
            
        }
    }
    header("Location:/php/forum/first.php?signupsuccess=false&error=$showError");

}
?>