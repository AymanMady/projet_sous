<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

include "../nav_bar.php";
?>


</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a>
                    
                </li>
                    <li>Gestion des etudiants</li>
                   
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
<!--     <div class="text-center">
       
    </div> -->
    <br>
    <!-- <div class="btn-group">
        <div class="text-left">
        <a href="ajouter_etudiant.php" class = "btn btn-primary" >Nouveau</a>
        </div>
        <div class="text-right" >
        <a href="importer_etudiant.php"  class="btn btn-primary">importer</a>
        </div>
    </div> -->
    <div class="row">
    <div class="col-md-6">
        <div class="btn-group">
        <a href="ajouter_etudiant.php" class = "btn btn-primary mr-25" >Nouveau</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="btn-group">
        <a href="importer_etudiant.php"  class="btn btn-primary ml-25">importer</a>
        </div>
    </div>
    </div>






    <div style="overflow-x:auto;">

<table class="table table-striped table-bordered">
    <tr>
    <th>Matricule</th>
    <th>Nom et Prénom</th>
    <th>Semestre</th>
    <th>E-mail</th>
    <th colspan="2">Action</th>
    </tr>
    <?php 
                    include_once "../connexion.php";
                    $req = mysqli_query($conn , "SELECT * FROM etudiant group by matricule asc;");
                    if(mysqli_num_rows($req) == 0){
                        echo "Il n'y a pas encore des etudiants ajouter !" ;
                        
                    }else {
                        while($row=mysqli_fetch_assoc($req)){
                            ?>
                            <tr>
                                <td><?=$row['matricule']?></td>
                                <td><?=$row['nom']?>
                                <?=$row['prenom']?></td>
                                <?php $row['lieu_naiss']?>
                                <?php $row['Date_naiss']?>
                                <td><?=$row['semestre']?></td>
                                <?php $row['annee']?>
                                <td><?=$row['email']?></td>
                                <td><a href="detail_etudiant.php?id_etud=<?=$row['id_etud']?>">Detailler</a></td>
                                <td><a href="modifier_etudiant.php?id_etud=<?=$row['id_etud']?>">Modifier</a></td>
                                <td><a href="supprimer_etudiant.php?id_etud=<?=$row['id_etud']?>"onclick="return confirm(`voulez-vous vraiment supprimé ce etudiant ?`)">Supprimer</a></td>
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