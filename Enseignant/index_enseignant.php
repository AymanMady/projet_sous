
<br>
<?php
 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="ens"){
     header("location:../authentification.php");
 }

 include_once "../connexion.php";

$sql_ens = "SELECT * FROM enseignant WHERE enseignant.email ='$email'";
$req_ens = mysqli_query($conn , $sql_ens);
$row_ens = mysqli_fetch_assoc($req_ens);


?>
<style>
    /* Ajoutez ce style pour changer le curseur en pointeur lorsqu'on survole une ligne */
    tr:hover {
        cursor: pointer;
        background-color: aliceblue;
    }
</style>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="#">Acceuil</a>       
                </li>
                <li><a>Les matières enseignées par l'enseignant <?php echo $row_ens['nom'] ." ".$row_ens['prenom'] ?> </a></li>     
            </ol>
        </div>
    </div>
<div style="overflow-x:auto;"  >
  <table class="table table-striped table-bordered">
          <tr>
              <th>Code</th>
              <th>Libellè</th>
              <th>Semestre</th>
              <th>Specialite</th>
              <th>Action</th>
          </tr>
          <?php 
          
              $req_ens_mail =  "SELECT matiere.*,semestre.* FROM matiere,enseigner,enseignant,semestre WHERE enseignant.id_ens=enseigner.id_ens and matiere.id_semestre=semestre.id_semestre and matiere.id_matiere=enseigner.id_matiere  and enseignant.email ='$email'";

              $req = mysqli_query($conn , $req_ens_mail);
              if(mysqli_num_rows($req) == 0){
                  echo "Il n'y a pas encore des matiere ajouter !" ;
                  
              }else {
                  while($row=mysqli_fetch_assoc($req)){
                    ?>
                      <tr>
                          <td onclick="redirectToDetails(<?php echo $row['id_matiere']; ?>)"><?=$row['code']?></td>
                          <td onclick="redirectToDetails(<?php echo $row['id_matiere']; ?>)"><?=$row['libelle']?></td>
                          <td onclick="redirectToDetails(<?php echo $row['id_matiere']; ?>)"><?=$row['nom_semestre']?></td>
                          <td onclick="redirectToDetails(<?php echo $row['id_matiere']; ?>)"><?=$row['specialite']?></td>
                          <td><a href="detail_enseignant_matiere.php?id_matiere=<?=$row['id_matiere']?>">Details</a></td>
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
<script>
    function redirectToDetails(id_matiere) {
        window.location.href = "soumission_par_matiere.php?id_matiere=" + id_matiere;
    }
</script>
</body>
</html>
