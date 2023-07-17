<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

?>

<?php 
require '../connexion.php'; 
 require 'vendor/autoload.php';
?>

</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="acceuil.php">Acceuil</a>
                    
                    </li>
                    <li>Gestion des etudiants</li>
                    <li >importer des etudiants</li>
            </ol>
        </div>
    </div>

<div class="form-horizontal">
<br><br>
	<form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-1">Sélectionner un fichier Excel : </label>
            <div class="col-md-6">
                <input type="file" name="excel" class = "form-control" accept=".xlsx" required>
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
			$nom = $row[1];
			$prenom = $row[2];
			$lieu_naiss = $row[3];
			$Date_naiss = $row[4];
			$semestre = $row[5];
			$annee = $row[6];
			$email = $row[7];
			$groupe = $row[8];

		if(mysqli_query($conn, "INSERT INTO etudiant
		(`matricule`, `nom`, `prenom`, `lieu_naiss`, `Date_naiss`, `id_semestre`, `annee`, `email`,`id_role`, `id_groupe`) VALUES
		('$matricule', '$nom','$prenom', '$lieu_naiss','$Date_naiss', 
		(select id_semestre from semestre where nom_semestre = '$semestre'  LIMIT 1), '$annee','$email',3,
		(SELECT id_groupe FROM groupe WHERE libelle = '$groupe'  LIMIT 1) )")){
			header("location:etudiant.php");
		}	
		}

		echo
		"
		<script>
		alert('Succesfully Imported');
		document.location.href = '';
		</script>
		";
	}

	
	include "../nav_bar.php";
	?>
</body>
</html>
