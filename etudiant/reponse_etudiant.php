<br><br><br>
<?php 
 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="etudiant"){
     header("location:../authentification.php");
 }

include_once "../connexion.php";

$id_sous = $_GET['id_sous'];

?>
<body>  
 

</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a></li>
            <li>Rendre  le travail</li>
            </ol>
        </div>
    </div>
   
<div class="form-horizontal">
    <br /><br />
<?php
    $sql = "select * from reponses where id_sous = '$id_sous' and id_etud = (select id_etud from etudiant where email = '$email') ";
$req = mysqli_query($conn,$sql);

if (mysqli_num_rows($req) == 0) {

function test_input($data)
{
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = htmlentities($data);
    $data = stripslashes($data);
    return $data;
}

if (isset($_POST['button'])) {
    $descri=test_input($_POST['description_sous']);
    $files = $_FILES['file'];
    if( !empty($descri) or !empty($files) ){
    $sql="INSERT INTO `reponses`(`description_rep`, `id_sous`, `id_etud`) VALUES('$descri','$id_sous',(select id_etud from etudiant where email = '$email')) ";

    $req1 = mysqli_query($conn,$sql);
    
    $id_rep = mysqli_insert_id($conn);
    foreach ($files['tmp_name'] as $key => $tmp_name) {
        $file_name = $files['name'][$key];
        $file_tmp = $files['tmp_name'][$key];
        $file_size = $files['size'][$key];
        $file_error = $files['error'][$key];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if ($file_error === 0) {
            $new_file_name = uniqid('', true) . '.' . $file_ext;

			$sql3 = "SELECT matricule FROM etudiant WHERE etudiant.email = '$email'";
			$code_matiere_result = mysqli_query($conn, $sql3);
			$row = mysqli_fetch_assoc($code_matiere_result);
			$matricule = $row['matricule'];
            $matricule_directory = 'C:\wamp64\www\projet_sous-main\Files\\' . $matricule;

            // Créer le dossier s'il n'exist pas
            if (!is_dir($matricule_directory)) {
                mkdir($matricule_directory, 0777, true);
            }

            // Chemin complet 
            $destination = $matricule_directory . '\\' . $new_file_name;
            move_uploaded_file($file_tmp, $destination);

            // Insérer les info dans la base de donnéez
            $sql2 = "INSERT INTO `fichiers_reponses` (`id_rep`, `nom_fichiere`, `chemin_fichiere`) VALUES ($id_rep, '$file_name', '$destination')";
            $req2 = mysqli_query($conn, $sql2);
            if($req1 and $req2){
                header("location:index_etudiant.php");
                $_SESSION['ajout_reussi'] = true;
            }
        }
    }
}
}
include "../nav_bar.php";

?>
    <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-1">Description </label>
            <div class="col-md-6">
                <textarea name="description_sous" id="" class = "form-control" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
                    <label class="col-md-1">Sélectionnez un fichier : </label>
                    <div class="col-md-6">
                        <input type="file" id="fichier" name="file[]" class="form-control" multiple>
                    </div>
                </div>
                <div id="newElementId"></div>
                <br><br><br>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" name="button" value="Enregistrer" class="btn-primary" />
                    </div>
                </div>
</form>

<?php
}else{
    function test_input($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripcslashes($data);
        return $data;
    }
    if(isset($_POST['button'])){
            $descri=test_input($_POST['description_sous']);
            $files = $_FILES['file'];
        if( !empty($descri) ){
            $sql="UPDATE reponses set description_rep = '$descri' ,  `date` = NOW() where id_sous = '$id_sous' and id_etud=(select id_etud from etudiant where email = '$email') ";
    
            $req = mysqli_query($conn,$sql);
 
    
        }

        
        foreach ($files['tmp_name'] as $key => $tmp_name) {
            $file_name = $files['name'][$key];
            $file_tmp = $files['tmp_name'][$key];
            $file_size = $files['size'][$key];
            $file_error = $files['error'][$key];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
            if ($file_error === 0) {
                $new_file_name = uniqid('', true) . '.' . $file_ext;
    
                $sql3 = "SELECT matricule FROM etudiant WHERE `etudiant`.`email` = '$email'";
                $code_matiere_result = mysqli_query($conn, $sql3);
                $row = mysqli_fetch_assoc($code_matiere_result);
                $code_matire = $row['matricule'];
                $matricule_directory = 'C:\wamp64\www\projet_sous-main\Files\\' . $code_matire;
    
                // Créer le dossier s'il n'exist pas
                if (!is_dir($matricule_directory)) {
                    mkdir($matricule_directory, 0777, true);
                }
    
                // Chemin complet 
                $destination = $matricule_directory . '\\' . $new_file_name;
                move_uploaded_file($file_tmp, $destination);
    
                // Insérer les info dans la base de donnéez
                $sql2 = "UPDATE fichiers_reponses set nom_fichiere`='$file_name',chemin_fichiere='$destination'  where `id_rep`=(SELECT reponses.id_rep FROM reponses NATURAL JOIN etudiant WHERE etudiant.email='$email') ";
                mysqli_query($conn, $sql2);
            }
        }
    }
    include "../nav_bar.php";
    $sql = "SELECT * FROM reponses  WHERE  id_sous = '$id_sous' and id_etud = (select id_etud from etudiant where email = '$email')";
    $req1 = mysqli_query($conn , $sql);
    $row = mysqli_fetch_assoc($req1);
      
?>
        <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-1">Description </label>
            <div class="col-md-6">
                <textarea name="description_sous" id="" class = "form-control" cols="30" rows="10" ><?=$row['description_rep']?></textarea>
            </div>
        </div>
        <div class="form-group">
                    <label class="col-md-1">Sélectionnez un fichier : </label>
                    <div class="col-md-6">
                        <input type="file" id="fichier" name="file[]" class="form-control" multiple>
                    </div>
                </div>
                <div id="newElementId"></div>
                <br><br><br>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" name="button" value="Enregistrer" class="btn-primary" />
                    </div>
                </div>
</form>
<?php
}
?>
</body>
</html>