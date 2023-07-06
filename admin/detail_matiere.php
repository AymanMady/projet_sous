
<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailler matiere</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a>
                          
                </li>
                <li>Gestion des matiéres</li>

            </ol>
        </div>
    </div>
<?php

include_once "../connexion.php";
$id_matiere = $_GET['id_matiere'];


$req_detail = "SELECT DISTINCT id_matiere, code, matiere.libelle,
specialite, charge, nom_semestre,
nom_module FROM matiere INNER JOIN 
semestre USING(id_semestre) INNER JOIN
module USING(id_module) WHERE id_matiere = $id_matiere";
$req = mysqli_query($conn , $req_detail);
while($row=mysqli_fetch_assoc($req)){
?>
 <div class="container">
    <div class="row">
      <div class="col-md-6">
        <fieldset>
          <legend class="legendStyle">
              <a data-toggle="collapse" data-target="#demo" href="#">Détails sur la matière <?=$row['libelle']?></a>
          </legend>
            <br><br>
            <div class="collapse in" id="demo">
                <div class="search-box">

                  <div class="form-group">
                      <div class="col-md-8 col-sm-2">
                        <h4 >
                        <?php echo "<strong class='font-weight-bold'>Code de la matiere : </strong>". $row['code']; ?><br><br>
                        <?php echo "<strong class='font-weight-bold'>Libellè : </strong>". $row['libelle']; ?><br><br>
                        <?php echo "<strong class='font-weight-bold'> Specialite : </strong>" . $row['specialite']; ?><br><br>
                        <?php echo "<strong class='font-weight-bold'> Charge de la matière : </strong>" . $row['charge']; ?><br><br>
                        <?php echo "<strong class='font-weight-bold'> Module : </strong>" . $row['nom_module']; ?><br><br>
                        <?php echo "<strong class='font-weight-bold'> Semestre : </strong>" . $row['nom_semestre']; ?><br><br>
                        
                        <?php
                        $req_detail = "SELECT DISTINCT id_matiere, groupe.libelle FROM matiere INNER JOIN groupe WHERE id_matiere = $id_matiere";
                        $req = mysqli_query($conn , $req_detail);

                        $i = 0;
                        while($row=mysqli_fetch_assoc($req)){
                          $i++;
                          if ($i === 1) {
                            echo "<strong class='font-weight-bold'> Les groupes : </strong>";
                              }
                                echo  $row['libelle'] . " ";
                        }
                            ?>
                         </h4>
                      </div>
                    </div>
                    <!-- alert alert-info  te text-info-->
                  
                        <div class="alert alert-info" style="margin-left: 600px; width:400px; height:300px;" > 
                        <strong style="letter-spacing: 0.5px; font-size: 15px;  margin: auto;" type="submit" class="btn btn-light" style="border:none;"><strong class='font-weight-bold'>Le(s) enseignant(s) affecter(és) à cette matière</strong></strong><br><br>
                        <h4>
                        <?php
                        $req_ens_info = "SELECT *
                        FROM groupe
                        NATURAL JOIN enseigner
                        NATURAL JOIN enseignant
                        NATURAL JOIN type_matiere
                        WHERE id_matiere = $id_matiere ORDER BY nom, prenom ASC";
                        $req = mysqli_query($conn , $req_ens_info);
                        if(mysqli_num_rows($req) == 0){
                          echo "Il n'y a pas encore des enseignant affecter !" ;
                        }else{
                          $i = 0;
                          while($row=mysqli_fetch_assoc($req)){
                            $i++;
                            if ($i === 1) {
                              echo "<strong class='font-weight-bold'>  </strong>";
                                }
                                  echo  $row['nom'] ." ". $row['prenom']." ".$row['libelle']." ".$row['libelle_type']. "<br><br> ";
                          }
                            

                        }
                        ?>
                            </h4>
                    </div>
                </div>
            </div>
          
          </fieldset>
          <?php
          $req_detail = "SELECT DISTINCT id_matiere, code, matiere.libelle,
          specialite, charge, nom_semestre,
          nom_module FROM matiere INNER JOIN 
          semestre USING(id_semestre) INNER JOIN
          module USING(id_module) WHERE id_matiere = $id_matiere";
          $req = mysqli_query($conn , $req_detail);
          while($row=mysqli_fetch_assoc($req)){
          ?>
            <br>
            <p>
            <a href="modifier_matiere.php?id_matiere=<?= $row['id_matiere'] ?>" style="margin-left: 100px; " type="submit" class="btn btn-primary">Modifier</a>
            </p>
                          
      </div>
    </div>
  </div>
</div>
<?php
    
}
}
include "../nav_bar.php";
?>

</body>
</html>