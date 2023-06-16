<?php
   //session_start();
   include_once ("controller.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="CSS/bootstrap.css" rel="stylesheet">
<link href="CSS/modern-business.css" rel="stylesheet">
<link href="CSS/cssLogin.css" rel="stylesheet" />

</head>
<body>
<div class="card card-container">


<form action="" method="POST" class="form-signin">


<?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
     ?>
        <input type="text" name="fname" required placeholder="Nom" class="form-control">
        <input type="text" name="lname" required placeholder="Prénom" class="form-control">
        <input type="password" name="password" required placeholder="Mot de passe" class="form-control">
        <input type="password" name="confirmPassword" required placeholder="Confirmer Mot de passe" class="form-control">
        <input type="submit" name="signup" value="Valider" class="btn btn-lg btn-primary btn-block btn-signin">
        <p>Vous avez déjà un compte ? <a href="authentification.php">connectez-vous</a></p>
</form>
</div>
</body>
</html>