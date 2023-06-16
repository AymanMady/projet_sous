<?php
session_start() ;
$email = $_SESSION['email'];
// if($_SESSION["role"]!="admin"){
//     header("location:authentification.php");
// } 
?>

<?php
include_once "../connexion.php";
$ens = "SELECT * FROM enseignant ";
$ens_qry = mysqli_query($conn, $ens);
$groupe = "SELECT * FROM groupe";
$groupe_qry = mysqli_query($conn,$groupe);
$type_matiere = "SELECT * FROM type_matiere";
$type_matiere_qry = mysqli_query($conn,$type_matiere);



?>







<?php
$id_matiere = $_GET['id_matiere'];


    if (isset($_POST['button'])) {
    
        // Vérifiez si les champs enseignant et groupe sont des tableaux
        if (isset($_POST['enseignant']) && isset($_POST['groupe']) && isset($_POST['type_matiere']) ) {
            $enseignants = $_POST['enseignant'];
            $groupes = $_POST['groupe'];
            $type_matieres = $_POST['type_matiere'];

    
            // Parcourez les tableaux enseignant et groupe pour insérer les valeurs correspondantes dans la base de données
            foreach ($enseignants as $key => $enseignant) {
                $groupe = $groupes[$key];
                $type_matiere = $type_matieres[$key];

    
                if (!empty($enseignant) && !empty($groupe)  && !empty($type_matiere)) {
                    $req = mysqli_query($conn, "INSERT INTO enseigner (`id_matiere`, `id_ens`, `id_groupe`, `id_type_matiere`) VALUES ('$id_matiere', '$enseignant', '$groupe' , '$type_matiere')");
    
                        if (!$req) {
                            $message = "Erreur lors de l'ajout de l'enseignant et du groupe.";
                            break;
                        }
                } else {
                    $message = "Veuillez remplir tous les champs.";
                    break;
                }
            }
    
            if (!isset($message)) {
                header("location: matiere.php");
                exit();
            }
        } else {
            $message = "Veuillez sélectionner au moins un enseignant et un groupe et une type de matiere .";
        }
    }

include "../nav_bar.php";

?>
<script type="text/JavaScript">
    var i = 1;

   
    function ToAction(url) {
        window.location.href = url;
    }

    function createNewElement() {
        i++;
        // First create a DIV element.
        var txtNewInputBox = document.createElement('div');
        txtNewInputBox.className = "col-md-12";
        //txtNewInputBox.className = 'form-group';
        var div1 = document.createElement('div');
        var div2 = document.createElement('div');
        var div3 = document.createElement('div');
        var div4 = document.createElement('div');

        div1.className = "col-md-2";
        div2.className = "col-md-2";
        div3.className = "col-md-2";
        div4.className = "col-md-2";

      
        // Then add the content (a new input box) of the element.
        var nm =  i;
        div1.innerHTML = "<label class='col-md-2' '> Enseignant " + i + "</label>"
        txtNewInputBox.appendChild(div1);
        div2.innerHTML = "<select  name='enseignant[]' id='modi' class = 'form-control'><option selected disabled> Enseignants </option><?php while ($row_ens = mysqli_fetch_assoc($ens_qry)) :?><option value='<?= $row_ens['id_ens']; ?>'> <?= $row_ens['nom'].' '.$row_ens['prenom']; ?> </option>  <?php endwhile;?></select>";
        txtNewInputBox.appendChild(div2);
        div3.innerHTML = "<select  name='groupe[]' id='modi1' class = 'form-control' ><option selected disabled> Groupes </option><?php while ($row_groupe = mysqli_fetch_assoc($groupe_qry)) :?><option value='<?= $row_groupe['id_groupe']; ?>'> <?= $row_groupe['libelle']; ?> </option>  <?php endwhile;?></select>";
        txtNewInputBox.appendChild(div3);
        div4.innerHTML = "<select  name='type_matiere[]' id='modi1' class = 'form-control' ><option selected disabled> Type Matière </option><?php while ($row_type_matiere = mysqli_fetch_assoc($type_matiere_qry)) :?><option value='<?= $row_type_matiere['id_type_matiere']; ?>'> <?= $row_type_matiere['libelle_type']; ?> </option>  <?php endwhile;?></select><br>";
        txtNewInputBox.appendChild(div4);
        // div4.innerHTML = "<input type='text' class='form-control' name=" + nm + " multiple/><input type='file' name='files' multiple/>";
        // txtNewInputBox.appendChild(div4);
        document.getElementById("newElementId").appendChild(txtNewInputBox);
    }


