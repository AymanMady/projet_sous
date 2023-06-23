<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

include_once "../connexion.php";

$etudiant = "SELECT * FROM etudiant ";
$etudiant_qry = mysqli_query($conn, $etudiant); 
$semestre = "SELECT * FROM semestre ";
$semestre_qry = mysqli_query($conn, $semestre);
$matiere = "SELECT * FROM matiere ";
$matiere_qry = mysqli_query($conn, $matiere);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>

</head>
<body>

    <?php
   
             
            function test_input($data){
                $data = htmlspecialchars($data);
                $data = trim($data);
                $data = htmlentities($data);
                $data = stripcslashes($data);

                return $data;
            }

       if(isset($_POST['button'])){
                $matricule = test_input($_POST['matricule']);
                $semestre = test_input($_POST['semestre']);
                $code =  test_input($_POST['code']);


                    // Vérification si l'étudiant est déjà inscrit pour cette matière dans ce semestre 
                    $verification = "SELECT * FROM inscription WHERE id_etud = '$matricule' AND id_semestre = '$semestre' AND id_matiere = '$code'";
                    $verification_qry = mysqli_query($conn, $verification);
                
                    if (mysqli_num_rows($verification_qry) > 0) {
                        // Étudiant déjà inscrit pour la matière dans le semestre donné
                        $message = "Cet étudiant est déjà inscrit à cette matière dans ce semestre.";
                } else {

                            if( !empty($matricule) && !empty($semestre)  && !empty($code)){
                                    $req = "INSERT INTO `inscription`( `id_etud`, `id_semestre`, `id_matiere`) VALUES('$matricule','$semestre','$code')";
                                                    
                                    $req = mysqli_query($conn , $req);
                                    if($req){
                                        header("location: inscription.php");
                                        //header("location: inscription.php?succes=1");
                                        $_SESSION['ajout_reussi'] = true;
                                    }else {
                                        $message = "Inscription non ajouté";
                                    }

                            }else {
                                $message = "Veuillez remplir tous les champs !";
                            }
                        }
                    }
                        include "../nav_bar.php";

    ?>

</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
                    </li>
                    <li>Gestion des inscriptions</li>
                    <li>Ajouter une inscription</li>
            </ol>
        </div>
    </div>
   
<div class="form-horizontal">
    <br /><br />

    <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
    <form action="" method="POST">
            <div class="form-group">
                <label class="col-md-1">Matricule</label>
                <div class="col-md-6">
                    <select class = "form-control" id="academic" value="Matricules" name="matricule">
                        <option selected disabled> Les Matricules </option>
                                <?php while ($row_etudiant = mysqli_fetch_assoc($etudiant_qry)) : ?>
                            <option value="<?= $row_etudiant['id_etud']; ?>"> <?= $row_etudiant['matricule']; ?> </option>
                        <?php endwhile; ?> 
                    </select>        
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-1" >Semester</label>
                <div class="col-md-6">
                    <select class = "form-control" id="academic" value="Semestres" name="semestre">
                        <option selected disabled> Semesters </option>
                                <?php while ($row_semestre = mysqli_fetch_assoc($semestre_qry)) : ?>
                            <option value="<?= $row_semestre['id_semestre']; ?>"> <?= $row_semestre['nom_semestre']; ?> </option>
                        <?php endwhile; ?> 
                    </select>             
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-1" >Code</label>
                <div class="col-md-6" >
                        <select class = "form-control" id="academic" value="Codes" name="code">
                            <option selected disabled> Les codes </option>
                                    <?php while ($row_matiere = mysqli_fetch_assoc($matiere_qry)) : ?>
                                <option value="<?= $row_matiere['id_matiere']; ?>"> <?= $row_matiere['code']; ?> </option>
                            <?php endwhile; ?> 
                        </select>             
                </div>
            </div>
            
            <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" name="button" value="Enregistrer" class="btn-primary"  />

                    </div>
            </div>
    </form>
</div>
    <!-- </div>
</div>


</div>
</div> -->


</body>
</html>