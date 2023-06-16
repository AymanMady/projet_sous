<title>Les matiéres</title>
<?php
session_start() ;
$email = $_SESSION['email'];
// if($_SESSION["role"]!="admin"){
//     header("location:authentification.php");
// }

include "../nav_bar.php";
?>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a>
                          
                </li>
                <li>Gestion des matiéres</li>

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
                                <button  type="submit" class="btn btn-info">Filtre</button>

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
        <a href="ajoute_matiere.php" class = "btn btn-primary" >Nouveau</a>
    </p>
    <div style="overflow-x:auto;">
  <table class="table table-striped table-bordered">
        <tr>
            <th>Code</th>
            <th>Libelle</th>
            <th>Specialite</th>
            <th colspan="4">Actions</th>
        </tr>
    <?php
include_once "../connexion.php";



// Vérification si des matières existent
$matiere_query = "SELECT * FROM matiere"; 
$matiere_result = mysqli_query($conn, $matiere_query);

if (mysqli_num_rows($matiere_result) == 0) {
    echo "Il n'y a pas encore de matières ajoutées !";
} else {
    ?>
  
        <?php
        while ($row = mysqli_fetch_assoc($matiere_result)) {
            ?>
            <tr>
                <td><?= $row['code'] ?></td>
                <td><?= $row['libelle'] ?></td>
                <td><?= $row['specialite'] ?></td>               
                <td><a href="detail_matiere.php?id_matiere=<?= $row['id_matiere'] ?>">Details</a></td>
                <td><a href="affecter_matiere.php?id_matiere=<?= $row['id_matiere'] ?>">Affecter</a></td>
                <td><a href="supprimer_matiere.php?id_matiere=<?= $row['id_matiere'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette matière ?')">Supprimer</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>
</div>
</body>
</html>

