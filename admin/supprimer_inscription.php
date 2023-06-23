<?php
  include_once "../connexion.php";
  $id_insc= $_GET['id_insc'];
  $req = mysqli_query($conn , "DELETE FROM inscription WHERE id_insc = $id_insc");
  header("Location:inscription.php");
?>