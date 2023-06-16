
<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="ens"){
    header("location:authentification.php");
}

?>
<?php
    include "../nav_bar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailler matiere par enseignant </title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a></li>
                <li>Détails sur la soumission  <?php //echo  ?> </li>
            </ol>
        </div>
    </div>
    <?php

    include_once "../connexion.php";
    $id_sous = $_GET['id_sous'];

    $req_detail = "SELECT * FROM soumission inner join matiere using(id_matiere) WHERE id_sous = $id_sous";
    $req = mysqli_query($conn , $req_detail);
    while($row=mysqli_fetch_assoc($req)){
    ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <fieldset>
                <br><br>

                <h4>
                <?php echo "<strong>Titre : </strong>". $row['titre_sous']; ?><br><br>
                <?php echo "<strong>Description : </strong>". $row['description_sous'];  ?><br><br>
                <?php echo "<strong>Code de la matiere : </strong>". $row['code']; ?><br><br>
                <?php echo "<strong>Date de  début : </strong>". $row['date_debut']; ?><br><br>
                <?php echo "<strong>Date de  fin : </strong>" . $row['date_fin']; ?><br><br>
                </h4>
               
            </fieldset>
            <br><br>
        </div>
        <div class="alert alert-info" style="margin-left: 600px; width:400px; height:300px;" > 
            <strong style="letter-spacing: 0.5px; font-size: 15px;width: 100%; height: 100%;text-align: center;"  >Le(s) Fichier(s)</strong><br><br>
        </div>
    </div>
    <?php
    }
    ?>



    <p>
        <a href="soumission_en_ligne.php" class="btn btn-primary">Retour</a>
    </p>

</div>


</body>
</html>