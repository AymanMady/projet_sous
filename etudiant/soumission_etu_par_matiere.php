<?php
session_start();
$email = $_SESSION['email'];
if ($_SESSION["role"] != "etudiant") {
    header("location:../authentification.php");
    exit;
}
include "../nav_bar.php";
include_once "../connexion.php";

// $sql_etud = "SELECT * FROM etudiant WHERE email = $email";
// $etud_qry = mysqli_query($conn, $sql_etud);
// $row_etud = mysqli_fetch_assoc($etud_qry);

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
                    <li><a href="index_etudiant.php">Accueil</a></li>
                    <li>Les soumission par matiere  <?php //echo $row_etud['nom']." ".$row_etud['prenom'] ?></li>
                </ol>
            </div>
        </div>
        <div style="overflow-x:auto;">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Code</th>
                    <th>Titre de la soumission</th>
                    <th>Spécialité</th>
                    <th>date debut</th>
                    <th>date fin</th>
                </tr>
    <?php
                $id_matiere = $_GET['id_matiere'];

    $req_detail = "SELECT * FROM soumission inner join matiere using(id_matiere) WHERE id_matiere = $id_matiere and ( status=0  or status=1) and date_debut <= Now()";
    $req = mysqli_query($conn , $req_detail);
    if (mysqli_num_rows($req) > 0) {

    while($row=mysqli_fetch_assoc($req)){
        ?>
        <tr onclick="redirectToDetails(<?php echo $row['id_sous']; ?>)">
            <td><?= $row['code'] ?></td>
            <td><?= $row['titre_sous'] ?></td>
            <td><?= $row['specialite'] ?></td>
            <td><?= $row['date_debut'] ?></td>
            <td><?= $row['date_fin'] ?></td>

            <td>Details</td>
        </tr>
<?php
    }
}
    ?>
<script>
      function redirectToDetails(id_sous) {
            window.location.href = "soumission_etu.php?id_sous=" + id_sous;
        }
</script>