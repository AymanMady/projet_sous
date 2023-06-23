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


    <!-- sweetalert2 links -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">


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
    <div style="display: flex ; justify-content: space-between;">
        <a href="ajouter_inscription.php" class = "btn btn-primary mr-25" >Nouveau</a>
        <a href="importe_iscription.php"  class="btn btn-primary ml-25">Importer</a>
    </div>
    <br>

    
    <div style="overflow-x:auto;">

        <table class="table table-striped table-bordered">
            <tr>
                    <th>Matricule de l'etudiant</th>
                    <th>Nom du semestre</th>
                    <th>Code matiere</th>
                    <th colspan="2">Actions</th>
            </tr>


            <?php 
                    include_once "../connexion.php";
                    $req = mysqli_query($conn , "SELECT * FROM semestre
                     INNER JOIN inscription ON inscription.id_semestre = semestre.id_semestre INNER JOIN
                      matiere ON inscription.id_matiere = matiere.id_matiere INNER JOIN 
                      etudiant ON inscription.id_etud = etudiant.id_etud;");
                    if(mysqli_num_rows($req) == 0){
                        echo "Il n'y a pas encore  des inscriptions ajouter !" ;
                        
                    }else {
                        while($row=mysqli_fetch_assoc($req)){
                            // $id_matiere=$row['id_matiere'];
                            // $id_etud=$row['id_etud'];
                            // $id_semestre=$row['id_semestre'];
                            // $req_matiere = mysqli_query($conn , "SELECT * FROM matiere where id_matiere = $id_matiere");
                            // $req_etudiant = mysqli_query($conn , "SELECT * FROM etudiant where id_etud =$id_etud ");
                            // $req_semestre = mysqli_query($conn , "SELECT * FROM semestre where id_semestre =$id_semestre ");

                            // try{
                            // $row_matiere=mysqli_fetch_assoc($req_matiere);
                            // $row_etudiant=mysqli_fetch_assoc($req_etudiant);
                            // $row_semestre=mysqli_fetch_assoc($req_semestre);
                            // }
                            // catch(Exception){

                            // }
                            ?>
                            <tr>
                            <td><?=$row['matricule']?></td>
                            <td><?=$row['nom_semestre']?></td>
                            <td><?=$row['code']?></td>
                            
                            <td><a href="modifier_inscription.php?id_insc=<?=$row['id_insc']?>">Modifier</a></td>
                            <td><a href="supprimer_inscription.php?id_insc=<?=$row['id_insc']?>" id="supprimer"> Supprimer</a></td>
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

// Dans la partie où vous affichez le contenu de la page inscription.php
if (isset($_SESSION['ajout_reussi']) && $_SESSION['ajout_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Ajout réussi !',
        text: 'L\'inscription a été ajouté avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['ajout_reussi']);
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
      title: "Voulez-vous vraiment supprimer cette inscription ?",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Supprimer"
    }).then((result) => {
      if (result.isConfirmed) {
        // Afficher la deuxième boîte de dialogue pendant 1 seconde avant la redirection
        Swal.fire({
          title: "Suppression réussie !",
          text: "L'inscription a été supprimée avec succès.",
          icon: "success",
          confirmButtonColor: "#3099d6",
          confirmButtonText: "OK",
          //timer: 3000, // Durée d'affichage de la boîte de dialogue en millisecondes
          //timerProgressBar: true,
          showConfirmButton: true
        }).then(() => {
          // Redirection après le délai
          window.location.href = this.href;
        });
      }
    });
  });
});

    
  //});
//});

</script>