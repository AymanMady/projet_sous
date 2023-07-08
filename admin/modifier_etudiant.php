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
    <title>Modifier</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
</head>
<body>
<?php
            $id_etud = $_GET['id_etud'];

            function test_input($data){
                $data = htmlspecialchars($data);
                $data = trim($data);
                $data = htmlentities($data);
                $data = stripcslashes($data);

                return $data;
            }

            include_once "../connexion.php";
            if(isset($_POST['button'])){ 
                $matricule = test_input($_POST['matricule']);
                $semestre = test_input($_POST['semestre']);
                $annee = test_input($_POST['annee']);
                $nom =  test_input($_POST['nom']);
                $prenom = test_input($_POST['prenom']); 
                $Date_naiss = test_input($_POST['Date_naiss']); 
                $lieu_naiss =  test_input($_POST['lieu_naiss']);
                $email =  test_input($_POST['email']);
                
            if( !empty($matricule) && !empty($semestre)  && !empty($annee) && !empty($nom) && !empty($prenom) && !empty($Date_naiss) && !empty($lieu_naiss)  && !empty($email) ){
                $req = mysqli_query($conn, "UPDATE etudiant SET  matricule = '$matricule' , id_semestre = '$semestre'  , annee = '$annee' , nom = '$nom', prenom = '$prenom', Date_naiss = '$Date_naiss', lieu_naiss = '$lieu_naiss', email = '$email' WHERE id_etud = '$id_etud'");
                if($req){
                    header("location: etudiant.php");
                    $_SESSION['modifier_reussi'] = true;
                }else {
                    $message = $semestre."etudiant non modifié";
                }

            }else {
                $message = "Veuillez remplir tous les champs !";
            }
            }
            include "../nav_bar.php";
            $semestre = "SELECT * FROM semestre ";
            $req = mysqli_query($conn , "SELECT * FROM etudiant inner join semestre using(id_semestre) WHERE id_etud = $id_etud");
            $row = mysqli_fetch_assoc($req);
    ?>


</br>
</br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
                    </li>
                    <li>Gestion des utisateurs</li>
                    <li>Modifier un etudiant</li>
            </ol>
        </div>
    </div>
   
<div class="form-horizontal">


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
                <input type="text" name="matricule" class = "form-control" value="<?=$row['matricule']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Nom</label>
            <div class="col-md-6">
            <input type="text" name="nom" class = "form-control" value="<?=$row['nom']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Prénom</label>
            <div class="col-md-6" >
            <input type="text" name="prenom" class = "form-control" value="<?=$row['prenom']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Lieu de naissance</label>
            <div class="col-md-6" >
            <input type="text" name="lieu_naiss" class = "form-control" value="<?=$row['lieu_naiss']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Date de naissance</label>
            <div class="col-md-6" >
            <input type="date" name="Date_naiss" class = "form-control" value="<?=$row['Date_naiss']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Semester</label>
            <div class="col-md-6" >
            <?php
                    // Exécuter à nouveau la requête pour récupérer les résultats
                    $semestre_qry = mysqli_query($conn, $semestre);
            ?>
            <select class = "form-control" id="academic" value="Semestres" name="semestre">
                    <option selected disabled> Semesters </option>
                            <?php while ($row = mysqli_fetch_assoc($semestre_qry)) : ?>
                        <option value="<?= $row['id_semestre']; ?>"> <?= $row['nom_semestre']; ?> </option>
                    <?php endwhile; ?> 
                </select>            
               </div>
        </div>
        <?php
            $req = mysqli_query($conn , "SELECT * FROM etudiant inner join semestre using(id_semestre) WHERE id_etud = $id_etud");
            $row = mysqli_fetch_assoc($req);
        ?>
        <div class="form-group">
            <label class="col-md-1" >Année</label>
            <div class="col-md-6" >
            <input type="text" name="annee" class = "form-control" value="<?=$row['annee']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >E-mail</label>
            <div class="col-md-6" >
            <input type="text" name="email" class = "form-control" value="<?=$row['email']?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="button" value=Modifier class="btn-primary"  />

            </div>
        </div>

        </form>

</div>
</div>
</body>
</html>