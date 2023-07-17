
<?php
    session_start() ;
    
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}
include_once "../connexion.php";
include "../nav_bar.php";
$searched = false;

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $req1 =  "SELECT * FROM enseignant  WHERE nom LIKE '%{$search}%' OR prenom LIKE '%{$search}%' OR num_tel LIKE '%{$search}%' OR email LIKE '%{$search}%' ORDER by nom asc;";
    if( $search!=""){
    $searched = true;
    }
    else{
        $searched = false;
    }
   
} else {
$req1 = "SELECT * FROM enseignant  ORDER BY nom ASC ;";
}
$req = mysqli_query($conn , $req1);
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
                <li>Gestion des enseignant</li>
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
        <a href="ajouter_enseignant.php" class = "btn btn-primary" >Nouveau</a>
        <a href="import_enseignant.php"  class="btn btn-primary ml-25">importer</a>
    </div>
    <br>
    <?php } ?>

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
const lienssuprumer = document.querySelectorAll("#supprimer");

lienssuprumer.forEach(function(lien) {
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
          window.location.href = this.href;
            }
        });
      });
    });

   
</script>
<script>
$(document).ready(function(){
    $('.search-text').on('input', function(){
        var search = $(this).val();
        if(search != '') {
            $.ajax({
                url:'enseignant.php',
                method:'POST',
                data:{search:search},
                success:function(response){
                    $('tbody').html(response);
                }
            });
        } else {
            $.ajax({
                url:'enseignant.php',
                method:'POST',
                success:function(response){
                    $('tbody').html(response);
                }
            });
        }
    });
});
</script>