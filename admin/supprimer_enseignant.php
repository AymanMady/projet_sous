<?php
  include_once "../connexion.php";
  $id_ens= $_GET['id_ens'];
  $req = mysqli_query($conn , "DELETE FROM enseignant WHERE id_ens = $id_ens");
  header("Location:enseignant.php")
?>