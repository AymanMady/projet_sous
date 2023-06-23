
<br><br><br>
<style>
    .date-fin-rouge {
        color: red;
    }
</style>

<?php

use function PHPSTORM_META\type;

 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="ens"){
     header("location:authentification.php");
 }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- sweetalert2 links -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">


</head>
<body>
    <style>
        /* Ajoutez ce style pour changer le curseur en pointeur lorsqu'on survole une ligne */
        .click:hover {
            cursor: pointer;
            background-color: aliceblue;
        }
    </style>
<?php 
include "../nav_bar.php";
?>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="#">Acceuil</a>
                    
                </li>
                <li>Les soumissions en ligne</li>
                   
            </ol>
        </div>
    </div>


    <?php 
            $ens = "SELECT * FROM matiere ";
            $matiere_filtre_qry = mysqli_query($conn, $ens);
            ?>

<div style="overflow-x:auto;">
<form action="" method="post">
<div class="form-group">
                    <label class="col-md-3">. </label>
                    <div class="col-md-3">
                    <select  name="code" id="modi" class = "form-control">
                        <option selected disabled> Filtre par code de matière </option>
                                <?php  while ($row_ens = mysqli_fetch_assoc($matiere_filtre_qry)) :?>
                                <option value="<?= $row_ens['code']; ?>"> <?= $row_ens['code'] ?> </option>  
                            <?php endwhile;?>
                           </select>

                    </div>
                    <div class="col-md-3">
                    <select  name="soul" id="modi1" class = "form-control">
                        <option selected disabled> Filtre par type de matière </option>
                                <option value="examen">Examen</option>
                                <option value="devoir">Devoir</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="filtre" name="filtrer" class="btn-primary">
                        </div>
</div>

</form>
  <table class="table table-striped table-bordered">
          <tr>
              <th>Code</th>
              <th>Titre de soumission</th>
              <th>Date debut </th>
              <th>Date fin </th>
              <th colspan="3">Actions</th>
          </tr>
          <?php 
              include_once "../connexion.php";
              // $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE date_debut <= NOW() AND date_fin >= NOW() AND status = 0  ";
            //   $update = "UPDATE soumission SET status = 1 where date_fin <= NOW()";
            //   $req_update = mysqli_query($conn , $update);
    

        if(isset($_POST['filtrer'])){
            
            if(!empty($_POST['code']) && empty($_POST['soul'])){
                $code=$_POST['code'];


                $req_sous1 =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND status = 0 AND code='$code' AND id_ens = (select id_ens from enseignant where email = '$email')  ORDER BY date_fin DESC  ";
                $req1 = mysqli_query($conn , $req_sous1);
                $req_sous2 =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND status = 0 AND code='$code' AND id_ens != (select id_ens from enseignant where email = '$email')  ORDER BY date_fin DESC  ";
                $req2 = mysqli_query($conn , $req_sous2);
            }
            elseif(empty($code) && !empty($_POST['soul'])){
                $type=$_POST['soul'];
                
                $req_sous1 =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND status = 0 AND id_sous in (SELECT id_sous FROM $type )  AND id_ens = (select id_ens from enseignant where email = '$email')   ORDER BY date_fin DESC ";
                $req1 = mysqli_query($conn , $req_sous1);
                $req_sous2 =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND status = 0 AND id_sous in (SELECT id_sous FROM $type )AND id_ens != (select id_ens from enseignant where email = '$email') ORDER BY date_fin DESC ";
                $req2 = mysqli_query($conn , $req_sous2);
            }
            elseif(!empty($_POST['code']) && !empty($_POST['soul'])){
                $code=$_POST['code'];
                $type=$_POST['soul'];
             
                $req_sous1 =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND status = 0  AND code='$code' AND id_sous in (SELECT id_sous FROM $type )  AND id_ens = (select id_ens from enseignant where email = '$email')  ORDER BY date_fin DESC ";
                $req1 = mysqli_query($conn , $req_sous1);
                $req_sous2 =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND status = 0  AND code='$code' AND id_sous in (SELECT id_sous FROM $type ) AND id_ens != (select id_ens from enseignant where email = '$email')  ORDER BY date_fin DESC ";
                $req2 = mysqli_query($conn , $req_sous2);
            }
        }else{ 
            
              $req_sous1 =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_fin >= NOW() AND status = 0 AND id_ens = (select id_ens from enseignant where email = '$email') ORDER BY date_fin DESC ";
              $req1 = mysqli_query($conn , $req_sous1);
              $req_sous2 =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_fin >= NOW() AND status = 0 AND id_ens != (select id_ens from enseignant where email = '$email') ORDER BY date_fin DESC ";
              $req2 = mysqli_query($conn , $req_sous2);
        }


              if(mysqli_num_rows($req1) == 0 and mysqli_num_rows($req2) == 0){
                  echo "Il n'y a pas encore des soumission en ligne !" ;
                  
              }else if(mysqli_num_rows($req1)>0) {
                  while($row=mysqli_fetch_assoc($req1)){
                    ?>
                    
                 
                    <tr >
                          <td class="click" onclick="redirectToDetails(<?php echo $row['id_sous']; ?>)"><?=$row['code']?></td>
                          <td class="click" onclick="redirectToDetails(<?php echo $row['id_sous']; ?>)"><?=$row['titre_sous']?></td>
                          <td class="click" onclick="redirectToDetails(<?php echo $row['id_sous']; ?>)"><?=$row['date_debut']?></td>
                        <td <?php if (strtotime($row['date_fin']) - time() <= 600) echo 'style="color: red;"'; ?>>
                            <input type="datetime-local" id="date-fin-<?=$row['id_sous']?>" value="<?=$row['date_fin']?>" onchange="modifierDateFin(<?=$row['id_sous']?>, this.value)" style="border: none;" >
                        </td>
                          <td><a href="detail_soumission.php?id_sous=<?=$row['id_sous']?>">Detaille</a></td>
                          <td><a href="cloturer.php?id_sous=<?=$row['id_sous']?>" id="cloturer">Clôturer</a></td>
                          <td><a href="archiver.php?id_sous=<?=$row['id_sous']?>" id="archiver" >Archiver</a></td>
                      
                        </tr>
                    </a>
                    <?php
                  }
                while($row=mysqli_fetch_assoc($req2)){
                  ?>
                  
                 
                   <tr>
                   
                        <td><?=$row['code']?></td>
                        <td><?=$row['titre_sous']?></td>
                        <td><?=$row['date_debut']?></td>
                        <td><?=$row['date_fin']?></td>
                        <td><a href="detail_soumission.php?id_sous=<?=$row['id_sous']?>">Detaille</a></td>
                   
                      </tr>
                 
                  <?php
                }
            }
          ?>
        </table>
    </div>
