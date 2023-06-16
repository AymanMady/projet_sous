<?php
  include_once "../connexion.php";
  $id_matiere= $_GET['id_matiere'];
  $req = mysqli_query($conn , "DELETE FROM matiere WHERE 	id_matiere = '$id_matiere'");
  header("location:matiere.php")
?>