<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:../authentification.php");
}

include "../nav_bar.php";

?>


