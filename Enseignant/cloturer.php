
<br><br><br>
<?php
 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="ens"){
     header("location:authentification.php");
 }
 include_once "../connexion.php";
 $id_sous = $_GET['id_sous'];
 $req = mysqli_query($conn , "SELECT * FROM soumission WHERE id_sous ='$id_sous'");
 $row = mysqli_fetch_assoc($req);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="#">Acceuil</a>
                    
                </li>
                <li>Les soumissions en ligne</li>
                <li>Cloturer la soumission :<?php echo $row['date_fin'] ?></li>
                   
            </ol>
        </div>
    </div>

 
    <?php
    


        if(isset($_POST['button'])){ 
        extract($_POST);
        if( !empty($fin)  ){
            $req = mysqli_query($conn, "UPDATE soumission SET   date_fin = '$fin' WHERE id_sous = '$id_sous'");
            if($req){
                header('location:soumission_en_ligne.php');
            }else {
                $message = "soumission non modifié";
            }

        }else {
            $message = "Veuillez remplir tous les champs !";
        }
        }
        include "../nav_bar.php";


        ?>    


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
            <label class="col-md-1">Date fin</label>
            <div class="col-md-6">
                <input type="datetime-local" name="fin" class = "form-control" value="<?=$row['date_fin']?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="button" value=Enregistrer class="btn-primary"  />

            </div>
        </div>

 
</form>
</body>
</html>

