<?php

session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="ens"){
    header("location:authentification.php");
}
 include_once "../connexion.php";
 $id_sous = $_GET['id_sous'];

 $req = mysqli_query($conn, "UPDATE soumission SET   status = 0 WHERE id_sous = '$id_sous'");
 if($req){
     header('location:soumission_en_ligne.php');
     $_SESSION['prolongement_reussi'] = true;
 }else {
     echo "soumission non archiver";
 }
?>