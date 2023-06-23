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
    $req_detail="SELECT * FROM `reponses`,`etudiant`,`fichiers_reponses` WHERE reponses.id_etud=etudiant.id_etud and reponses.id_rep=fichiers_reponses.id_rep and reponses.id_rep='$id_rep'";
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
</head>
<body>
</br></br></br>
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
<div class="container">
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
    ?>
        </div>
            <div class="alert alert-info" style="margin-left: 600px; width:400px; height:300px;position:relative;" >
                <strong style="position:absolute;top: 2;left: 0;"  >Le(s) Fichier(s)</strong><br><br>
                <div style="position:absolute;top: 6;left: 2;">
                <?php
                $sql2 = "select * from fichiers_reponses where id_rep='$id_rep' ";
                $req2 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($req2) == 0){
                    echo "Il n'y a pas des fichier ajouter !" ;
                }else {
                    while($row2=mysqli_fetch_assoc($req2)){
                        ?>
                        <a href="<?=$row2['chemin_fichiere']?>"><?=$row2['nom_fichiere']?></a><br><br>
                        <?php
                    }
                }
                ?>
                </div>
            </div>
        </div>
        <p>
        <a href="reponses_etud.php?id_sous=<?=$row['id_sous']?>" class="btn btn-primary">Retour</a>
    </p>

</div>
</div>

</body>
</html>
