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

    <style>
       .submission-div {
    display: flex;
    align-items: center;
    height: 200px;
    justify-content: center;
}

.description { 
    flex: 1;
    padding-right: 100px;
    background-color: aliceblue;
    min-height: 100%;
}

.response-count {
    width: 200px;
    background-color: #f1f1f1;
    padding: 10px;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
    border-radius: 5px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    top: -150px;
    left: 425px;
}

.nbr_etud {
    font-size: 30px;
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
</br></br></br>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="index_etudiant.php">Acceuil</a></li>
                <li>Détails sur la soumission</li>
            </ol>
        </div>
    </div>
    <?php

    include_once "../connexion.php";
    if(!empty($_GET['id_sous'])){
        $id_sous = $_GET['id_sous'];
    }else{
        $id_sous= $_SESSION['id_sous'];
    }

    $req_detail = "SELECT * FROM soumission  WHERE id_sous = $id_sous and (status=0 or status=1)  ";
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
    <div class="alert alert-info" style="margin-left: 500px; width:400px; height:300px;position:relative;" > 
            <strong style="position:absolute;top: 2;left: 0;"  >Le(s) Fichier(s)</strong><br><br>
            <div style="position:absolute;top: 6;left: 2;width: 380px;">
            <?php
                $sql2 = "select * from fichiers_soumission where id_sous='$id_sous' ";
                $req2 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($req2) == 0){
                    echo "Il n'y a pas des fichier ajouter !" ;
                }else {
                    while($row2=mysqli_fetch_assoc($req2)){
                        $file_name=$row2['nom_fichier'];
                        ?>
                        <div style="display: flex ; justify-content: space-between; " >
                        <div>
                        <p><?=$row2['nom_fichier']?> </p>
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
            <?php
            $id_sous= $row['id_sous'];
    }
    $sql17 = "select * from reponses where id_sous = '$id_sous' and id_etud = (select id_etud from etudiant where email = '$email') AND render = 1 ";
    $req17 = mysqli_query($conn,$sql17);
    if(mysqli_num_rows($req17)){
    $row17=mysqli_fetch_assoc($req17)
    ?>
     <div class="response-count" >
            <h3> 
                Note =  <?php echo $row17['note']     ?> 
            </h3>
            <div class="nbr_etud">
            <?php if( $row17['note'] > 0 ){    ?>
                <a href= "reclemation.php" class="btn btn-primary">Reclemation</a>
                <?php  
                }
             }
                ?>
 
            </div>
        </div>
    </div>
    <?php
    $req_detail = "SELECT * FROM soumission  WHERE id_sous = $id_sous and (status=0 or status=1)  ";
    $req11 = mysqli_query($conn , $req_detail);
    $row12=mysqli_fetch_assoc($req11);
    $sql = "select * from reponses where id_sous = '$id_sous' and id_etud = (select id_etud from etudiant where email = '$email') ";
    $req = mysqli_query($conn,$sql);
    if (mysqli_num_rows($req) == 0 and $row12['status']==0) {
    ?>
    <p>
        <a href="reponse_etudiant.php?id_sous=<?=$id_sous?>" class="btn btn-primary">Rendre le travail</a>
    </p>
    <?php
    }elseif(mysqli_num_rows($req) != 0 and $row12['status']==0){
    ?>
    <p>
        <a href="reponse_etudiant.php?id_sous=<?=$id_sous?>" class="btn btn-primary">Modifier le travail</a>
    </p>
    <?php
    }
    ?>
</div>
</div>
<?php
if (isset($_SESSION['ajout_reussi']) && $_SESSION['ajout_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Ajout réussi !',
        text: 'La réponse a été ajouté avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";
  
    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['ajout_reussi']);
  }
?>
</body>
</html>