<?php
session_start();
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}
include_once "../connexion.php";
include "../nav_bar.php";
?>


<!-- sweetalert2 links -->

<script src="../JS/sweetalert2.js"></script>

</br></br></br>


    <?php
    $searched = false;

    if(isset($_POST['search'])) {
        $search = $_POST['search'];
        $req = mysqli_query($conn, "SELECT * FROM etudiant INNER JOIN semestre USING(id_semestre) WHERE nom LIKE '%{$search}%' OR prenom LIKE '%{$search}%' OR matricule LIKE '%{$search}%' ORDER by matricule asc;");
        if( $search!=""){
        $searched = true;
        }
       
    } else {
        $req = mysqli_query($conn, "SELECT * FROM etudiant INNER JOIN semestre USING(id_semestre) ORDER by matricule asc;");
    }
    ?>

    <?php if (!$searched) { ?>
        <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a></li>
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
        <a href="ajouter_etudiant.php" class="btn btn-primary mr-25">Nouveau</a>
        <a href="change_semestre.php" class="btn btn-primary mr-25">Changement de semestre</a>
        <a href="importer_etudiant.php" class="btn btn-primary ml-25">importer</a>
    </div>
    <br>
    <?php } ?>

 

    <div style="overflow-x:auto;">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Matricule</th>
                <th>Nom et Prénom</th>
                <th>Semestre</th>
                <th>email</th>
                <th colspan="3">Action</th>
            </tr>

            <?php
            while($row = mysqli_fetch_array($req)) {
                ?>
                <tr>
                    <td><?=$row['matricule']?></td>
                    <td><?=$row['nom']?>
                        <?=$row['prenom']?></td>
                    <td><?=$row['nom_semestre']?></td>
                    <td><?=$row['email']?></td>
                    <td><a href="detail_etudiant.php?id_etud=<?=$row['id_etud']?>">Détails</a></td>
                    <td class="kh"><a href="modifier_etudiant.php?id_etud=<?=$row['id_etud']?>"><img src="kh.png" alt=""></a></td>
                    <td class="kh"><a href="supprimer_etudiant.php?id_etud=<?=$row['id_etud']?>" id="supprimer"><img src="im.png" alt=""></a></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>

<?php
//if (isset($_GET['succes']) && $_GET['succes'] == 1) {

if (isset($_SESSION['ajout_reussi']) && $_SESSION['ajout_reussi'] === true) {
    echo "<script>
    Swal.fire({
        title: 'Ajout réussi !',
        text: 'L\'étidiant a été ajouté avec succès.',
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
        text: 'L\'étidiant a été supprimer avec succès.',
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
        text: 'L\'étidiant a été modifier avec succès.',
        icon: 'success',
        confirmButtonColor: '#3099d6',
        confirmButtonText: 'OK'
    });
    </script>";

    // Supprimer l'indicateur de succès de la session
    unset($_SESSION['modifier_reussi']);
}

?>
<script>

const lienssuprumer = document.querySelectorAll("#supprimer");

lienssuprumer.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "Voulez-vous vraiment supprimé ce étudiant ?",
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
                url:'etudiant.php',
                method:'POST',
                data:{search:search},
                success:function(response){
                    $('tbody').html(response);
                }
            });
        } else {
            $.ajax({
                url:'etudiant.php',
                method:'POST',
                success:function(response){
                    $('tbody').html(response);
                }
            });
        }
    });
});
</script>
</body>
</html>
<style>
    .kh{
        width: 2px;
        height: 2px;
        padding: 100px;
        margin: 300px;
    }
    img{
        height: 25px;
    }
</style>