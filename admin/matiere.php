<title>Les matiéres</title>
<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

include "../nav_bar.php";
?>


    <!-- sweetalert2 links -->

    <script src="../JS/sweetalert2.js"></script>


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
    <div style="display: flex ; justify-content: space-between;">
        <a href="ajoute_matiere.php" class = "btn btn-primary" >Nouveau</a>
        <a href="importe_matiere.php"  class="btn btn-primary ml-25">Importer</a>
    </div>
    <br>
    <div style="overflow-x:auto;">
  <table class="table table-striped table-bordered">
        <tr>
            <th>Code</th>
            <th>Libelle</th>
            <th>Semestre</th>
            <th>Specialite</th>
            <th colspan="4">Actions</th>
        </tr>
    <?php
include_once "../connexion.php";



// Vérification si des matières existent
$matiere_query = "SELECT * FROM matiere INNER JOIN semestre USING(id_semestre)"; 
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
                <td><?= $row['nom_semestre'] ?></td>
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

<?php
//if (isset($_GET['succes']) && $_GET['succes'] == 1) {

if (isset($_SESSION['ajout_reussi']) && $_SESSION['ajout_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Ajout réussi !',
        text: 'La matiére a été ajouté avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['ajout_reussi']);
}


if (isset($_SESSION['supp_reussi']) && $_SESSION['supp_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Suppression réussi !',
        text: 'La matiére a été supprimer avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['supp_reussi']);
}


if (isset($_SESSION['modifier_reussi']) && $_SESSION['modifier_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Modification réussi !',
        text: 'La matiére a été modifier avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['modifier_reussi']);
}



if (isset($_SESSION['affecter_reussi']) && $_SESSION['affecter_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Affectation réussi !',
        text: 'La matiére a été affecter avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['affecter_reussi']);
}

?>
</div>
</body>
</html>

