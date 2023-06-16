<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

include "../nav_bar.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les etudiants</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
</head>
<body>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a>
                    
                </li>
                <li>Gestion des groupes</li>
                   
            </ol>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="well">
                
                    <fieldset class="fsStyle">
                        <legend class="legendStyle">
                            <a data-toggle="collapse" data-target="#demo" href="#">Filtre</a>
                        </legend>
                        <div class="collapse in" id="demo">
                            <div class="search-box">
                                <div class="form-group">
                                    <div class="col-md-4 col-sm-3">
                                        <input type="text" name="search" value="" class="search-text form-control" placeholder="Chercher..." />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Filtre</button>

                            </div>
                        </div>
                    </fieldset>
                
            </div>
        </div>
    </div>
    <div class="text-center">
       
    </div>
    <br>
    <p>
        <a href="ajouter_groupe.php" class = "btn btn-primary" >Nouveau</a>
    </p>
    
    <div style="overflow-x:auto;">

        <table class="table table-striped table-bordered">
            <tr>
                    <th>Libelle</th>
                    <th>Filière</th>
                    <th colspan="2">action</th>
            </tr>


            <?php 
                    include_once "../connexion.php";
                    $req = mysqli_query($conn , "SELECT * FROM groupe");
                    if(mysqli_num_rows($req) == 0){
                        echo "Il n'y a pas encore des groupes ajouter !" ;
                        
                    }else {
                        while($row=mysqli_fetch_assoc($req)){
                            ?>
                            <tr>
                                <td><?=$row['libelle']?></td>
                                <td><?=$row['filiere']?></td>
                                <td><a href="modifier_groupe.php?id_groupe=<?=$row['id_groupe']?>">Modifier</a></td>
                                <td><a href="supprimer_groupe.php?id_groupe=<?=$row['id_groupe']?>"onclick="return confirm(`voulez-vous vraiment supprimé ce utilisateur ?`)"> Supprimer</a></td>
                            </tr>
                            <?php
                        }
                    }
                ?>

        </table>
    </div>
    <div class="pager">
            </div>

</div>

</body>
</html>