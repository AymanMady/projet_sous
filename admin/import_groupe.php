<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}


require '../connexion.php';
require 'vendor/autoload.php';
 ?>

</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
                    </li>
                    <li>Gestion des groupes</li>
                    <li>Importer des groupes</li>
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
				$libelle = $row[0];
				$filiere = $row[1];
				if(mysqli_query($conn, "INSERT INTO groupe (`libelle`, `id_dep`) VALUES( '$libelle', (SELECT `id` FROM departement WHERE code = '$filiere'))")){
                    header('location:groupe.php');
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
        </div>
	</body>
</html>
