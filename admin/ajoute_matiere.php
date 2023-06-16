<?php 
session_start() ;
$email = $_SESSION['email'];
// if($_SESSION["role"]!="admin"){
//     header("location:authentification.php");
// }

include_once "../connexion.php";
$semestre = "SELECT * FROM semestre ";
$semestre_qry = mysqli_query($conn, $semestre);
$module = "SELECT * FROM module";
$module_qry = mysqli_query($conn,$module);

include "../nav_bar.php";
?>

<body>  
 

</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
                    </li>
                    <li>Gestion des matiere</li>
                    <li>Ajouter une matiere</li>
            </ol>
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
        <form action="insert.php" method="POST">
        <div class="form-group">
            <label class="col-md-1">Code de Matiere</label>
            <div class="col-md-6">
                <input type="text" name="codematieres" class = "form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-1" >libellé</label>
            <div class="col-md-6">
            <input type="text" name="nommatieres" class = "form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Semesters</label>
            <div class="col-md-6" >
            <select class = "form-control" id="academic" value="Semesters" name="semester">
                    <option selected disabled> Semesters </option>
                            <?php while ($row = mysqli_fetch_assoc($semestre_qry)) : ?>
                        <option value="<?= $row['id_semestre']; ?>"> <?= $row['nom_semestre']; ?> </option>
                    <?php endwhile; ?> 
                </select>            
               </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >Module</label>
            <div class="col-md-6" >
            <select  name="module" id="modi" class = "form-control">
                <option selected disabled> Modules </option>
                        <?php while ($row = mysqli_fetch_assoc($module_qry)) :?>
                        <option value="<?= $row['id_module']; ?>"> <?= $row['nom_module']; ?> </option>  
                    <?php endwhile;?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1" >deppartement</label>
            <div class="col-md-6" >
            <select class = "form-control" id="deppartement" name="departement">
                    <option selected disabled>deppartements</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="submit" value=Enregistrer class="btn-primary"  />
            </div>
        </div>
      </form>
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
</form>
</body>
</html>