</div>
</body>
</html>

<script>
        function redirectToDetails(id_matiere) {
            window.location.href = "reponses_etud.php?id_sous=" + id_matiere;
        }
    </script>

<!-- Script sweetalert2 -->

<script>

    



var liensArchiver = document.querySelectorAll("#archiver");

// Parcourir chaque lien d'archivage et ajouter un écouteur d'événements
liensArchiver.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "Voulez-vous vraiment archiver cette soumission ?",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Archiver"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Confirmation",
          text: "Êtes-vous sûr(e) de vouloir archiver cette soumission ?",
          icon: "info",
          confirmButtonColor: "#3099d6",
          cancelButtonText: "Annuler",
          cancelButtonColor: "#d33",
          confirmButtonText: "Archiver"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = this.href; 
          }
        });
      }
    });
  });
});

// Sélectionner tous les éléments avec l'ID "cloturer"
var liensCloturer = document.querySelectorAll("#cloturer");

// Parcourir chaque lien de clôture et ajouter un écouteur d'événements
liensCloturer.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "Voulez-vous vraiment clôturer cette soumission ?",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Clôturer"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Confirmation",
          text: "Êtes-vous sûr(e) de vouloir clôturer cette soumission ?",
          icon: "info",
          confirmButtonColor: "#3099d6",
          confirmButtonText: "Clôturer"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = this.href; 
          }
        });
      }
    });
  });
});



// Fonction pour modifier la date de fin
function modifierDateFin(id_sous, nouvelle_date_fin) {
  // Créer un objet FormData pour envoyer les données via AJAX
  var formData = new FormData();
  formData.append('id_sous', id_sous);
  formData.append('nouvelle_date_fin', nouvelle_date_fin);

  // Envoyer la requête AJAX
  fetch('modifier_date_fin.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    // Vérifier le statut de la réponse JSON
    if (data.status === 'success') {
      // Afficher une boîte de dialogue de succès
      Swal.fire({
        title: 'Succès',
        text: data.message,
        icon: 'success',
        confirmButtonColor: '#3099d6'
      });
    } else {
      // Afficher une boîte de dialogue d'erreur
      Swal.fire({
        title: 'Erreur',
        text: data.message,
        icon: 'error',
        confirmButtonColor: '#3099d6'
      });
    }
  })
  .catch(error => {
    console.error('Une erreur s\'est produite lors de la requête AJAX :', error);
  });
}



</script>