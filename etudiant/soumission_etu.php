<?
session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="etudiant"){
     header("location:../authentification.php");
 }
 include "../nav_bar.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
</form>
  <table class="table table-striped table-bordered">
          <tr>
              <th>Code</th>
              <th>Titre de soumission</th>
              <th>Date debut </th>
              <th>Date fin </th>
              <th colspan="3">Actions</th>
          </tr>
          </body>
</html>
          <?php
            include_once "../connexion.php";
            $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND archive != 1 and id_matiere in (SELECT id_matieres FROM inscripsion WHERE id_etudi in (SELECT etudiant.id_etud FROM etudiant WHERE etudiant.email='$email'))  ORDER BY date_fin DESC  ";
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
                        <td><?=$row['date_fin']?></td>
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
