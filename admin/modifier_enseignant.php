<title>Modifier enseignant</title>

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
        $id_ens = $_GET['id_ens'];
        $req = mysqli_query($conn , "SELECT * FROM enseignant WHERE id_ens = $id_ens");
        $row = mysqli_fetch_assoc($req);


        if(isset($_POST['button'])){ 
        extract($_POST);
        if( !empty($nom) && !empty($prenom) && !empty($Date_naiss) && !empty($lieu_naiss)  && !empty($email) && !empty($numtel) && !empty($diplome) && !empty($grade)  ){
            $req = mysqli_query($conn, "UPDATE enseignant SET   nom = '$nom', prenom = '$prenom', Date_naiss = '$Date_naiss', lieu_naiss = '$lieu_naiss', `email` = '$email', `num_tel` = '$numtel', `num_whatsapp` = '$numwhatsapp', diplome = '$diplome', grade = '$grade' WHERE id_ens = $id_ens");
            if($req){
                header('location:enseignant.php');
                $_SESSION['modifier_reussi'] = true;
            }else {
                $message = "enseignant non modifié";
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
        <div class="col-lg-11">
            <ol class="breadcrumb">
            <li><a href="acceuil.php">Acceuil</a>
                    </li>
                    <li>Gestion des enseignants</li>
                    <li>Modifier un enseignant</li>
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
                <input type="text" name="nom" class = "form-control" value="<?=$row['nom']?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-1" >Prénom</label>
            <div class="col-md-6">
            <input type="text" name="prenom" class = "form-control"  value="<?=$row['prenom']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Date de naissance</label>
            <div class="col-md-6" >
            <input type="date" name="Date_naiss" class = "form-control" value="<?=$row['Date_naiss']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Lieu de naissance</label>
            <div class="col-md-6" >
            <input type="text" name="lieu_naiss" class = "form-control" value="<?=$row['lieu_naiss']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >E-mail</label>
            <div class="col-md-6" >
            <input type="email" name="email" class = "form-control" value="<?=$row['email']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Numéro de téléphone</label>
            <div class="col-md-6" >
            <input type="text" name="numtel" class = "form-control" value="<?=$row['num_tel']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Numéro de WhatsApp</label>
            <div class="col-md-6" >
            <input type="text" name="numwhatsapp" class = "form-control" value="<?=$row['num_whatsapp']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Diplôme</label>
            <div class="col-md-6" >
            <input type="text" name="diplome" class = "form-control" value="<?=$row['diplome']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Grade</label>
            <div class="col-md-6" >
            <input type="text" name="grade" class = "form-control" value="<?=$row['grade']?>">
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










