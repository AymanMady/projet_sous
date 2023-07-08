<?php
session_start();
$email = $_SESSION['email'];
if ($_SESSION["role"] != "admin") {
    header("location:authentification.php");
}
?>

<<<<<<< HEAD
=======
<?php
require '../connexion.php';
require 'vendor/autoload.php';
?>
>>>>>>> 2b6c4202510c5107626747120c5fa5757ab6d024

<!DOCTYPE html>
<html lang="en" dir="ltr">
<<<<<<< HEAD
	<head> 
		<meta charset="utf-8">
		<title>Import Excel To MySQL</title>
		<link rel="stylesheet" href="../CSS/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>

    <!-- sweetalert2 links -->

    <script src="../JS/sweetalert2.js"></script>



	</head>
	<body>
</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
=======

<head>
    <meta charset="utf-8">
    <title>Import Excel To MySQL</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li><a href="#">Acceuil</a>

>>>>>>> 2b6c4202510c5107626747120c5fa5757ab6d024
                    </li>
                    <li>Inscription</li>
                    <li>Importer des inscriptions</li>
                </ol>
            </div>
        </div>

        <div class="form-horizontal">
            <br><br>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-md-1">Sélectionner un fichier Excel : </label>
                    <div class="col-md-6">
                        <input type="file" name="excel" class="form-control" accept=".xlsx" required value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input type="submit" name="import" value="Importer" class="btn-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>

<<<<<<< HEAD
<div class="form-horizontal">
<br><br>


	<form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-1">Sélectionner un fichier Excel : </label>
            <div class="col-md-6">
                <input type="file" name="excel" class = "form-control" accept=".xlsx" required value="">
            </div>
        </div>
		<div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="import" value=Importer class="btn-primary"  />
            </div>
        </div>
	</form>
</div>
</div> 

<?php
 require '../connexion.php'; 
 require 'vendor/autoload.php';


 if (isset($_POST["import"])) {

	$fileName = $_FILES["excel"]["name"];
	$fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
	$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

	$targetDirectory = "uploads/" . $newFileName;
	move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

	$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetDirectory);
	$worksheet = $spreadsheet->getActiveSheet();
	$data = $worksheet->toArray();

	foreach ($data as $key => $row) {
		if ($key === 0) {
			continue; // Skip the header row
		}

		$matricule = $row[0];
		$code_matiere = $row[1];
		$semestre = $row[2];
		
		$sql_condition = "SELECT (SELECT id_etud from etudiant WHERE matricule = '$matricule'),
				(SELECT id_matiere FROM matiere WHERE code='$code_matiere'),
				(SELECT id_semestre FROM semestre WHERE nom_semestre = '$semestre') FROM inscription ";

			$req_condition = mysqli_query($conn,$sql_condition);
			// $row_condition= mysqli_fetch_assoc($req_condition);
			if (mysqli_num_rows($req_condition)>0){
				// echo "Il ya une inscription est déjà inscrit !";
				echo "<script>
						Swal.fire({
							title: 'Importation non réussi !',
							text: 'Il ya une inscription est déjà inscrit !',
							icon: 'warning',
							confirmButtonColor: '#3099d6',
							confirmButtonText: 'OK'
							});
						</script>";
				
			}
			else{
											
				if(mysqli_query($conn, "INSERT INTO inscription(`id_etud`, `id_matiere`, `id_semestre`) VALUES
								((SELECT id_etud from etudiant WHERE matricule = '$matricule'),
								(SELECT id_matiere FROM matiere WHERE code = '$code_matiere'),
								(SELECT id_semestre FROM semestre WHERE nom_semestre = '$semestre'))")){
									
							header('location:inscription.php');
							$_SESSION['import_reussi'] = true;
					}
				}

		}
	
// 		foreach ($data as $key => $row) {
// 			if ($key === 0) {
// 				continue; // Skip the header row
// 			}
		
// 			$matricule = $row[0];
// 			$code_matiere = $row[1];
// 			$semestre = $row[2];

// 			// Vérifier si l'inscription existe déjà
// 			$sql_duplicate_check = "SELECT COUNT(*) AS count FROM inscription WHERE matricule = '$matricule' AND code_matiere = '$code_matiere' AND semestre = '$semestre'";
// 			$result_duplicate_check = mysqli_query($conn, $sql_duplicate_check);
// 			$row_duplicate_check = mysqli_fetch_assoc($result_duplicate_check);
// 			$count_duplicate = $row_duplicate_check['count'];
		
// 			if ($count_duplicate > 0) {
// 				echo "<script>
// 					Swal.fire({
// 						title: 'Importation non réussie !',
// 						text: 'Il y a déjà une inscription existante pour la combinaison de matricule, code de matière et semestre donnée.',
// 						icon: 'warning',
// 						confirmButtonColor: '#3099d6',
// 						confirmButtonText: 'OK'
// 					});
// 				</script>";
// 				include "../nav_bar.php";
// 				exit;
// 			} else {
// 				// Insérer la ligne dans la table "inscription"
// 				if (mysqli_query($conn, "INSERT INTO inscription(`id_etud`, `id_matiere`, `id_semestre`) VALUES
// 								((SELECT id_etud from etudiant WHERE matricule = '$matricule'),
// 								(SELECT id_matiere FROM matiere WHERE code = '$code_matiere'),
// 								(SELECT id_semestre FROM semestre WHERE nom_semestre = '$semestre'))")) {
// 					header('location:inscription.php');
// 					$_SESSION['import_reussi'] = true;
// 				}
// 			}
// 		}
		

}
include "../nav_bar.php";

 ?>

	
        </div>
	</body>
