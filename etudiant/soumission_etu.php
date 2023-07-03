<?php
 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="etudiant"){
     header("location:../authentification.php");
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
                <li>Détails sur la soumission</li>
            </ol>
        </div>
    </div>
    <?php

    include_once "../connexion.php";
    $id_matiere = $_GET['id_matiere'];

    $req_detail = "SELECT * FROM soumission inner join matiere using(id_matiere) WHERE id_matiere = $id_matiere and status=0 ";
    $req = mysqli_query($conn , $req_detail);
    if (mysqli_num_rows($req) > 0) {

    while($row=mysqli_fetch_assoc($req)){
    ?>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <fieldset>
                <br><br>
                <h4>
                <?php echo "<strong>Titre : </strong>". $row['titre_sous']; ?><br><br>
                <?php echo "<strong>Description : </strong>". $row['description_sous'];  ?><br><br>
                <?php echo "<strong>Date de  début : </strong>". $row['date_debut']; ?><br><br>
                <?php echo "<strong>Date de  fin : </strong>" . $row['date_fin']; ?><br><br>
                </h4>
            </fieldset>
        <br><br>
    <?php
     $id_sous = $row['id_sous'];
     ?>
     </div>
    <div class="alert alert-info" style="margin-left: 600px; width:400px; height:300px;position:relative;" > 
            <strong style="position:absolute;top: 2;left: 0;"  >Le(s) Fichier(s)</strong><br><br>
            <div style="position:absolute;top: 6;left: 2;">
            <?php
                $sql2 = "select * from fichiers_soumission where id_sous='$id_sous' ";
                $req2 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($req2) == 0){
                    echo "Il n'y a pas des fichier ajouter !" ;
                }else {
                    while($row2=mysqli_fetch_assoc($req2)){
                        ?>
                        <a href="<?=$row2['chemin_fichier']?>"><?=$row2['nom_fichier']?></a><br><br>
                        <?php
                    }
                }
            ?>
            </div>
    </div>
    <p>
        <a href="reponse_etudiant.php?id_sous=<?=$row['id_sous']?>" class="btn btn-primary">Rendre le travail</a>
    </p>
</div>
    <?php
    }
    }else{
    ?>
    <div class="col-xs-12 center">
        <h1 class="red-text">Il n'y a pas de soumission en ligne dans cette matière</h1>
    </div>

    <?php
    }
    ?>
</div>

</body>
</html>