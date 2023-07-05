<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"] != "admin"){
    header("location:authentification.php");
}
  include_once "../connexion.php";
  $id_user= $_GET['id_user'];
$sql2="UPDATE utilisateur SET utilisateur.active=0 WHERE `utilisateur`.`id_user`= $id_user";
$req1=mysqli_query($conn,$sql2);
if($req1){
    header("location:utilisateurs.php");
}
?>