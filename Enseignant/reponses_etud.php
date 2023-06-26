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
    <?php
    $req_detail = "SELECT * FROM soumission inner join matiere using(id_matiere),enseignant WHERE id_sous = $id_sous and soumission.id_ens=enseignant.id_ens ";
    $req = mysqli_query($conn , $req_detail);
    $row=mysqli_fetch_assoc($req);
    $sql1 = "select * from reponses where id_sous = $id_sous ";
    $req1 = mysqli_query($conn , $sql1);
    $nbr1 = mysqli_num_rows($req1);

    $sql2 = "select * from  inscription NATURAL JOIN matiere NATURAL JOIN soumission where id_sous = $id_sous; ";
    $req2 = mysqli_query($conn , $sql2);
    $nbr2 = mysqli_num_rows($req2);

    ?>
<style>
    .submission-div {
        display: flex;
        align-items: center;
        height: 200px;
    }

    .description { 
        flex: 1;
        padding-right: 100px;
        background-color: aliceblue;
        min-height: 100%;
    }

    .response-count {
        width: 200px;
        margin-left: 10px;
        background-color: #f1f1f1;
        padding: 10px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .nbr_etud {
        font-size: 50px;
    }
    .descri {
        text-align: center;
        font-size: 25px;
        font-weight: bold;
    }
    .descri_contenu{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-left: 15px;
    }
</style>

<div class="submission-div">
    <div class="description">
        <h3 class="descri">Description de la soumission</h3>
        <div class="descri_contenu">
            <div style="flex: 1;">
                <?php echo "<strong>Titre : </strong>". $row['titre_sous']; ?><br><br>
                <?php echo "<strong>Description : </strong>". $row['description_sous'];  ?><br><br>
                <?php echo "<strong>Code de la matiere : </strong>". $row['code']; ?><br><br>
            </div>
            <div>
                <?php echo "<strong>Date de  début : </strong>". $row['date_debut']; ?><br><br>
                <?php echo "<strong>Date de  fin : </strong>" . $row['date_fin']; ?><br><br>
                <?php echo "<strong>nom est prenom de l'enseignant  : </strong>" . $row['nom']." ".$row['prenom']; ?><br><br>
            </div>
        </div>
    </div>
    <div class="response-count">
        <h3>Nombre d'étudiants ayant répondu</h3>
        <div class="nbr_etud"><?php echo $nbr1."/".$nbr2; ?></div>
    </div>
</div>
<br>
<div style="overflow-x:auto;"  >
  <table class="table table-striped table-bordered">
          <tr>
              <th>Matricule</th>
            <th>Description de la reponse</th>
              <th>Date</th>
              <th>Details</th>
          </tr>
          <?php 
              $sql =  "SELECT * from reponses,etudiant where reponses.id_sous='$id_sous' AND reponses.id_etud=etudiant.id_etud;";

              $req = mysqli_query($conn , $sql);
              if(mysqli_num_rows($req) == 0){
                  echo "Il n'y a pas encore des reponses ajouter !" ;
                  
              }else {
                  while($row=mysqli_fetch_assoc($req)){
                    ?>
                      <tr>
                          <td><?=$row['matricule']?></td>
                          <td><?=$row['description_rep']?></td>
                          <td><?=$row['date']?></td>
                          <td><a href="consiltation_de_reponse.php?id_rep=<?=$row['id_rep']?>">Details</Details></a></td>
                          
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
