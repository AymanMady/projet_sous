
<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="ens"){
    header("location:authentification.php");
}

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
<br><br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 

            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a></li>
                </li>
                    <li>Gestion des matière</li>
                    <li>Détails </li>
            </ol>

    <div class="row">
        <div class="col-lg-12">
            <div class="well">
            <?php
                 include_once "../connexion.php";
                $id_matiere = $_GET['id_matiere'];
                $matiere = "SELECT DISTINCT * FROM matiere NATURAL JOIN enseignant WHERE id_matiere = $id_matiere LIMIT 1";
                $matiere_qry = mysqli_query($conn,$matiere);
                while ($row_matiere = mysqli_fetch_assoc($matiere_qry)) :
                ?>
            <fieldset class="fsStyle">
                        <legend class="legendStyle">
                            <a data-toggle="collapse" data-target="#demo" href="#" >Détails sur la matière <?php echo $row_matiere['libelle']." "." Enseigner par "." ".$row_matiere['nom'] ?></a>
                        </legend>
                       
                    </fieldset>
            <?php endwhile;?>
        </div>
    </div>
</div>

    <?php

   
    $id_matiere = $_GET['id_matiere'];

    $req_detail = "SELECT DISTINCT matiere.id_matiere, nom, prenom, code, libelle, specialite, email FROM matiere
                INNER JOIN enseigner ON matiere.id_matiere = enseigner.id_matiere
                INNER JOIN enseignant ON enseignant.id_ens = enseigner.id_ens
                WHERE matiere.id_matiere = $id_matiere";
    $req = mysqli_query($conn , $req_detail);
    while($row=mysqli_fetch_assoc($req)){
    ?>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <fieldset>
                <br><br>

                <h4>
                <?php echo "<strong>Nom de l'enseignant : </strong>". $row['nom']." ".$row['prenom']; ?><br><br>
                <?php echo "<strong>Code de la matiere : </strong>". $row['code']; ?><br><br>
                <?php echo "<strong>Libellè : </strong>". $row['libelle']; ?><br><br>
                <?php echo "<strong> Specialite : </strong>" . $row['specialite']; ?><br><br>
                <?php echo "<strong> E-mail de l'enseignant : </strong>" . $row['email']; ?><br>
                </h4>
               
            </fieldset>
            <br><br>
        </div>
    </div>

    <?php
    }
    include "../nav_bar.php";
    ?>
    <p>
        <a href="../index_enseignant.php" class="btn btn-primary">Retour</a>
    </p>

</div> <!-- Fermeture de la div container -->

</body>
</html>