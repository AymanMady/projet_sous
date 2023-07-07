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
            $matricule_directory = 'C:/wamp64/www/projet_sous-main/Files/' . $matricule;

            // Créer le dossier s'il n'exist pas
            if (!is_dir($matricule_directory)) {
                mkdir($matricule_directory, 0777, true);
            }

            // Chemin complet 
            $destination = $matricule_directory . '/' . $new_file_name;
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

    if (isset($_POST['button'])) {
        $descri=test_input($_POST['description_sous']);
        $files = $_FILES['file'];
        if( !empty($descri) or !empty($files) ){
        $sql="UPDATE reponses set description_rep = '$descri' ,  `date` = NOW() where id_sous = $id_sous and id_etud=(select id_etud from etudiant where email = '$email') ";
    
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
                $matricule_directory = 'C:/wamp64/www/projet_sous-main/Files/' . $matricule;
    
                // Créer le dossier s'il n'exist pas
                if (!is_dir($matricule_directory)) {
                    mkdir($matricule_directory, 0777, true);
                }
    
                // Chemin complet 
                $destination = $matricule_directory . '/' . $new_file_name;
                move_uploaded_file($file_tmp, $destination);
    
                // Insérer les info dans la base de donnéez
                $sql3 = "DELETE FROM fichiers_reponses  where `id_rep`=(SELECT id_rep FROM reponses,etudiant WHERE 
                                                    reponses.id_etud=etudiant.id_etud and email='$email') ";
                $req3 = mysqli_query($conn, $sql3);
                $sql2 = "INSERT INTO `fichiers_reponses` (`id_rep`, `nom_fichiere`, `chemin_fichiere`) VALUES ((SELECT id_rep FROM reponses,etudiant WHERE reponses.id_etud=etudiant.id_etud and email='$email'), '$file_name', '$destination')";
                $req2 = mysqli_query($conn, $sql2);

                
                if($req1 && $req2){
                    header("location:index_etudiant.php");
                    $_SESSION['ajout_reussi'] = true;
                }else{
                    mysqli_connect_error();
                }
                
            }
        }
    }
    }
    include "../nav_bar.php";
    $sql = "SELECT * FROM reponses  WHERE  id_sous = '$id_sous' and id_etud = (select id_etud from etudiant where email = '$email')";
    $req1 = mysqli_query($conn , $sql);
    $row = mysqli_fetch_assoc($req1);
      
?>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a></li>
            <li>Modifier  le travail</li>
            </ol>
        </div>
    </div>
