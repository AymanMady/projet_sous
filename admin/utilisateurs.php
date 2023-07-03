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
                <li>Gestion des utilisateurs</li>
                   
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
            <!-- /well -->
        </div>
    </div>
    <div class="text-center">
       
    </div>
    <br>
    <p>
        <a href="ajouter_utilisateur.php" class = "btn btn-primary" >Nouveau</a>
    </p>   
    <div style="overflow-x:auto;">

        <table class="table table-striped table-bordered">
            <tr>
                    <th>E-mail</th>
                    <th>Rôle</th>
                    <th colspan="2">Actions</th>
               
            </tr>


            <?php 
                    include_once "../connexion.php";
                    $req = mysqli_query($conn , "SELECT * FROM utilisateur inner join role using(id_role)");
                    if(mysqli_num_rows($req) == 0){
                        echo "Il n'y a pas encore des utilisateur ajouter !" ;
                    }else {
                        while($row=mysqli_fetch_assoc($req)){
                            ?>
                            <tr>
                                <td><?=$row['login']?></td>
                                <td><?=$row['profile']?></td>
                                <td><a href="modifier_utilisateur.php?id_user=<?=$row['id_user']?>">Modifier</a></td>
                                <td><a href="supprimer_utilisateur.php?id_user=<?=$row['id_user']?>" id="supprimer"> Supprimer</a></td>
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

if (isset($_SESSION['ajout_user_reussi']) && $_SESSION['ajout_user_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Ajout réussi !',
        text: 'L\'utilisateur a été ajouté avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['ajout_user_reussi']);
}


if (isset($_SESSION['mod_reussi']) && $_SESSION['mod_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Modification réussi !',
        text: 'L\'utilisateur a été modifier avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['mod_reussi']);
}

?>


<script>


var liensArchiver = document.querySelectorAll("#supprimer");

// Parcourir chaque lien d'archivage et ajouter un écouteur d'événements
liensArchiver.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "Voulez-vous vraiment supprimé ce utilisateur ?",
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
        Swal.fire({
          title: "Suppression réussie !",
          text: "L'utilisateur a été supprimée avec succès.",
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

