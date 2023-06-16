<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}
?>

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
        $libelle = test_input($_POST['libelle']);
        $filiere = test_input($_POST['Filiere']); 
           if( !empty($libelle) && !empty($filiere) ){
                $req = mysqli_query($conn , "INSERT INTO groupe(`libelle`, `filiere`) VALUES('$libelle', '$filiere')");
                if($req){
                    header("location: groupe.php");
                }else {
                    $message = "groupe non ajouté";
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
                <input type="text" name="libelle" class = "form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-1" >Filiére</label>
            <div class="col-md-6">
            <input type="text" name="Filiere" class = "form-control">
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