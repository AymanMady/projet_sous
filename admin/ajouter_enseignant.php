<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

?>
<br><br><br>
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
        $nom = test_input($_POST['nom']); 
        $prenom = test_input($_POST['prenom']); 
        $Date_naiss = test_input($_POST['Date_naiss']); 
        $lieu_naiss =  test_input($_POST['lieu_naiss']);
        $email =  test_input($_POST['email']);
        $numtel =  test_input($_POST['numtel']);
        $numwhatsapp =  test_input($_POST['numwhatsapp']);
        $diplome =  test_input($_POST['diplome']);
        $grade =  test_input($_POST['grade']);
           
           if( !empty($nom) && !empty($prenom) && !empty($Date_naiss) && !empty($lieu_naiss)  && !empty($email) && !empty($numtel) && !empty($diplome) && !empty($grade)  ){
                $req = "INSERT INTO `enseignant`(`nom`, `prenom`, `Date_naiss`, `lieu_naiss`, `email`,`num_tel`,`num_whatsapp`, `diplome`, `grade`, `id_role`) values ('$nom','$prenom','$Date_naiss', '$lieu_naiss' ,'$email' ,'$numtel' ,'$numwhatsapp' , '$diplome', '$grade', 2)";
            
                if(mysqli_query($conn , $req)){
                    header('location:enseignant.php');
                    $_SESSION['ajout_reussi'] = true;
                }else {
                    $message = "Enseignant non ajouté";
                }

            }
            }
    ?>

<?php
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
                    <li>Gestion des enseignants</li>
                    <li>Ajouter un enseignant</li>
            </ol>
        </div>
    </div>
   
<div class="form-horizontal">
    <br><br>

    <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>


        <form action="" method="POST">
        <div class="form-group">
            <label class="col-md-1">Nom</label>
            <div class="col-md-6">
                <input type="text" name="nom" class = "form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-1" >Prénom</label>
            <div class="col-md-6">
            <input type="text" name="prenom" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Date de naissance</label>
            <div class="col-md-6" >
            <input type="date" name="Date_naiss" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Lieu de naissance</label>
            <div class="col-md-6" >
            <input type="text" name="lieu_naiss" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >E-mail</label>
            <div class="col-md-6" >
            <input type="email" name="email" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Numéro de téléphone</label>
            <div class="col-md-6" >
            <input type="text" name="numtel" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Numéro de WhatsApp</label>
            <div class="col-md-6" >
            <input type="text" name="numwhatsapp" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Diplôme</label>
            <div class="col-md-6" >
            <input type="text" name="diplome" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Grade</label>
            <div class="col-md-6" >
            <input type="text" name="grade" class = "form-control">
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

