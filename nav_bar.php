<?php

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Bootstrap -->
    <link href="CSS/bootstrap.css" rel="stylesheet">
    <link href="CSS/modern-business.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


    <style>
       
            .logo{
                display: flex;
                align-items: center;
                justify-content: center;
                height: 60%;
                margin-bottom: 10px;
                flex-direction: column;
                width: 200px;
            }
           
            </style>
    
    <!-- Custom Fonts -->
    <link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery UI CSS Reference -->
    <link href="Content/themes/base/jquery-ui.min.css" rel="stylesheet" />
    <script src="Scripts/jquery-1.12.4.js"></script>
    <script src="Scripts/jquery-ui-1.12.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/commun.js"></script>
    <script src="js/sweetalert2.js"></script>
    

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Soumission</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="CSS/style.css" rel="stylesheet">

</head>
<body>
<?php
     if($_SESSION["role"]=="ens"){
        //session_start();
        $email = $_SESSION['email'];
        include("connexion.php");
        $req = mysqli_query($conn, "SELECT * FROM enseignant WHERE email = '$email'");
        $row = mysqli_fetch_assoc($req);
?>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
             </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                        
                <li id="potfolio" class="nav-item dropdown">   
                            <a class="nav-link dropdown-toggle" href="index_enseignant.php" >Matieres</a>
                            </li>
                        <li id="potfolio" class="nav-item dropdown">   
                            <a class="nav-link dropdown-toggle" href="#" >Soumission</a>
                            <ul class="dropdown-menu">
                                <li>
                                <a href="cree_soumission.php">Crée une soumission </a>
                                </li>
                                <li>
                                <a href="soumission_en_ligne.php">Soumission en ligne</a>
                                </li>
                                <li>
                                <a href="soumission_limite.php">Soumission terminer</a>
                                </li>
                                <li>
                                <a href="soumission_archiver.php">Soumission archifer</a>
                                </li>
                            </ul> 
                            <li  class="dropdown">
                               
                               <!-- <div class="container mt-12"> </div> -->
                                 <a href="#"><img title="<?=$row['nom']." ".$row['prenom']?>" 
                                 id="myButton" class="style-scope yt-img-shadow" src="../images/supnum.jpg" 
                                 draggable="false" style="width: 32px; height: 32px; border-radius: 50%;"></a>
 
                                <ul class="dropdown-menu">
                                    <li>
                                    <br>
                                        <div class="logo">
                                            <img title="<?=$row['nom']." ".$row['prenom']?>" 
                                            id="myButton" class="style-scope yt-img-shadow" 
                                            src="../images/photo_ens.jpg" draggable="false" 
                                            style="width: 40px; height: 40px; border-radius: 50%;">
                                            <p></p>
                                            <a> <strong class='font-weight-bold'><?=$row['nom']." ".$row['prenom']?></strong></a>
                                           
                                            <p><?=$row['email']?></p>
                                        </div> 
                                    </li>
                                    <li>
                                        <a href="#">Gérer votre compte</a>
                                    </li>
                                    <li>
                                        <a href="#"></a>
                                    </li>
                                    <li>
                                        <a href="supprimer_session.php">Se déconnecte</a>
                                    </li>
                                </ul>
                    </li>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <br><br>

<?php
            
     }

     else if($_SESSION["role"]=="admin"){
?>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
             </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                    
                        <li id="potfolio" class="dropdown">   
                            <a href="#" >Administration</a>
                            <ul class="dropdown-menu">
                                <li>
                                <a href="enseignant.php">Gestion des enseignants</a>
                                </li>
                                <li>
                                    <a href="etudiant.php">Gestion des étudiants</a>
                                </li >  
                                <li >
                                    <a href="utilisateurs.php">Gestion des utilisateurs</a>
                                </li>
                                <li >
                                    <a href="groupe.php">Gestion des groupes</a>
                                </li>
                                <li >
                                    <a href="matiere.php">Gestion des matières</a>
                                </li>
                            </ul> 
                        </li>
                        <li>
                            <a href="inscription.php">Inscription</a>
                        </li>
                        <li  class="dropdown">
                        <a href="#" >Soummission</a> 
                        </li>
                        <li  class="dropdown">
                               <a href="../supprimer_session.php">Se déconnecte</a>
                        </li>
                        
                        

                        
                </ul>

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php
     }else{
        include("connexion.php");
        $email = $_SESSION['email'];
        $req_etud = mysqli_query($conn, "SELECT * FROM etudiant WHERE email = '$email'");
        $row_etud = mysqli_fetch_assoc($req_etud);

?>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar">hello</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- You'll want to use a responsive image option so this logo looks good on devices - I recommend using something like retina.js (do a quick Google search for it and you'll find it) -->
             </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">
                     

                        <li id="potfolio" class="dropdown">   
                                <a href="index_etudiant.php" >Accueil</a>
                        </li>
                        
                        <li  class="dropdown">
                               
                                 <a href="#"><img title="<?=$row_etud['nom']." ".$row_etud['prenom']?>" 
                                 id="myButton" class="style-scope yt-img-shadow" src="../images/supnum.jpg" 
                                 draggable="false" style="width: 32px; height: 32px; border-radius: 50%;"></a>
 
                                <ul class="dropdown-menu">
                                    <li>
                                    <br>
                                        <div class="logo">
                                            <img title="<?=$row_etud['nom']." ".$row_etud['prenom']?>" 
                                            id="myButton" class="style-scope yt-img-shadow" 
                                            src="../images/photo_ens.jpg" draggable="false" 
                                            style="width: 40px; height: 40px; border-radius: 50%;">
                                            <p></p>
                                            <a> <strong class='font-weight-bold'><?=$row_etud['nom']." ".$row_etud['prenom']?></strong></a>
                                           
                                            <p><?=$row_etud['email']?></p>
                                        </div> 
                                    </li>
                                    <li>
                                        <a href="#">Gérer votre compte</a>
                                    </li>
                                    <li>
                                        <a href="#"></a>
                                    </li>
                                    <li>
                                        <a href="supprimer_session.php">Se déconnecte</a>
                                    </li>
                                </ul>
                    </li>                               
                </ul>
            </ul>

                
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php
     }
?>

</body>
</html>

