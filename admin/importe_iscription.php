<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="admin"){
    header("location:authentification.php");
}

 ?>

<?php require '../connexion.php'; ?>
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
            mysqli_query($conn, "DELETE FROM  inscripsion");
			foreach($reader as $key => $row){
				$groupe_cm = $row[0];
				$groupe_tp = $row[1];
				if(mysqli_query($conn, "INSERT INTO inscripsion(`id_matieres`, `id_etudi`) VALUES( (SELECT id_matiere FROM matiere WHERE code = '$groupe_cm'), (SELECT id_etud from etudiant WHERE matricule = '$groupe_tp'))")){
                    
                    header('location:inscription.php');

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
