<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}
include_once "../connexion.php";
$searched = false;

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $req = mysqli_query($conn , "SELECT * FROM groupe g, departement d WHERE g.id_dep = d.id and ( code LIKE '%{$search}%' or libelle LIKE '%{$search}%')  ORDER by libelle asc;");
    if( $search!=""){
    $searched = true;
    }
   
} else {
    $sql ="SELECT * FROM groupe g, departement d WHERE g.id_dep = d.id";
 $req = mysqli_query($conn , $sql);
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

    <script src="../JS/sweetalert2.js"></script>


</head>
<body>
</br></br></br>
<?php if (!$searched) { ?>
        <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a></li>
                <li>Gestion des groupe</li>
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
        <div style="display: flex ; justify-content: space-between;">
        <a href="ajouter_groupe.php" class = "btn btn-primary" >Nouveau</a>
        <a href="import_groupe.php"  class="btn btn-primary ml-25">importer</a>
    </div>
    <br>
    <?php } ?>

        <table class="table table-striped table-bordered">
            <tr>
                    <th>Libelle</th>
                    <th>Filière</th>
                    <th colspan="2">Actions</th>
            </tr>


            <?php 
                    
                    if(mysqli_num_rows($req) == 0){
                        echo "Il n'y a pas encore des groupes ajouter !" ;
                        
                    }else {
                        while($row=mysqli_fetch_assoc($req)){
                            ?>
                            <tr>
                                <td><?=$row['libelle']?></td>
                                <td><?php echo $row['nom']." (".$row['code'].")"?></td>
                                <td><a href="modifier_groupe.php?id_groupe=<?=$row['id_groupe']?>">Modifier</a></td>
                                <td><a href="supprimer_groupe.php?id_groupe=<?=$row['id_groupe']?>" id="supprimer"> Supprimer</a></td>
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
        text: 'Le groupe a été ajouté avec succès.',
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
        text: 'Le groupe a été supprimer avec succès.',
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
        text: 'Le groupe a été modifier avec succès.',
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
      title: "voulez-vous vraiment supprimé ce groupe ?",
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


$(document).ready(function(){
    $('.search-text').on('input', function(){
        var search = $(this).val();
        if(search != '') {
            $.ajax({
                url:'groupe.php',
                method:'POST',
                data:{search:search},
                success:function(response){
                    $('tbody').html(response);
                }
            });
        } else {
            $.ajax({
                url:'groupe.php',
                method:'POST',
                success:function(response){
                    $('tbody').html(response);
                }
            });
        }
    });
});
</script>  