</script>



</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="acceuil.php">Acceuil</a>
                    
                    </li>
                    <li>Gestion des matière</li>
                    <li>Affecter un enseignant</li>
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
                            <a data-toggle="collapse" data-target="#demo" href="#" >L'affectation d'un ou plusieurs enseignants à la matière  <?= $row_matiere['libelle'] ?></a>
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
            $ens = "SELECT * FROM enseignant ";
            $ens_qry = mysqli_query($conn, $ens);
            $groupe = "SELECT * FROM groupe ";
            $groupe_qry = mysqli_query($conn,$groupe);
            $type_matiere = "SELECT * FROM type_matiere";
            $type_matiere_qry = mysqli_query($conn,$type_matiere);
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
        
    
                <form action="" method="POST">
                <div class="form-group">
                    <label class="col-md-2">Enseignant 1 </label>
                    <div class="col-md-2">
                    <select  name="enseignant[]" id="modi" class = "form-control">
                        <option selected disabled> Enseignants </option>
                                <?php  while ($row_ens = mysqli_fetch_assoc($ens_qry)) :?>
                                <option value="<?= $row_ens['id_ens']; ?>"> <?= $row_ens['nom']." ".$row_ens['prenom']; ?> </option>  
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="col-md-2">
                    <select  name="groupe[]" id="modi1" class = "form-control">
                        <option selected disabled> Groupes </option>
                                <?php  while ($row_groupe = mysqli_fetch_assoc($groupe_qry)) :?>
                                <option value="<?= $row_groupe['id_groupe']; ?>"> <?= $row_groupe['libelle']; ?> </option>  
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="col-md-2">
                    <select  name="type_matiere[]" id="modi1" class = "form-control">
                        <option selected disabled> Type Matiere </option>
                                <?php  while ($row_type_matiere = mysqli_fetch_assoc($type_matiere_qry)) :?>
                                <option value="<?= $row_type_matiere['id_type_matiere']; ?>"> <?= $row_type_matiere['libelle_type']; ?> </option>  
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="col-md-3">   
                    <div class="alert alert-info"> 
                                <strong style="letter-spacing: 0.5px; font-size: 15px;  margin: auto;" type="submit" class="btn btn-light" style="border:none;">Le(s) enseignant(s) : </strong><br>
                                <h4>
                                <?php
                                $req_ens_info = "SELECT DISTINCT 
                                nom, prenom, 
                                libelle, libelle_type
                                FROM groupe
                                NATURAL JOIN enseigner
                                NATURAL JOIN enseignant
                                NATURAL JOIN type_matiere
                                WHERE id_matiere = $id_matiere ORDER BY nom, prenom ASC";

                                    //CALL `EnseignantMatiereParGroupe`($id_matiere)

                                $req = mysqli_query($conn , $req_ens_info);
                                if(mysqli_num_rows($req) == 0){
                                    echo "Il n'y a pas encore des enseignants affectés a cette matière !" ;
                                  }
                                $i = 0;
                                while($row=mysqli_fetch_assoc($req)){
                                $i++;
                                if ($i === 1) {
                                    echo "<strong class='font-weight-bold'>  </strong>";
                                    }
                                    echo  $row['nom'] ." ". $row['prenom']." ".$row['libelle']." ".$row['libelle_type']. "<br><br> ";
                                }
                                    ?>
                                    </h4>
                        </div>
                        </div>

                    <br>  <br> <br>
                    <div class="form-group" id="newElementId">
                    </div>
                    <br>  <br> <br>
                    <div class="col-md-12" >
                    <button type="button" onclick="createNewElement();">
                        Ajouter un enseignant
                    </button>
                    </div>
                    <br>  <br> <br>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" name="button" value="Enregistrer" class="btn-primary"  />

                    </div>
                </div>
                        </div>
                    </form>


  