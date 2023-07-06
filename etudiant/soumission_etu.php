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
    $id_sous = $_GET['id_sous'];

    $req_detail = "SELECT * FROM soumission  WHERE id_sous = $id_sous and status=0 ";
    $req = mysqli_query($conn , $req_detail);
    mysqli_num_rows($req);

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
                        $file_chemin = $row2['chemin_fichier'];
                        $file_name=$row2['nom_fichier'];
                        ?>
                        <div style="display: flex ; justify-content: space-between; " >
                        <div>
                        <p><?=$row2['nom_fichier']?> </p>
                        </div>
                        <div>
                        <form action="open_file.php" method="post">
                            <input type="text" style="display:none" value="<?=$file_chemin?>" name="file_chemin">
                            <button name="view" class="btn btn-primary ">View file</button>
                        </form>
                        </div>
                        <div>
                        <form action="telecharger_fichier.php" method="post">
                            <input type="text" style="display:none" value="<?=$file_chemin?>" name="file_chemin">
                            <input type="text" style="display:none" value="<?=$file_name?>" name="file_name">
                            <button name="view" class="btn btn-primary ">Telecharger</button>
                        </form>
                        </div>
                        </div>
                        <?php
                    }
                }
            ?>
            </div>
            <?php
            $id_sous= $row['id_sous'];
    }
    ?>
    </div>
    <?php
    $sql = "select * from reponses where id_sous = '$id_sous' and id_etud = (select id_etud from etudiant where email = '$email') ";
    $req = mysqli_query($conn,$sql);
    if (mysqli_num_rows($req) == 0) {
    ?>
    <p>
        <a href="reponse_etudiant.php?id_sous=<?=$id_sous?>" class="btn btn-primary">Rendre le travail</a>
    </p>
    <?php
    }else{
    ?>
    <p>
        <a href="reponse_etudiant.php?id_sous=<?=$id_sous?>" class="btn btn-primary">Modifier le travail</a>
    </p>
    <?php
    }
    ?>
</div>
</div>

</body>
</html>