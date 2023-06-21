
<br>
<?php
 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="ens"){
     header("location:../authentification.php");
 }
 include_once "../connexion.php";
    $id_sous = $_GET['id_sous'];
?>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a>       
                </li>
                <li>Reponse de l'etudiant  <?php //echo $nom_ens ?> </li>     
            </ol>
        </div>
    </div>
<div style="overflow-x:auto;"  >
  <table class="table table-striped table-bordered">
          <tr>
              <th>matricule</th>
            <th>description_rep</th>
              <th>date</th>
              <th>data_reponse</th>
          </tr>
          <?php 
              $req_ens_mail =  "SELECT * from reponses,etudiant where reponses.id_sous='$id_sous' AND reponses.id_etud=etudiant.id_etud;";

              $req = mysqli_query($conn , $req_ens_mail);
              if(mysqli_num_rows($req) == 0){
                  echo "Il n'y a pas encore des matiere ajouter !" ;
                  
              }else {
                  while($row=mysqli_fetch_assoc($req)){
                    ?>
                      <tr>
                          <td><?=$row['matricule']?></td>
                          <td><?=$row['description_rep']?></td>
                          <td><?=$row['date']?></td>
                          <td><a href="consiltation_de_reponse.php?id_rep=<?=$row['id_rep']?>">data_reponse</a></td>
                          
                      </tr>
                    <?php
                  }
              }
          ?>
        </table>
    </div>
    <?php
    include "../nav_bar.php";
    ?>
</div>
</body>
</html>
