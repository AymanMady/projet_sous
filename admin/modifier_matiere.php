<?php
session_start() ;
 if($_SESSION["role"]!="admin"){
     header("location:authentification.php");
} 
include_once "../connexion.php";


$id_matiere=$_GET['id_matiere'];

//$id_matiere = $_SESSION['id_matiere'];


$semestre = "SELECT * FROM semestre ";
$semestre_qry = mysqli_query($conn, $semestre);
$module = "SELECT * FROM module";
$module_qry = mysqli_query($conn,$module);


$query = "SELECT * FROM `matiere` WHERE id_matiere = $id_matiere  ";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);
?>
<body>


<?php
if(isset($_POST['submit'])){
      if(count($_POST)>0){
         session_start();
         include_once "../connexion.php";
      $departement= $_POST['departement'];
      $id_sem=$_POST['semester'];
      $query= "UPDATE `matiere` set code='". $_POST['codematieres'] ."',id_module='" . $_POST['module'] . "', libelle='" . $_POST['nommatieres'] ."' ,`specialite`='$departement',`id_semestre`=$id_sem WHERE id_matiere=$id_matiere"; 
      // update form data from the database
      if (mysqli_query($conn, $query)) {
         $msg = 2;
         $_SESSION['alert1']=$msg;
      } else {
         $msg = 4;
      }
      }
      header ("Location : matiere.php");
      }

 include "../nav_bar.php";

?>

 

</br>
</br></br></br>
<div class="container-buld">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
                    </li>
                    <li>Gestion des matiere</li>
                    
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="well">
            <?php
                $id_matiere = $_GET['id_matiere'];
                $matiere = "SELECT * FROM matiere WHERE id_matiere = $id_matiere";
                $matiere_qry = mysqli_query($conn,$matiere);
                while ($row_matiere = mysqli_fetch_assoc($matiere_qry)) :
                ?>
                   
                   <fieldset class="fsStyle">
                        <legend class="legendStyle">
                            <a data-toggle="collapse" data-target="#demo" href="#">Modifier la matière <?= $row_matiere['libelle'] ?></a>
                        </legend>
                    </fieldset>
                
                    <?php endwhile;?>
                
            </div>
        </div>
    </div>  
<div class="form-horizontal">
    <br /><br />

    <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
        <div class="row">
        <div class="col-lg-12">
        <form action="" method="POST">

        <div class="form-group">
            <label class="col-md-1">Code de Matière</label>
            <div class="col-md-3">
                <input type="text" name="codematieres" class = "form-control" value="<?= $student["code"]; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-1" >libellé</label>
            <div class="col-md-3">
            <input type="text" name="nommatieres" class = "form-control" value="<?php echo $student['libelle']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Semesters</label>
            <div class="col-md-3" >
            <select class = "form-control" id="academic" name="semester">
                  <option selected disabled> Semester</option>
                  <?php while ($row = mysqli_fetch_assoc($semestre_qry)) :                     
                     ?>
                     <option value="<?php echo $row['id_semestre']; ?>"> <?php echo $row['nom_semestre']; ?> </option>
                  <?php 
                     endwhile; 
                  ?>
               </select>           
               </div>
        </div>
        <div class="container-buld">
        <div class="form-group">
            <label class="col-md-1" >Module</label>
            <div class="col-md-3" >
            <select  name="module" id="mod" class = "form-control">
            <option selected disabled>Modules</option>
         
               <?php
               while ($row = mysqli_fetch_assoc($module_qry)) :?>
                  <option value="<?php echo $row['id_module']; ?>"> <?php echo $row['nom_module']; ?> </option>  
               <?php endwhile;?>
               </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Deppartement</label>
            <div class="col-md-3" >
            <select  id="deppartement" name="departement" class = "form-control">
                    <option selected disabled>Deppartements</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
        <div class="col-md-offset-1 col-md-12">
                    <div class="col-md-3">   
                    <!-- <div class="alert alert-info">  -->
                    <strong style="letter-spacing: 0.5px; font-size:15px;">Les enseignants affectés à cette matière </strong><br><br>
                        <h4>
                    <?php 

                            $req1 = "SELECT * FROM enseigner inner join enseignant using(id_ens) inner join matiere using(id_matiere) where id_matiere = '$id_matiere' ";

                            $req = mysqli_query($conn , $req1);
                            if(mysqli_num_rows($req) == 0){
                                echo "Il n'y a pas encore des enseignant affecter !" ;
                            }else {
                                while($row=mysqli_fetch_assoc($req)){
                                    ?>
                                    <?php
                                        $id_matiere = $_GET['id_matiere'];
                                        $matiere = "SELECT * FROM matiere WHERE id_matiere = $id_matiere";
                                        $matiere_qry = mysqli_query($conn,$matiere);
                                        while ($row_matiere = mysqli_fetch_assoc($matiere_qry)) :
                                    ?>
                                    <div>
                                        <?=$row['nom']." ".$row['prenom']?>

                                        <a href="supprimer_affectation.php?id_ens=<?=$row['id_ens']?>&id_matiere=<?=$row['id_matiere']?>"onclick="return confirm(`voulez-vous vraiment supprimé cet enseignant ?`)" ><img style="width: 18px; margin-left:110px;" title="Supprimer" src="images/close.png" alt=""></a><br><br>

                                    </div>
                                <?php endwhile;?>
                                <?php
                                }
                            }
                            ?>
                        </h4>
                    <!-- </div> -->
                    </div>

                    </div>
            </div>
 
                    <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" name="submit" value=Enregistrer class="btn-primary"  />
                    </div>
            </div>
    </div>
    </div>
 </from> 
 </div>   
 </div>   

<script>
    function myf(){
        document.getElementById("mod").style.display = "none";
        document.getElementById("back").style.display = "inline";
        document.getElementById("add").style.display = "block";
        document.getElementById("addn").style.display = "none";
    }
    function myf1(){
        document.getElementById("mod").style.display = "block";
        document.getElementById("back").style.display = "none";
        document.getElementById("add").style.display = "none";
        document.getElementById("addn").style.display = "inline";
    }
    document.getElementById("mod").value ="<?php echo $student['module']; ?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // County State  
    $('#academic').on('change',function() {
        var academic_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'departement.php',
            type: "POST",
            data: {
                academic_data: academic_id
            },
            success: function(result) {
                $('#deppartement').html(result);
                // console.log(result);
                // alert(result);
            }
        })
    });

</script>
