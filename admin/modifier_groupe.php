<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

?>
                <?php
                

        include_once "../connexion.php";
        $id_groupe = $_GET['id_groupe'];
        $req = mysqli_query($conn , "SELECT * FROM groupe WHERE id_groupe = '$id_groupe'");
        $row = mysqli_fetch_assoc($req);


        if(isset($_POST['button'])){ 
        extract($_POST);
        if( !empty($libelle) && !empty($Filiere) ){
            $req = mysqli_query($conn, "UPDATE groupe SET  libelle = '$libelle', filiere = '$Filiere' WHERE id_groupe = $id_groupe");
            if($req){
                //header("Location: groupe.php");
                echo "<script>window.location.href='groupe.php';</script>";

            }else {
                $message = "groupe non modifié";
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
                    <li>Gestion des groupes</li>
                    <li>Ajouter un groupe</li>
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
            <label class="col-md-1">Libellé</label>
            <div class="col-md-6">
                <input type="text" name="libelle" class = "form-control" value="<?=$row['libelle']?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-1" >Filiére</label>
            <div class="col-md-6">
            <input type="text" name="Filiere" class = "form-control" value="<?=$row['filiere']?>">
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