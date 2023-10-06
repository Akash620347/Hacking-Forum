<?php
session_start();

echo "Please wait until you logged out..";

session_destroy();
header("Location: /php/forum/first.php");

?>