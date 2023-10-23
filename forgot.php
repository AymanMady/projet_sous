<?php include_once ("controller.php"); ?>
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
            if ($errors > 0) {
                foreach ($errors as $displayErrors) {
            ?>
                    <div id="alert"><?php echo $displayErrors; ?></div>
            <?php
                }
            }
            ?>
           <input type="email" name="email" required placeholder="Enter your email" class="form-control">
      <input type="submit" name="submit" value="Verifier" class="btn btn-lg btn-primary btn-block btn-signin">
      <p> <a href="authentification.php">Connectez Vous</a></p>
   </form>

</div>


</body>

</html>