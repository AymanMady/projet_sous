<?php
include_once "../connexion.php";

// Récupération de la valeur de recherche envoyée en GET
$recherche = $_GET["recherche"];

// Construction de la requête SQL SELECT
$sql = "SELECT etudiant.matricule,etudiant.nom,etudiant.prenom,etudiant.email,etudiant.annee   FROM etudiant WHERE nom LIKE '".$recherche."%' OR prenom LIKE '".$recherche."%'";

// Exécution de la requête SQL
$result = mysqli_query($conn, $sql);

// Affichage des résultats de la recherche
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>Semestre</th><th>Email</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["matricule"]. "</td><td>" . $row["nom"]. "</td><td>" . $row["prenom"]. "</td><td>" . $row["annee"]. "</td><td>" . $row["email"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Aucun résultat trouvé";
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>


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

    <br>
    <div style="display: flex ; justify-content: space-between;">
        <a href="ajouter_etudiant.php" class = "btn btn-primary mr-25" >Nouveau</a>
        <a href="change_semestre.php" class = "btn btn-primary mr-25" >Changement de semestre</a>
        <a href="importer_etudiant.php"  class="btn btn-primary ml-25">importer</a>
    </div>
    <br>





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
                    $req = mysqli_query($conn , "SELECT * FROM etudiant INNER JOIN semestre USING(id_semestre) ORDER by matricule asc;");


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
                                <td><?=$row['nom_semestre']?></td>
                                <?php $row['annee']?>
                                <td><?=$row['email']?></td>
                                <td><a href="detail_etudiant.php?id_etud=<?=$row['id_etud']?>">Dètails</a></td>
                                <td><a href="modifier_etudiant.php?id_etud=<?=$row['id_etud']?>">Modifier</a></td>
                                <td><a href="supprimer_etudiant.php?id_etud=<?=$row['id_etud']?>" id="supprimer">Supprimer</a></td>
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
<?php
//if (isset($_GET['succes']) && $_GET['succes'] == 1) {

if (isset($_SESSION['ajout_reussi']) && $_SESSION['ajout_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Ajout réussi !',
        text: 'L\'etudiant a été ajouté avec succès.',
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
        text: 'L\'etudiant a été supprimer avec succès.',
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
        text: 'L\'etudiant a été modifier avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['modifier_reussi']);
}

?>

</body>
</html>


<script>
var liensArchiver = document.querySelectorAll("#supprimer");

// Parcourir chaque lien d'archivage et ajouter un écouteur d'événements
liensArchiver.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "voulez-vous vraiment supprimé ce etudiant ?",
      text: "",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Supprimer"
    }).then((result) => {
      if (result.isConfirmed) {
        // Afficher la deuxième boîte de dialogue pendant 1 seconde avant la redirection
        //Swal.fire({
        //   title: "Suppression réussie !",
        //   text: "L'inscription a été supprimée avec succès.",
        //   icon: "success",
        //   confirmButtonColor: "#3099d6",
        //   confirmButtonText: "OK",
          //timer: 3000, // Durée d'affichage de la boîte de dialogue en millisecondes
          //timerProgressBar: true,
         // showConfirmButton: true
       // }).then(() => {
          // Redirection après le délai
          window.location.href = this.href;
            }
        });
      });
    });
//   });
// });

   
</script>