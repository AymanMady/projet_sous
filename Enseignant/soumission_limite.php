
<br><br><br>
<?php
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
</head>
<body>
 
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
                <li>Les soumissions limiter</li>
                   
            </ol>
        </div>
    </div>
    <?php 
            $ens = "SELECT * FROM matiere ";
            $ens_qry = mysqli_query($conn, $ens);
            ?>
    <div class="form-group">
    <div style="overflow-x:auto;">
    <form action="" method="post">
    
                    <label class="col-md-3"> . </label>
                    <div class="col-md-3">
                    <select  name="code" id="modi" class = "form-control">
                        <option selected disabled> Filtre par code </option>
                                <?php  while ($row_ens = mysqli_fetch_assoc($ens_qry)) :?>
                                <option value="<?= $row_ens['code']; ?>"> <?= $row_ens['code'] ?> </option>  
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                    <select  name="soul" id="modi1" class = "form-control">
                        <option selected disabled> Filtre par type de matière</option>
                                <option value="examen">examen</option>
                                <option value="devoir">devoir</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="filtre" name="toutouu">
                        </div>
    </div>





<div style="overflow-x:auto;">
  <table class="table table-striped table-bordered">
          <tr>
              <th>Code</th>
              <th>Titre de soumission</th>
              <th>Date debut </th>
              <th>Date fin </th>
              <th>Actions</th>
          </tr>
          <?php 
              include_once "../connexion.php";
            //   $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE status = 1 or date_fin <= NOW() ";
            if(isset($_POST['toutouu'])){
                if(!empty($_POST['code']) && empty($_POST['soul'])){
                $code=$_POST['code'];
                $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE   date_fin <= NOW() OR status = 1 AND code='$code'  ORDER BY date_fin DESC  ";
                $req = mysqli_query($conn , $req_sous);
                }
                elseif(empty($code) && !empty($_POST['soul'])){
                    $type=$_POST['soul'];
                    
                    $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_fin <= NOW() OR status = 1 AND id_sous in (SELECT id_sous FROM $type ) ORDER BY date_fin DESC ";
                    $req = mysqli_query($conn , $req_sous);
               
               
            }
                elseif(!empty($_POST['code']) && !empty($_POST['soul'])){
                    $code=$_POST['code'];
                    $type=$_POST['soul'];
                 
                        $type=$_POST['soul'];
                            $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE   date_fin <= NOW() OR status = 1  AND code='$code' AND id_sous in (SELECT id_sous FROM $type ) ORDER BY date_fin DESC ";
                            $req = mysqli_query($conn , $req_sous);
                 
                }
              }
              else{ 
                
                  $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_fin <= NOW() OR status = 1 ORDER BY date_fin DESC ";
                  $req = mysqli_query($conn , $req_sous);
                                    }
            $req = mysqli_query($conn , $req_sous);
              if(mysqli_num_rows($req) == 0){
                  echo "Il n'y a pas encore des soumission ajouter !" ;
              }else {
                  while($row=mysqli_fetch_assoc($req)){
                    ?>

                      <tr>
                          <td><?=$row['code']?></td>
                          <td><?=$row['titre_sous']?></td>
                          <td><?=$row['date_debut']?></td>
                          <td <?php if (strtotime($row['date_fin']) - time() <= 600) echo 'style="color: red;"'; ?>>
                            <input type="datetime-local" id="date-fin-<?=$row['id_sous']?>" value="<?=$row['date_fin']?>" onchange="modifierDateFin(<?=$row['id_sous']?>, this.value)" style="border: none;" >
                        </td>                          
                        <td><a href="detail_soumission.php?id_sous=<?=$row['id_sous']?>">Detaille</a></td>
                          <td><a href="archiver.php?id_sous=<?=$row['id_sous']?>" id="archiver" >Archiver</a></td>
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