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
    <title>Ajouter</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
</head>
<body>

    <?php
              include_once "../connexion.php";
            function test_input($data){
                $data = htmlspecialchars($data);
                $data = trim($data);
                $data = htmlentities($data);
                $data = stripcslashes($data);

                return $data;
            }

       if(isset($_POST['button'])){
                $matricule = test_input($_POST['matricule']);
                $semestre = test_input($_POST['Semestre']);
                $annee = test_input($_POST['annee']);
                $nom =  test_input($_POST['nom']);
                $prenom = test_input($_POST['prenom']); 
                $Date_naiss = test_input($_POST['Date_naiss']); 
                $lieu_naiss =  test_input($_POST['lieu_naiss']);
                $email =  test_input($_POST['email']);
           if( !empty($matricule) && !empty($semestre)  && !empty($annee) && !empty($nom) && !empty($prenom) && !empty($Date_naiss) && !empty($lieu_naiss)  && !empty($email)){
                $req = "INSERT INTO `etudiant`( `matricule`, `nom`,`prenom`,`lieu_naiss`, `Date_naiss`, `semestre`,`annee`, `email`,`id_role`) VALUES('$matricule', '$nom','$prenom','$lieu_naiss','$Date_naiss', '$semestre','$annee','$email',3)";
                                
                $req = mysqli_query($conn , $req);
                if($req){
                    header("location: etudiant.php");
                }else {
                    $message = "Etudiant non ajouté";
                }

           }else {
               $message = "Veuillez remplir tous les champs !";
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
                    <li>Gestion des utisateurs</li>
                    <li>Ajouter un etudiant</li>
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
                <input type="text" name="matricule" class = "form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-1" >Nom</label>
            <div class="col-md-6">
            <input type="text" name="nom" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Prénom</label>
            <div class="col-md-6" >
            <input type="text" name="prenom" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Lieu de naissance</label>
            <div class="col-md-6" >
            <input type="text" name="lieu_naiss" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Date de naissance</label>
            <div class="col-md-6" >
            <input type="date" name="Date_naiss" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Semestre</label>
            <div class="col-md-6" >
            <input type="text" name="Semestre" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Année</label>
            <div class="col-md-6" >
            <input type="text" name="annee" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >E-mail</label>
            <div class="col-md-6" >
            <input type="text" name="email" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="button" value=Enregistrer class="btn-primary"  />

            </div>
        </div>

        </form>

</div>
</div>


</body>
</html>