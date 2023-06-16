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
<link rel="stylesheet" href="CSS/style_registration.css">
<link href="CSS/bootstrap.css" rel="stylesheet">
<link href="CSS/modern-business.css" rel="stylesheet">
<link href="CSS/cssLogin.css" rel="stylesheet" />
</head>
<body>
   
<div class="card card-container">

<form action="" method="POST" class="form-signin">

      <input type="email" name="email" required placeholder="Email" class="form-control">
      <select name="role" class="form-control">
        <option value="enseignant">Enseignant</option>
        <option value="etudiant">Etudiant</option>
      </select>
      <br>
      <input type="submit" name="verifier" value="login" class="btn btn-lg btn-primary btn-block btn-signin">
      <p><a href="authentification.php">connectez-vous</a></p>
   </form>

</div>
</body>
</html>
