<?php
session_start();
$email = $_SESSION['email'];
if ($_SESSION["role"] != "ens") {
    header("location:authentification.php");
}

include_once "../connexion.php";

$semestre = "SELECT * FROM matiere, enseigner, enseignant WHERE matiere.id_matiere = enseigner.id_matiere AND enseigner.id_ens = enseignant.id_ens AND email='$email'";
$semestre_qry = mysqli_query($conn, $semestre);

function test_input($data)
{
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = htmlentities($data);
    $data = stripslashes($data);
    return $data;
}

if (isset($_POST['button'])) {
    $id_matiere = test_input($_POST['matiere']);
    $date_debut = test_input($_POST['debut']);
    $date_fin = test_input($_POST['fin']);
    $type = test_input($_POST['type']);

    $files = $_FILES['file'];

    $titre = test_input($_POST['titre_sous']);
    $descri = test_input($_POST['description_sous']);

    $sql1 = "INSERT INTO `soumission`(`titre_sous`, `description_sous`, `id_ens`, `date_debut`, `date_fin`, `valide`, `status`, `id_matiere`) VALUES ('$titre', '$descri', (SELECT id_ens FROM enseignant WHERE email = '$email'), '$date_debut', '$date_fin', 0, 0, $id_matiere)";
    $req1 = mysqli_query($conn, $sql1);

    $id_sous = mysqli_insert_id($conn);
    foreach ($files['tmp_name'] as $key => $tmp_name) {
        $file_name = $files['name'][$key];
        $file_tmp = $files['tmp_name'][$key];
        $file_size = $files['size'][$key];
        $file_error = $files['error'][$key];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if ($file_error === 0) {
            $new_file_name = uniqid('', true) . '.' . $file_ext;

			$sql3 = "SELECT code FROM matiere WHERE matiere.id_matiere = '$id_matiere'";
			$code_matiere_result = mysqli_query($conn, $sql3);
			$row = mysqli_fetch_assoc($code_matiere_result);
			$code_matire = $row['code'];
            $matiere_directory = 'C:\wamp64\www\projet_sous-main\Files\\' . $code_matire;

            // Créer le dossier s'il n'exist pas
            if (!is_dir($matiere_directory)) {
                mkdir($matiere_directory, 0777, true);
            }

            // Chemin complet 
            $destination = $matiere_directory . '\\' . $new_file_name;
            move_uploaded_file($file_tmp, $destination);

            // Insérer les info dans la base de donnéez
            $sql2 = "INSERT INTO `fichiers_soumission` (`id_sous`, `nom_fichier`, `chemin_fichier`) VALUES ($id_sous, '$file_name', '$destination')";
            $req2 = mysqli_query($conn, $sql2);
            if($req1 and $req2){
                header("location:soumission_en_ligne.php");
                $_SESSION['ajout_reussi'] = true;
            }
        }
    }
}

include "../nav_bar.php";
?>

<script type="text/JavaScript">
    var i = 1;

    function ToAction(url) {
        window.location.href = url;
    }
</script>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="#">Acceuil</a></li>
                    <li>Gestion des soumissions</li>
                    <li>Ajouter une soumission</li>
                </ol>
            </div>
        </div>

        <div class="form-horizontal">
            <br /><br />

            <p class="erreur_message">
                <?php
                if (isset($message)) {
                    echo $message;
                }
                ?>
            </p>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-md-1">Titre </label>
                    <div class="col-md-6">
                        <input type="text" name="titre_sous" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1">Matière</label>
                    <div class="col-md-6">
                        <select class="form-control" id="academic" value="Semesters" name="matiere">
                            <option selected disabled> Matière </option>
                            <?php while ($row = mysqli_fetch_assoc($semestre_qry)) : ?>
                                <option value="<?= $row['id_matiere']; ?>"> <?= $row['libelle']; ?> </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1">Date début </label>
                    <div class="col-md-6">
                        <input type="datetime-local" name="debut" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1">Date fin</label>
                    <div class="col-md-6">
                        <input type="datetime-local" name="fin" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1">Type soumission</label>
                    <div class="col-md-6">
                        <select class="form-control" id="academic" value="Semesters" name="type">
                            <option selected disabled> Types de soumissions </option>
                            <option value="examen">Examen</option>
                            <option value="devoir">Devoir</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1">Description </label>
                    <div class="col-md-6">
                        <textarea name="description_sous" id="" class="form-control" cols="30" rows="10"></textarea>
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
        </div>
    </div>
</body>
</html>
