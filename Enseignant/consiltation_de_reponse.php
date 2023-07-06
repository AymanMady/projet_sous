<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="ens"){
    header("location:authentification.php");
}
?>
<?php
    $id_rep=$_GET['id_rep'];
    include "../nav_bar.php";
    $req_detail="SELECT * FROM `reponses`,`etudiant`,`fichiers_reponses`
     WHERE reponses.id_etud=etudiant.id_etud and
      reponses.id_rep=fichiers_reponses.id_rep and reponses.id_rep='$id_rep'";
    $req = mysqli_query($conn , $req_detail);
    $row=mysqli_fetch_assoc($req);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailler matiere par enseignant </title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    .submission-div {
        display: flex;
        align-items: center;
        height: 200px;
    }

    .description { 
        flex: 1;
        padding-right: 100px;
        background-color: aliceblue;
        min-height: 100%;
    }

    .response-count {
        width: 200px;
        margin-left: 10px;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        margin-left: 50px;
    }
    .nbr_etud {
        font-size: 50px;
    }
    .descri {
        text-align: center;
        font-size: 25px;
        font-weight: bold;
    }
    .descri_contenu{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-left: 15px;
    }
</style>

</head>
<body>
</br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a>       
                </li>
                <li>Reponse de l'etudiant  <?php //echo $nom_ens ?> </li>     
            </ol>
        </div>
    </div>
    <br>
    <br>
    <br>
<div class="container">
<div class="submission-div">
        <div class="row justify-content-center">
        <div class="col-md-10">
            <fieldset>
                <br><br>
                <?php
                $req_detail = "SELECT * FROM reponses inner join etudiant using(id_etud) WHERE id_rep = $id_rep  ";
                $req = mysqli_query($conn , $req_detail);
                while($row=mysqli_fetch_assoc($req)){
                    ?>
                <h4>
                <?php echo "<strong>Matricule : </strong>". $row['matricule']; ?><br><br>
                <?php echo "<strong>nom est prenom de l'etudiant  : </strong>" . $row['nom']." ".$row['prenom']; ?><br><br>
                <?php echo "<strong>Description : </strong>". $row['description_rep'];  ?><br><br>
                <?php echo "<strong>Date : </strong>". $row['date']; ?><br><br>
                </h4>
               
            </fieldset>
            <br><br>
            <?php
                }
                $req_detail = "SELECT * FROM reponses inner join etudiant using(id_etud) WHERE id_rep = $id_rep  ";
                $req = mysqli_query($conn , $req_detail);
                $row=mysqli_fetch_assoc($req)
            ?>
        </div>
            <div class="alert alert-info" style="margin-left: 600px; width:400px; height:300px;position:relative;" >
                <strong style="position:absolute;top: 2;left: 0;"  >Le(s) Fichier(s)</strong><br><br>
                <div style="position:absolute;top: 6;left: 2; width: 380px;">
                <?php
                $sql2 = "select * from fichiers_reponses where id_rep='$id_rep' ";
                $req2 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($req2) == 0){
                    echo "Il n'y a pas des fichier ajouter !" ;
                }else {
                    while($row2=mysqli_fetch_assoc($req2)){
                        ?>
                        <?php 
                        $file_chemin = $row2['chemin_fichiere'];
                        $file_name=$row2['nom_fichiere'];
                        ?>
                        <div style="display: flex ; justify-content: space-between; " >
                        <div>
                        <strong><p><?=$row2['nom_fichiere']?></p></strong>
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
            </div>
 </div>


        <div class="response-count" >
            <h3>le note de l'etudiant = </h3>
            <div class="nbr_etud">
            <?php
            if($row['note']!=NULL){
            echo $row['note'] ;
            }
            else {
                echo "NULL";
            }?>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<?php

    ?>
<div style="display: flex ; justify-content: space-between;">
<div>
<a href="reponses_etud.php?id_sous=<?=$row1['id_sous']?>" class="btn btn-primary">Retour</a>
</div>
<a href="affecte_une_note.php?id_etud=<?= $id_rep?>"  class="btn btn-primary mr-25">donne une Note</a>
</div>
</div>


</body>
</html>
