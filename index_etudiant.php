<?php
// session_start() ;
// if($_SESSION["admin"]!="oui"){
//     header("location:authentification.php");
// }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ma page avec une navbar constante</title>
  <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
 
<?php
  //include "nav_bar.php";
  ?>



<div class="menu-bar">
        <ul>
            <li>
                <a href="#">Etudiants</a>
                <ul class="dropdown">
                    <li>
                        <a href="#">Matiére</a>
                        <a href="#">Devoirs</a>
                        <a href="#">Examens</a>
                        
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Soumission</a>
            </li>
        </ul>
        <div class="logout" >
            <a href="supprimer_session.php">Se déconnecte</a></div>
        </div>
    </div>



  <div class="content">
    <!-- Contenu de la page -->
  </div>
</body>
</html>
