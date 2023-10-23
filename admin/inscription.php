<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

include "../nav_bar.php";

include_once "../connexion.php";
$searched = false;

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $req = mysqli_query($conn, "SELECT * FROM semestre
    INNER JOIN inscription ON inscription.id_semestre = semestre.id_semestre 
    INNER JOIN matiere ON inscription.id_matiere = matiere.id_matiere INNER JOIN 
     etudiant ON inscription.id_etud = etudiant.id_etud where nom_semestre LIKE '%{$search}%' OR code LIKE '%{$search}%' OR matricule LIKE '%{$search}%' ORDER by matricule asc;");
    if( $search!=""){
    $searched = true;
    }
   
}
 else {
$req = mysqli_query($conn , "SELECT * FROM semestre
 INNER JOIN inscription ON inscription.id_semestre = semestre.id_semestre 
 INNER JOIN matiere ON inscription.id_matiere = matiere.id_matiere INNER JOIN 
  etudiant ON inscription.id_etud = etudiant.id_etud ;");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les inscriptions</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>


    <!-- sweetalert2 links -->

    <script src="../JS/sweetalert2.js"></script>


</head>
<body>
</br></br></br>
<div class="container">
    
    
    <?php if (!$searched) { ?>
        <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a></li>
                <li>Gestion des inscription</li>
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
                            <form method="POST">
                                <div class="search-box">
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-3">
                                            <input type="text" name="search" value="" class="search-text form-control" placeholder="Chercher..." />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <br>
        <!-- href="importe_iscription.php" -->
        <div style="display: flex ; justify-content: space-between;">
        <a href="ajouter_inscription.php" class = "btn btn-primary mr-25" >Nouveau</a>
        <a href="importe_iscription.php"  class="btn btn-primary ml-25" id="new">Importer</a>
    </div>
    
    <br>
    <?php } ?>

 

    
    <div style="overflow-x:auto;">

        <table class="table table-striped table-bordered">
            <tr>
                    <th>Matricule de l'etudiant</th>
                    <th>Code matiere</th>
                    <th>Semestre</th>
                    <th colspan="2">Actions</th>
            </tr>


            <?php 
                
                   
                   
                    if(mysqli_num_rows($req) == 0){
                        echo "Il n'y a pas encore  des inscriptions ajouter !" ;
                        
                    }else {
                        while($row=mysqli_fetch_assoc($req)){
                            ?>
                            <tr>
                            <td><?=$row['matricule']?></td>
                            <td><?=$row['code']?></td>
                            <td><?=$row['nom_semestre']?></td>
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


if (isset($_SESSION['supp_reussi']) && $_SESSION['supp_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Suppression réussi !',
        text: 'L\'inscription a été supprimer avec succès.',
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
        text: 'L\'inscription a été modifier avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['modifier_reussi']);
}

if (isset($_SESSION['import_reussi']) && $_SESSION['import_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Importation réussi !',
        text: 'Le(s) inscription(s) a été importer avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['import_reussi']);
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
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Supprimer"
    }).then((result) => {
      if (result.isConfirmed) {

            window.location.href = this.href;
            }
        });
      });
    });

$(document).ready(function(){
    $('.search-text').on('input', function(){
        var search = $(this).val();
        if(search != '') {
            $.ajax({
                url:'inscription.php',
                method:'POST',
                data:{search:search},
                success:function(response){
                    $('tbody').html(response);
                }
            });
        } else {
            $.ajax({
                url:'inscription.php',
                method:'POST',
                success:function(response){
                    $('tbody').html(response);
                }
            });
        }
    });
});
   
</script>
