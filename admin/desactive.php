<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"] != "admin"){
    header("location:authentification.php");
}
$id_etud =$_GET['id_etud'];
include_once "../connexion.php";
$sql="SELECT * FROM etudiant WHERE id_etud=$id_etud";
$req=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($req);
$email=$row['email'];
$sql2="UPDATE utilisateur SET utilisateur.active=0 WHERE utilisateur.login='$email'";
$req1=mysqli_query($conn,$sql2);
if($req1){
    header("location:etudiant.php");
}
?>