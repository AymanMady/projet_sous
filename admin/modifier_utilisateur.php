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

            include_once "../connexion.php";
            $id_user = $_GET['id_user'];
            $req = mysqli_query($conn , "SELECT * FROM utilisateur WHERE id_user = $id_user");
            $row = mysqli_fetch_assoc($req);
            if(isset($_POST['button'])){ 
                $login =  test_input($_POST['login']);
                $pwd =  md5(test_input($_POST['pwd']));
                $role =  test_input($_POST['role']);

                //test_input(extract($_POST));
            
            if( !empty($pwd)  && !empty($login) && !empty($role)){
                $req = mysqli_query($conn, "UPDATE utilisateur SET pwd = '$pwd', login = '$login', id_role = '$role'  WHERE id_user = $id_user");

                if($req){
                    header("location: utilisateurs.php");
                }else {
                    $message = "utilisateur non modifié";
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
                    <li>Modifier un utisateur</li>
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
                    <input type="email" name="login" class = "form-control" value="<?=$row['login']?>">
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
                <input type="text" name="role" class = "form-control" value="<?=$row['id_role']?>">
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