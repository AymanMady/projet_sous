<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<br><br><br>
<?php 
 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="etudiant"){
     header("location:../authentification.php");
 }

include_once "../connexion.php";
$file=$_GET['file_name'];
$sql="DELETE FROM fichiers_reponses WHERE fichiers_reponses.nom_fichiere='$file'";
$resul=mysqli_query($conn,$sql);
if($resul){
    header("location:index_etudiant.php");
}
?>
</body>
</html>