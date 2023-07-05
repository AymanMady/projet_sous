<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"] != "admin"){
    header("location:authentification.php");
}
$id_ens =$_GET['id_ens'];
include_once "../connexion.php";
$sql="SELECT * FROM enseignant WHERE id_ens=$id_ens";
$req=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($req);
$email=$row['email'];
$sql2="UPDATE utilisateur SET utilisateur.active=0 WHERE utilisateur.login='$email'";
$req1=mysqli_query($conn,$sql2);
if($req1){
    header("location:enseignant.php");
}
?>