</html>
=======
    <?php

    if (isset($_POST["import"])) {

        $fileName = $_FILES["excel"]["name"];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

        $targetDirectory = "uploads/" . $newFileName;
        move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetDirectory);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        foreach ($data as $key => $row) {
            if ($key === 0) {
                continue; // Skip the header row
            }

            $matricule = $row[0];
            $code_matiere = $row[1];
            $semestre = $row[2];
>>>>>>> 2b6c4202510c5107626747120c5fa5757ab6d024

            $sql_etudiant = "SELECT id_etud FROM etudiant WHERE matricule = '$matricule'";
            $req_etudiant = mysqli_query($conn, $sql_etudiant);
            $row_etudiant = mysqli_fetch_assoc($req_etudiant);
            $id_etudiant = $row_etudiant['id_etud'];

            $sql_matiere = "SELECT id_matiere FROM matiere WHERE code='$code_matiere'";
            $req_matiere = mysqli_query($conn, $sql_matiere);
            $row_matiere = mysqli_fetch_assoc($req_matiere);
            $id_matiere = $row_matiere['id_matiere'];

            $sql_semestre = "SELECT id_semestre FROM semestre WHERE nom_semestre = '$semestre'";
            $req_semestre = mysqli_query($conn, $sql_semestre);
            $row_semestre = mysqli_fetch_assoc($req_semestre);
            $id_semestre = $row_semestre['id_semestre'];

            $sql_condition = "SELECT * FROM inscription WHERE id_etud=$id_etudiant AND id_matiere=$id_matiere AND id_semestre=$id_semestre";
            $req_condition = mysqli_query($conn, $sql_condition);

            if (mysqli_num_rows($req_condition) == 0) {
                if (mysqli_query($conn, "INSERT INTO inscription(`id_etud`, `id_matiere`, `id_semestre`) VALUES ($id_etudiant, $id_matiere, $id_semestre)")) {
                    header('location:inscription.php');
                    $_SESSION['import_reussi'] = true;
                }
            } else {
                continue;
            }
        }
    }
    include "../nav_bar.php";
    ?>

</body>

