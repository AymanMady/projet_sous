
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
                <li>Gestion des enseignants</li>
                   
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
                                        <input type="text" name="search" value="" onkeyup="myFunction()" class="search-text form-control" placeholder="Chercher..." />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Filtre</button>

                            </div>
                        </div>
                    </fieldset>
                
            </div>
            <!-- /well -->
        </div>
    </div>

    
    <div class="text-center">
       
    </div>
    <br>
    <div style="display: flex ; justify-content: space-between;">
        <a href="ajouter_enseignant.php" class = "btn btn-primary" >Nouveau</a>
        <a href="import_enseignant.php"  class="btn btn-primary ml-25">importer</a>
    </div>
    <br>
    <div style="overflow-x:auto;">

        <table class="table table-striped table-bordered">
                <tr>
                    <th>Nom et Prénom</th>
                    <th>E-mail</th>
                    <th>Tel et Whatsapp</th>
                    <th colspan="3">Action</th>
                </tr>


            <?php 

                    include_once "../connexion.php";
                    
                     $req1 = "SELECT * FROM enseignant  ORDER BY nom ASC ;";
                     
                    $req = mysqli_query($conn , $req1);
                    if(mysqli_num_rows($req) == 0){
                        echo "Il n'y a pas encore des enseignant ajouter !" ;
                    }else {
                        while($row=mysqli_fetch_assoc($req)){
                            ?>
                           <tr>
                                <td><?=$row['nom']?>
                                <?=$row['prenom']?></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['num_tel']?>
                                <?=$row['num_whatsapp']?></td>
                                <td><a href="detail_enseignant.php?id_ens=<?=$row['id_ens']?>">Détails</a></td>
                                <td><a href="modifier_enseignant.php?id_ens=<?=$row['id_ens']?>">Modifier</a></td>
                                <td><a href="supprimer_enseignant.php?id_ens=<?=$row['id_ens']?>" id="supprimer">Supprimer</a></td>
                            </tr>
                                                       
                            <?php
                        }
                    }
                    
                        ?>



        </table>
    </div>
    <div class="pager">
            </div>


<?php
//if (isset($_GET['succes']) && $_GET['succes'] == 1) {

if (isset($_SESSION['ajout_reussi']) && $_SESSION['ajout_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Ajout réussi !',
        text: 'L\'enseignant a été ajouté avec succès.',
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
        text: 'L\'enseignant a été supprimer avec succès.',
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
        text: 'L\'enseignant a été modifier avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['modifier_reussi']);
}

?>

</div>
</body>

</html>




<script>
var liensArchiver = document.querySelectorAll("#supprimer");

// Parcourir chaque lien d'archivage et ajouter un écouteur d'événements
liensArchiver.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "voulez-vous vraiment supprimé ce enseignant ?",
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