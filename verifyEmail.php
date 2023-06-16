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

<body >
<div class="card card-container">
        <div id="line"></div>
        <form action="" method="POST" class="form-signin">
            <?php
            if(isset($_SESSION['message'])){
                ?>
                <div id="alert" style="background:	#228B22;"><?php echo $_SESSION['message']; ?></div>
                <?php
            }
            ?>

            <?php
            if($errors > 0){
                foreach($errors AS $displayErrors){
                ?>
                <div id="alert"><?php echo $displayErrors; ?></div>
                <?php
                }
            }
            ?>      
            <input type="number" name="otpverify" placeholder="Verification Code" required class="form-control"><br>
            <input type="submit" name="verifyEmail" value="Verify" class="btn btn-lg btn-primary btn-block btn-signin">
        </form>
    </div>


</body>
</html>