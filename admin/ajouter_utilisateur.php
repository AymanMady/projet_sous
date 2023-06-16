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

         

                // $matricule = test_input($_POST['matricule']);
                // $semestre = test_input($_POST['semestre']);
                // $annee = test_input($_POST['annee']);
                // $nom =  test_input($_POST['nom']);
                // $prenom = test_input($_POST['prenom']); 
                // $Date_naiss = test_input($_POST['Date_naiss']); 
                // $lieu_naiss =  test_input($_POST['lieu_naiss']);
                // $login =  test_input($_POST['login']);
                
                   $login =  test_input($_POST['login']);
                   $pwd =  md5(test_input($_POST['pwd']));
                   $role =  test_input($_POST['role']);
                //test_input(extract($_POST));
           if(  !empty($login)  && !empty($pwd)  && !empty($role) ){

                $req = "INSERT INTO utilisateur (`login`,`pwd`,`active`,`id_role`)VALUES('$login','$pwd',1,'$role')";

                //echo $req;               
                $req = mysqli_query($conn , $req);
                if($req){
                    header("location: utilisateurs.php");
                }else {
                    $message = "utilisateur non ajouté";
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
            <li><a href="acceuil.php">Acceuil</a>
                    
                    </li>
                    <li>Gestion des utisateurs</li>
                    <li>Ajouter un utisateur</li>
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
            <label class="col-md-1">E-mail</label>
            <div class="col-md-6">
                <input type="email" name="login" class = "form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-1" >Password</label>
            <div class="col-md-6">
            <input type="password" name="pwd" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Role</label>
            <div class="col-md-6" >
            <input type="text" name="role" class = "form-control">
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