</div>
<div class="container">
    <div class="row " >
            <div class="col-lg-12" >
                <div class="well" >
                    <fieldset class="fsStyle" style="width: 2000px;">
                       
                        <div class="collapse in" id="demo">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="search-box">
                                        <div class="col-md-4 col-sm-2">
                                            <div class="form-group " style="width: 600px;">
                                                <label class="col-md-4">Description </label>
                                                <br><br>
                                                <div class="col-md-6" style="width: 490px;">
                                                    <textarea name="description_sous" id="" class = "form-control" cols="30" rows="10" ><?=$row['description_rep']?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-left:600px; width:1000px;">
                                                <div class="col-md-6">
                                                        <div class="alert alert-info" style="margin-left:50px;"> 
                                                            <strong   >Le(s) Fichier(s)</strong><br><br>
                                                            <div >
                                                            <?php
                                                                $sql2 = "select * from fichiers_reponses,reponses,etudiant where fichiers_reponses.id_rep=reponses.id_rep and reponses.id_etud=etudiant.id_etud AND email='$email' And reponses.id_sous= '$id_sous';";
                                                                $req2 = mysqli_query($conn,$sql2);
                                                                if(mysqli_num_rows($req2) == 0){
                                                                    echo "Il n'y a pas des fichier ajouter !" ;
                                                                }else {
                                                                    while($row2=mysqli_fetch_assoc($req2)){
                                                                        ?>
                                                                        <?php 
                                                                        $file_chemin = $row2['chemin_fichiere'];
                                                                        $file_name = $row2['nom_fichiere'];
                                                                        ?>
                                                                        <!-- style="display: flex ; justify-content: space-between; "  -->
                                                                        <div style="display: flex ; justify-content: space-between;">
                                                                        <div>
                                                                        <p><?=$row2['nom_fichiere']?></p>
                                                                        </div>
                                                                        <div>
                                                                        <form action="open_file.php" method="post">
                                                                            <input type="text" style="display:none" value="<?=$file_chemin?>" name="file_chemin">
                                                                            <button name="view" class="btn btn-primary ">View file</button>
                                                                        </form>
                                                                        </div>
                                                                        <div>
                                                                        <form action="telecharger_fichier.php" method="post">
                                                                            <input type="text" style="display:none" value="<?=$file_chemin?>" name="file_chemin">
                                                                            <input type="text" style="display:none" value="<?=$file_name?>" name="file_name">
                                                                            <button name="view" class="btn btn-primary ">Telecharger</button>
                                                                        </form>
                                                                        </div>
                                                                        </div>
                                                                        <br>

                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <br><br><br>
                                                <div class="form-group" style="width: 600px;" >
                                                    <label class="col-md-4" style="margin-top: 30px;">Sélectionnez un fichier : </label>
                                                    <br><br>
                                                    <div class="col-md-6" style="margin-top: 30px;">
                                                        <input type="file" id="fichier" name="file[]" class="form-control" multiple>
                                                    </div>
                                                </div>
                                                

                                                <div class="form-group" style="margin-left:100px; ">
                                                    <div class="col-md-6" style="margin-top: 50px;">
                                                        <input type="submit" name="button" value="Enregistrer" class="btn-primary" />
                                                    </div>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
<!-- <div class="form-horizontal" >
    <br /><br />
        <p class="erreur_message">
        <?php 
            // if(isset($message)){
            //     echo $message;
            // }
            ?>
        </p>
        <form action="" method="POST" enctype="multipart/form-data">
        <div style="display: flex ; justify-content: space-between;"> -->
        <!-- <div style="width:200px">
        <div class="form-group" style="min-width:100%">
            <label class="col-md-1">Description </label>
            <div class="col-md-4">
                <textarea name="description_sous" id="" class = "form-control" cols="30" rows="10" ><?=$row['description_rep']?></textarea>
            </div>
        </div>
        <div class="form-group" style="min-width:100%">
            <label class="col-md-1">Sélectionnez un fichier : </label>
            <div class="col-md-4">
                <input type="file" id="fichier" name="file[]" class="form-control" multiple>
            </div>
        </div>  -->
        <!-- </div>
        <div class="alert alert-info" style=" width:400px; height:300px;position:relative;right:0;" > 
            <strong style="position:absolute; top: 2; left: 20;"  >Le(s) Fichier(s)</strong><br><br>
            <div style="position:absolute;top: 6;left: 2;width: 380px;"> -->
            <?php
                // $sql2 = "select * from fichiers_reponses,reponses,etudiant where fichiers_reponses.id_rep=reponses.id_rep and reponses.id_etud=etudiant.id_etud AND email='$email' And reponses.id_sous= '$id_sous';";
                // $req2 = mysqli_query($conn,$sql2);
                // if(mysqli_num_rows($req2) == 0){
                //     echo "Il n'y a pas des fichier ajouter !" ;
                // }else {
                //     while($row2=mysqli_fetch_assoc($req2)){
                        ?>
                        <?php 
                        // $file_chemin = $row2['chemin_fichiere'];
                        // $file_name = $row2['nom_fichiere'];
                        ?>
                        <!-- <div style="display: flex ; justify-content: space-between; " >
                        <div> -->
                        <p><?//=$row2['nom_fichiere']?></p>
                        </div>
                        <!-- <div>
                        <form action="open_file.php" method="post">
                            <input type="text" style="display:none" value="<?=$file_chemin?>" name="file_chemin">
                            <button name="view" class="btn btn-primary ">View file</button>
                        </form>
                        </div>
                        <div>
                        <form action="telecharger_fichier.php" method="post">
                            <input type="text" style="display:none" value="<?=$file_chemin?>" name="file_chemin">
                            <input type="text" style="display:none" value="<?=$file_name?>" name="file_name">
                            <button name="view" class="btn btn-primary ">Telecharger</button>
                        </form>
                        </div>
                        </div>
                        <br> -->

                        <?php
                //     }
                // }
            ?>
            <!-- </div>
        </div>
        </div>

        <br><br><br>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="button" value="Enregistrer" class="btn-primary" />
            </div>
        </div>
</form>
</div>
</div> -->
<?php
}
?>
</body>
</html>