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
                <li>Inscription</li>
                   
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
        <a href="importe_iscription.php" class = "btn btn-primary" >importe</a>
    </p>
    
    <div style="overflow-x:auto;">

        <table class="table table-striped table-bordered">
            <tr>
                    <th>Matricule de l'etudiant</th>
                    <th>Code matiere</th>
            </tr>


            <?php 
                    include_once "../connexion.php";
                    $req = mysqli_query($conn , "SELECT * FROM inscripsion");
                    if(mysqli_num_rows($req) == 0){
                        echo "Il n'y a pas encore des des inscription ajouter !" ;
                        
                    }else {
                        while($row=mysqli_fetch_assoc($req)){
                            $id_matiere=$row['id_matieres'];
                            $id_etud=$row['id_etudi'];
                            $req1 = mysqli_query($conn , "SELECT * FROM matiere where id_matiere = $id_matiere");
                            $req2 = mysqli_query($conn , "SELECT * FROM etudiant where id_etud =$id_etud ");
                            try{
                            $row1=mysqli_fetch_assoc($req1);
                            $row2=mysqli_fetch_assoc($req2);
                            }
                            catch(Exception){

                            }
                            ?>
                            <tr>
                            <td><?=$row2['matricule']?></td>
                            <td><?=$row1['code']?></td>
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