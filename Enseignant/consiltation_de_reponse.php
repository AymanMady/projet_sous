<?php
session_start() ;
$email = $_SESSION['email'];
if($_SESSION["role"]!="ens"){
    header("location:authentification.php");
}

?>
<?php
    $id_rep=$_GET['id_rep'];
    include "../nav_bar.php";
    $req_detail="SELECT * FROM `reponses` WHERE reponses.id_rep='$id_rep'";
    $req = mysqli_query($conn , $req_detail);
    $row=mysqli_fetch_assoc($req);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailler matiere par enseignant </title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container">
        <div class="row justify-content-center">
            <div class="alert alert-info" style="margin-left: 600px; width:400px; height:300px;" > 
                    <strong style="letter-spacing: 0.5px; font-size: 15px;width: 100%; height: 100%;text-align: center;"  >Le(s) Fichier(s)</strong><br><br>
            </div>
        </div>
        <p>
        <a href="reponses_etud.php?id_sous=<?=$row['id_sous']?>" class="btn btn-primary">Retour</a>
    </p>

</div>
</div>

</body>
</html>
