
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

    <!-- sweetalert2 links -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">


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




<div style="overflow-x:auto;">
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
              $req_sous =  "SELECT * FROM soumission inner join matiere using(id_matiere)  WHERE  date_debut <= NOW() AND date_fin >= NOW() AND archive != 1  ";
              $req = mysqli_query($conn , $req_sous);
              if(mysqli_num_rows($req) == 0){
                  echo "Il n'y a pas encore des soumission en ligne !" ;
                  
              }else {
                  while($row=mysqli_fetch_assoc($req)){
                    ?>
                      <tr>
                          <td><?=$row['code']?></td>
                          <td><?=$row['titre_sous']?></td>
                          <td><?=$row['date_debut']?></td>
                          <td><?=$row['date_fin']?></td>
                          <td><a href="cloturer.php?id_sous=<?=$row['id_sous']?>" id="cloturer">Clôturer</a></td>
                          <td><a href="archiver.php?id_sous=<?=$row['id_sous']?>" id="archiver" >Archiver</a></td>
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



<!-- Script sweetalert2 -->


<script>


document.getElementById('archiver').addEventListener('click', function(event) {
    event.preventDefault(); // Empêche le lien de se comporter normalement

    Swal.fire({
        title: 'Voulez-vous vraiment archiver cette soumission ?',
        text: "Cette action sera irréversible.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3099d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Archiver'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Confirmation ',
                text: 'Êtes-vous sûr(e) de vouloir archiver cette soumission ?',
                icon: 'info',
                //showCancelButton: true,
                confirmButtonColor: '#3099d6',
                //cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmer'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    window.location.href = event.target.href;
                }
            });
        }
    });
});

   
</script>