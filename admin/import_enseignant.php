<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}
include "../nav_bar.php";

require '../connexion.php';
 ?>

</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
                    </li>
                    <li>Gestion des enseignants</li>
                    <li class="active">importer des enseignants</li>
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
		$newFileName = date("d.m.y") . " - " . date("h.i.sa") . "." . $fileExtension;

		$targetDirectory = "uploads/" . $newFileName;
		move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory);
		
		error_reporting(0);
		ini_set('display_errors', 0);

		require 'excelReader/excel_reader2.php';
		require 'excelReader/SpreadsheetReader.php';

		$reader = new SpreadsheetReader($targetDirectory);
		foreach($reader as $key => $row){
			$nom = $row[1];
			$prenom = $row[2];
			$Date_naiss = $row[3];
			$lieu_naiss = $row[4];
			$email = $row[5];


		if(mysqli_query($conn, "INSERT INTO enseignant( 
				`			 `nom`, `prenom`,
							`Date_naiss`,`lieu_naiss` ,
							`email`,`id_role`)
							VALUES(
							'$nom','$prenom',
							'$Date_naiss', '$lieu_naiss', 
							'$email',3)")){
					header("location:enseignant.php");
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
