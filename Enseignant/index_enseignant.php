
<br>
<?php
 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="ens"){
     header("location:../authentification.php");
 }
 include "../nav_bar.php";
?>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12"> 
            <ol class="breadcrumb">
                <li><a href="acceuil.php">Acceuil</a>       
                </li>
                <li>Les matières enseignées par l'enseignant <?php //echo $nom_ens ?> </li>     
            </ol>
        </div>
    </div>
<div style="overflow-x:auto;"  >
  <table class="table table-striped table-bordered">
          <tr>
              <th>Code</th>
              <th>Libelle</th>
              <th>Specialite</th>
              <th>Action</th>
          </tr>
          <?php 
              include_once "../connexion.php";
              $req_ens_mail =  "SELECT * FROM matiere,enseigner,enseignant WHERE enseignant.id_ens=enseigner.id_ens and matiere.id_matiere=enseigner.id_matiere and enseignant.email ='$email'";

              $req = mysqli_query($conn , $req_ens_mail);
              if(mysqli_num_rows($req) == 0){
                  echo "Il n'y a pas encore des matiere ajouter !" ;
                  
              }else {
                  while($row=mysqli_fetch_assoc($req)){
                    ?>
                      <tr>
                          <td><?=$row['code']?></td>
                          <td><?=$row['libelle']?></td>
                          <td><?=$row['specialite']?></td>
                          <td><a href="detail_enseignant_matiere.php?id_matiere=<?=$row['id_matiere']?>">Details</a></td>
                          
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
