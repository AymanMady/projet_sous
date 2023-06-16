<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <li>Gestion des enseignants</li>

            </ol>
        </div>
    </div>
    <?php  
    include "../nav_bar.php"; 
include_once "../connexion.php";
$id_ens = $_GET['id_ens'];


$req_detail = "SELECT * FROM enseignant WHERE id_ens = $id_ens";
$req = mysqli_query($conn , $req_detail);
while($row=mysqli_fetch_assoc($req)){
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="well">
                
                    <fieldset class="fsStyle">
                        <legend class="legendStyle">
                            <a data-toggle="collapse" data-target="#demo" href="#">Détails sur l'enseignant <?= $row['nom']?></a>
                        </legend>
                        <div class="collapse in" id="demo">
                            <div class="search-box">

                                <div class="form-group">
                                    <div class="col-md-4 col-sm-3">
                                    <div class="container">
                                            <div class="row justify-content-center">
                                            <div class="col-md-6">
                                            <br><br>
                                                <fieldset>
                                                        <h4 style="min-height:3px;">                     
                                                            <?php echo "<strong class='font-weight-bold'>Nom : </strong>". $row['nom']; ?><br>
                                                            <?php echo " <strong class='font-weight-bold'>Prenom : </strong>" . $row['prenom']; ?>
                                                            <br><?php echo "<strong class='font-weight-bold'>Date de naissance : </strong>".$row['Date_naiss']; ?><br>
                                                            <?php echo "<strong class='font-weight-bold'>Lieu de naissance : </strong>". $row['lieu_naiss']; ?><br>
                                                            <?php echo "<strong class='font-weight-bold'>E-mail : </strong>".$row['email']; ?><br>
                                                            <?php echo "<strong class='font-weight-bold'>Numéro de téléphone : </strong>".$row['num_tel']; ?><br>
                                                            <?php echo "<strong class='font-weight-bold'>Numéro de WhatsApp : </strong>".$row['num_whatsapp']; ?><br>
                                                            <?php echo "<strong class='font-weight-bold'>Diplôme : </strong>".$row['diplome']; ?><br>
                                                            <?php echo "<strong class='font-weight-bold'>Grade : </strong>".$row['grade']; ?><br>

                                                        </h4>
                                                
                                                </fieldset>
                                                <br><br>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                    </fieldset>
            </div>
        </div>
    </div>



  <p>
        <a href="etudiant.php" class = "btn btn-primary" >Retour</a>
        </p>
<?php
    
}

?>
</body>
</html>