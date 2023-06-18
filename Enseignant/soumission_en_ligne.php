
<br><br><br>
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
                <li>Les soumissions en ligne</li>
                   
            </ol>
        </div>
    </div>


    <?php 
    $ens = "SELECT * FROM matiere ";
    $ens_qry = mysqli_query($conn, $ens);
    ?>

<div style="overflow-x:auto;">
<form action="" method="post">
<div class="form-group">
    <label class="col-md-3">Enseignant 1 </label>
    <div class="col-md-3">
    <select  name="code" id="modi" class = "form-control">
        <option selected disabled> filtre par code </option>
                <?php  while ($row_ens = mysqli_fetch_assoc($ens_qry)) :?>
                <option value="<?= $row_ens['code']; ?>"> <?= $row_ens['code'] ?> </option>  
            <?php endwhile;?>
            </select>

    </div>
    <div class="col-md-3">
    <select  name="soul" id="modi1" class = "form-control">
        <option selected disabled> filtre par type </option>
                <option value="examen">examen</option>
                <option value="devoir">devoir</option>
        </select>
    </div>
    <div class="col-md-2">
        <input type="submit" value="Filtre" name="toutouu" class = "btn btn-primary mr-25">
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

          if(isset($_POST['toutouu'])){
            
            if(!empty($_POST['code']) && empty($_POST['soul'])){
            $code=$_POST['code'];
            $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND archive != 1 AND code='$code'  ORDER BY date_fin DESC  ";
            $req = mysqli_query($conn , $req_sous);
            }
            elseif(empty($code) && !empty($_POST['soul'])){
                $type=$_POST['soul'];
                
                $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND archive != 1 AND id_sous in (SELECT id_sous FROM $type ) ORDER BY date_fin DESC ";
                $req = mysqli_query($conn , $req_sous);
           
           
        }
            elseif(!empty($_POST['code']) && !empty($_POST['soul'])){
                $code=$_POST['code'];
                $type=$_POST['soul'];
             
                    $type=$_POST['soul'];
                        $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND archive != 1  AND code='$code' AND id_sous in (SELECT id_sous FROM $type ) ORDER BY date_fin DESC ";
                        $req = mysqli_query($conn , $req_sous);
             
            }
          }
          else{ 
            
              $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_fin >= NOW() AND archive != 1 ORDER BY date_fin DESC ";
              $req = mysqli_query($conn , $req_sous);
                                }
              if(mysqli_num_rows($req) == 0){
                  echo "Il n'y a pas encore des soumission ajouter !" ;
                  
              }else {
                  while($row=mysqli_fetch_assoc($req)){
                    ?>
                      <tr>
                          <td><?=$row['code']?></td>
                          <td><?=$row['titre_sous']?></td>
                          <td><?=$row['date_debut']?></td>
                          <td><a href="cloturer.php?id_sous=<?=$row['id_sous']?>"><?=$row['date_fin']?></a></td>
                          <td>Cloturer</td>
                          <td><a href="archiver.php?id_sous=<?=$row['id_sous']?>">Archiver</a></td>
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
