
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
</br></br></br><br>
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

    $req_detail = "SELECT * FROM soumission inner join matiere using(id_matiere),enseignant WHERE id_sous = $id_sous and soumission.id_ens=enseignant.id_ens ";
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
                <?php echo "<strong>Code de la matière : </strong>". $row['code']; ?><br><br>
                <?php echo "<strong>Date de  début : </strong>". $row['date_debut']; ?><br><br>
                <?php echo "<strong>Date de  fin : </strong>" . $row['date_fin']; ?><br><br>
                <?php echo "<strong>Nom et prénom de l'enseignant  : </strong>" . $row['nom']." ".$row['prenom']; ?><br><br>
                </h4>
               
            </fieldset>
            <br><br>
            <?php
    }
    ?>
        </div>
        <div class="alert alert-info" style="margin-left: 600px; width:400px; height:300px;position:relative;" > 
            <strong style="position:absolute;top: 2;left: 0;"  >Le(s) Fichier(s)</strong><br><br>
            <div style="position:absolute;top: 6;left: 2;width: 380px;">
            <?php
                $sql2 = "select * from fichiers_soumission where id_sous='$id_sous' ";
                $req2 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($req2) == 0){
                    echo "Il n'y a pas des fichier ajouter !" ;
                }else {
                    while($row2=mysqli_fetch_assoc($req2)){
                        ?>
                        <?php 
                        $file_name = $row2['nom_fichier'];
                        ?>
                        <div style="display: flex ; justify-content: space-between; " >
                        <div>
                        <p><strong><?=$row2['nom_fichier']?></strong></p>
                        </div>
                        
                        <div>
                        <?php 
                        $test=explode(".",$file_name);
                        if( $test[1]=="pdf"){
                        ?>
                        
                        <a href="open_file.php?file_name=<?=$file_name?>&id_sous=<?=$id_sous?>">Voir</a>
                        </div>
                        <?php
                        }
                        else{
                            ?>
                            <a >Voir</a>
                            </div>
                            <?php 
                            }
                        
                        ?>
                        <div>
                        <a href="telecharger_fichier.php?file_name=<?=$file_name?>&id_sous=<?=$id_sous?>">Telecharger</a>
                        </div>
                        </div>
                        <br>

                        <?php
                    }
                }
            ?>
            </div>
        </div>
    </div>




    <p>
        <a href="soumission_en_ligne.php" class="btn btn-primary">Retour</a>
    </p>

</div>
<?php
    include "../nav_bar.php";
?>

</body>
</html>