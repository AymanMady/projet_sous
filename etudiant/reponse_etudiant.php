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
        $groupe = $row[1];
        $semestre = $row[2];
        $nom = $row[3];
        $prenom = $row[4];
                $email = $row[5];

            

            if (mysqli_num_rows($req_condition) == 0) {
                if (mysqli_query($conn, "INSERT INTO etudiant( `id_etudient`, id_groupe,id_symestre,`nom`, `prenom`,email) VALUES('$matricule', '$groupe','$semestre','$nom','$prenom', '$email')")) {
                    header('location:list_etudiant.php');
                    // $_SESSION['import_reussi'] = true;
                }
            } else {
                continue;
            }
        }
    }
    ?>

</body>
