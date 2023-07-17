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
    $req = mysqli_query($conn, "SELECT * FROM utilisateur inner join role using(id_role) WHERE login LIKE '%{$search}%' or profile LIKE '%{$search}%'  ORDER by login asc;");
    if( $search!=""){
    $searched = true;
    }
   
} else {
$req = mysqli_query($conn , "SELECT * FROM utilisateur inner join role using(id_role)");
}
?>


    <!-- sweetalert2 links -->

    <script src="../JS/sweetalert2.js"></script>



</br></br></br>
<?php if (!$searched) { ?>
        <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a></li>
                <li>Gestion des utilisataires</li>
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
        <a href="ajouter_utilisateur.php" class = "btn btn-primary" >Nouveau</a>
    </div>
    <br>
    <?php } ?>
    <div style="overflow-x:auto;">

        <table class="table table-striped table-bordered">
            <tr>
                    <th>E-mail</th>
                    <th>Rôle</th>
                    <th colspan="3">Actions</th>
               
            </tr>


            <?php 
                    
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
                                    <?php
                                    
                                        if($row['active'] == 1){
                                            ?>
                                                <td><a href="activer_ou_desactiver.php?id_user=<?=$row['id_user']?>" id="desactive"> Désactiver</a></td>
                                        <?php
                                        }else{
                                            ?>
                                            <td><a href="activer_ou_desactiver.php?id_user=<?=$row['id_user']?>" id="active"> Activer</a></td>
                                       
                                        <?php
                                        }
                                        ?>
                                   
                               
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

// var_dump($_SESSION['desactive_reussi']);

if (isset($_SESSION['desactive_reussi']) && $_SESSION['desactive_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Désactivation réussie !',
        text: 'L'utilisateur a été désactive avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['desactive_reussi']);
}


if (isset($_SESSION['active_reussi']) && $_SESSION['active_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Activation réussie !',
        text: 'L\'utilisateur a été activer avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['active_reussi']);
}
if (isset($_SESSION['desactive_non_autorise']) && $_SESSION['desactive_non_autorise'] === true) {
    echo '<script>
    Swal.fire({
        title: "Désactivation non autorisée !",
        text: "Vous ne pouvez pas désactiver le compte de l\'administrateur.",
        icon: "error",
        confirmButtonColor: "#3099d6",
        confirmButtonText: "OK"
    });
    </script>';

    // Supprimer la variable de session pour éviter qu'elle ne s'affiche à nouveau lors du rechargement de la page
    unset($_SESSION['desactive_non_autorise']);
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


var liensArchivers = document.querySelectorAll("#active");

// Parcourir chaque lien d'archivage et ajouter un écouteur d'événements
liensArchivers.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "Voulez-vous vraiment activer ce utilisateur ?",
      text: "",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Active"
    }).then((result) => {

          // Redirection après le délai
          window.location.href = this.href;
        });
      })
    });



var liensArchivers = document.querySelectorAll("#desactive");

// Parcourir chaque lien d'archivage et ajouter un écouteur d'événements
liensArchivers.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "Voulez-vous vraiment désactive ce utilisateur ?",
      text: "",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Désactive"
    }).then((result) => {
    
        }).then(() => {
          // Redirection après le délai
          window.location.href = this.href;
        });
      })
    });


$(document).ready(function(){
    $('.search-text').on('input', function(){
        var search = $(this).val();
        if(search != '') {
            $.ajax({
                url:'utilisateurs.php',
                method:'POST',
                data:{search:search},
                success:function(response){
                    $('tbody').html(response);
                }
            });
        } else {
            $.ajax({
                url:'utilisateurs.php',
                method:'POST',
                success:function(response){
                    $('tbody').html(response);
                }
            });
        }
    });
});


</script>

