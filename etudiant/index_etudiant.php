<?php
session_start();
$email = $_SESSION['email'];
if ($_SESSION["role"] != "etudiant") {
    header("location:../authentification.php");
    exit;
}
include "../nav_bar.php";
include_once "../connexion.php";

$sql_etud = "SELECT * FROM etudiant WHERE email = '$email' ;";
$etud_qry = mysqli_query($conn, $sql_etud);
$row_etud = mysqli_fetch_assoc($etud_qry);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        /* Ajoutez ce style pour changer le curseur en pointeur lorsqu'on survole une ligne */
        tr:hover {
            cursor: pointer;
            background-color: aliceblue;
        }
    </style>
</head>

<body>
    <br><br><br>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="#">Accueil</a></li>
                    <li>Les matières inscrites par l'étudiant &nbsp;&nbsp;<a> <?php echo $row_etud['nom']." ".$row_etud['prenom'] ?> </a></li>
                </ol>
            </div>
        </div>
        
<div class="b-example-divider"></div>

        <div style="overflow-x:auto;">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Code</th>
                    <th>Libelle de la matiére</th>
                    <th>Spécialité</th>
                    <th>Action</th>
                </tr>
                <?php
                $req_ens_mail =  "SELECT * FROM inscription, matiere, etudiant WHERE inscription.id_etud=etudiant.id_etud AND inscription.id_matiere=matiere.id_matiere AND email = '$email'";
                $req = mysqli_query($conn, $req_ens_mail);
                if (mysqli_num_rows($req) == 0) {
                    echo "Il n'y a pas encore de matières ajoutées !";
                } else {
                    while ($row = mysqli_fetch_assoc($req)) {
                        ?>
                        <tr onclick="redirectToDetails(<?php echo $row['id_matiere']; ?>)">
                            <td><?= $row['code'] ?></td>
                            <td><?= $row['libelle'] ?></td>
                            <td><?= $row['specialite'] ?></td>
                            <td>Details</td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <script>
        function redirectToDetails(id_matiere) {
            window.location.href = "soumission_etu_par_matiere.php?id_matiere=" + id_matiere;
        }
    </script>
</body>

</html>
