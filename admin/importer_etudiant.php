<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

include "../nav_bar.php";
?>

<?php require '../connexion.php'; ?>

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
<form action="" method="POST">
        <div class="form-group">
            <label class="col-md-1">Sélectionner un fichier Excel : </label>
            <div class="col-md-6">
                <input type="file" name="file" class = "form-control" accept=".xlsx" required>
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
	if(isset($_POST["import"])){
		$fileName = $_FILES["file"]["name"];
		$fileExtension = explode('.', $fileName);
		$fileExtension = strtolower(end($fileExtension));
		$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

		$targetDirectory = "uploads/" . $newFileName;
		move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory);

		error_reporting(0);
		ini_set('display_errors', 0);

		require 'excelReader/excel_reader2.php';
		require 'excelReader/SpreadsheetReader.php';

		$reader = new SpreadsheetReader($targetDirectory);
		foreach($reader as $key => $row){
			$matricule = $row[0];
			$nom = $row[1];
			$prenom = $row[2];
			$lieu_naiss = $row[3];
			$Date_naiss = $row[4];
			$semestre = $row[5];
			$annee = $row[6];
			$email = $row[7];

		if(mysqli_query($conn, "INSERT INTO etudiant( `matricule`, `nom`, `prenom`, `lieu_naiss`, `Date_naiss`, `semestre`, `annee`, `email`,`id_role`) VALUES('$matricule', '$nom','$prenom', '$lieu_naiss','$Date_naiss', '$semestre', '$annee','$email',2)")){
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
	?>
</body>
</html>
