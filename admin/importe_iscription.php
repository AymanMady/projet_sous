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

 <!DOCTYPE html>
<html lang="en" dir="ltr">
	<head> 
		<meta charset="utf-8">
		<title>Import Excel To MySQL</title>
		<link rel="stylesheet" href="../CSS/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
	</head>
	<body>
	<?php
  
    ?>
 
</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a>
                    
                    </li>
                    <li>Inscription</li>
                    <li >importer des inscription</li>
            </ol>
        </div>
    </div>

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
					

						
					if(mysqli_query($conn, "INSERT INTO inscription(`id_etud`, `id_matiere`, `id_semestre`) VALUES
									((SELECT id_etud from etudiant WHERE matricule = '$matricule'),
									(SELECT id_matiere FROM matiere WHERE code = '$code_matiere'),
									(SELECT id_semestre FROM semestre WHERE nom_semestre = '$semestre'))")){
										
								header('location:inscription.php');
								$_SESSION['import_reussi'] = true;
						}

					}
				
				
				// echo "
				// <script>
				// alert('Successfully Imported');
				// document.location.href = 'inscription.php';
				// </script>
				// ";
		
		}
		include "../nav_bar.php";
	?>
	
        </div>
	</body>
</html>


