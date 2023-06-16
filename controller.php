
<head>

<meta charset="UTF-8">
    <link rel="stylesheet" href="search.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
    <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>login</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link rel="shortcut icon" href="../assets/img/ronk1.jpg" />
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet"> -->
  <!-- <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet"> -->

  <!-- Template Main CSS File -->
  <!-- <link href="../assets/css/style22.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">  
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   -->
  <script>
    $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").slideDown(300).delay(2000).slideUp(400);
});

$('#success-alert .close').click(function() {
  $(this).parent().hide();
});
  </script>
</head>
<?php
$alert = "";
    include_once("connexion.php");
    // Connection Created Successfully
 session_start();

    // Store All Errors
    $errors = [];


// include_once "verification.php";

    
        //verifier:
            if(isset($_POST['verifier'])){
                $role =  $_POST['role'];
                $email = $_POST['email'];
                    if(isset($role) && isset($email)){
                        if($role == "etudiant"){
                            session_start();
                            $_SESSION['nom']= "etudiant";
                            $_SESSION['email']= $email; 
                            header('location:registration.php');
                        }
                        else if($role == "enseignant"){
                            session_start();
                            $_SESSION['nom']= "enseignant";
                            $_SESSION['email']= $email;   
                            header('location: registration.php');    
                        }
                        }else {
                        $message = "Veuillez remplir tous les champs !";
                    }
            }



    // When Sign Up Button Clicked
    if (isset($_POST['signup'])) {
        function test($data){
        $data=htmlspecialchars($data) ;
        $data=trim($data) ;
        $data=strtolower($data) ;
    return $data ;
    }
    $role = $_SESSION['nom'];
    $email = $_SESSION['email'];

    if($role == "etudiant"){
        $sql_etud=mysqli_query($conn,"select * from etudiant where login='$email'");
        $query1="select id_role from etudiant where email='$email' limit 1";
        $query=mysqli_query($conn,$query1);
        $droit=mysqli_fetch_assoc($query);
        $id_role = $droit['id_role'];
    }else{
        $sql_ens=mysqli_query($conn,"select * from enseignant where login='$email'");
        $query1="select id_role from enseignant where email='$email' limit 1";
        $query=mysqli_query($conn,$query1);
        $droit=mysqli_fetch_assoc($query); 
        $id_role=$droit['id_role'];
    }

        $fname = test(mysqli_real_escape_string($conn, $_POST['fname']));
        $lname = test(mysqli_real_escape_string($conn, $_POST['lname']));
        @$test=explode("@", test($email));


         if(mysqli_num_rows($query)==0){
                    $errors['password'] = "Vous n'avez pas les droits pour cree un compt!";
            }   
            if($test[1]=='supnum.mr'){
        if (strlen(trim($_POST['password'])) < 8) {
            $errors['password'] = 'Utilisez 8 caractères ou plus avec un mélange de lettres, de chiffres et de symboles';
        } else {
            // if password not matched so
            if ($_POST['password'] != $_POST['confirmPassword']) {
                $errors['password'] = 'Mot de passe ne correspondant pas';
            } else {
                $password = md5($_POST['password']);
            }
        }
        // generate a random Code
        $code = rand(999999, 111111);
        // set Status
        $status = 0;
        $sql = "SELECT * FROM utilisateur WHERE login = '$email'";
        $res = mysqli_query($conn, $sql) or die('échec de la requête');
        if (mysqli_num_rows($res) > 0) {
            $errors['login'] = 'L’e-mail est déjà pris';
        }

        // count erros
        if (count($errors) === 0) {
            $insertQuery = "INSERT INTO utilisateur (`login`,pwd,id_role,active,code)
            VALUES ('$email','$password',$id_role,'$status','$code');";
            $insertInfo = mysqli_query($conn, $insertQuery) or die("hhh");

            // Send Varification Code In Gmail
            if ($insertInfo) {
                $subject = 'Code de vérification des e-mails';
                $message = "notre code de vérification est $code";
                $sender = "From: 22014@supnum.mr";
                 $url =  "https://script.google.com/macros/s/AKfycbw2MsBGjkJ7hzw_cnE5jW-CmqHZbibaNjrEz_DNXZZgCXfptPo5B1yy7x37kFrwSZkeFg/exec";
                    $ch = curl_init($url);
            curl_setopt_array($ch, [
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_POSTFIELDS => http_build_query([
                  "recipient" => $email,
                  "subject"   =>$subject,
                  "body"      =>$message
               ])
            ]);                
               $result = curl_exec($ch);
                if ($result) {
                    $message = "Nous avons envoyé un code de vérification à votre adresse e-mail <br> $email";

                    $_SESSION['message'] = $message;
                    header('location: verifier_code.php');
                } 
                    else {
                    $errors['otp_errors'] = 'Échec lors de l’envoi du code!';
                }
            } else {
                $errors['db_errors'] = "Échec lors de l’insertion de données dans la base de données !";
            }
        }
    }
}



    // if Verify Button Clicked
    if (isset($_POST['verify'])) {
        $_SESSION['message'] = "";
        $otp = mysqli_real_escape_string($conn, $_POST['otp']);
        $otp_query = "SELECT * FROM utilisateur WHERE code = $otp";
        $otp_result = mysqli_query($conn, $otp_query) or die("jj");

        if (mysqli_num_rows($otp_result) > 0) {
            $fetch_data = mysqli_fetch_assoc($otp_result);
            $fetch_code = $fetch_data['code'];
            print($fetch_code);
            $update_status = 1;
            $update_code = 0;

            $update_query = "UPDATE utilisateur SET active = '$update_status' , code = $update_code WHERE code = $fetch_code;";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                header('location: authentification.php');
            } else {
                $errors['db_error'] = "Impossible d’insérer des données dans la base de données!";
            }
        } else {
            $errors['otp_error'] = "Vous entrez un code de vérification non valide!";
        }
    }

    // if login Button clicked so

    if (isset($_POST['entrer'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = md5($_POST['password']);
        $matricule=explode("@",$email);
        $_SESSION['matricule']=$matricule[0];
        $Query = "SELECT * FROM utilisateur WHERE login = '$email' and  pwd ='$password'";
        $Query_check = mysqli_query($conn, $Query) or die("erreur");
        $row = mysqli_fetch_assoc($Query_check);
        if (mysqli_num_rows($Query_check) > 0) {
            $status = $row['active'];
                if ($status == 1) {
                     if($row['id_role']==1){
                        header("location:admin/acceuil.php");
                        session_start();
                        $_SESSION['email']=$email;
                        $_SESSION['role']="admin";
                        }
                    elseif($row['id_role']==2){
                        session_start();
                        $_SESSION['email']=$email;
                        $_SESSION['role']="ens";
                        header("location:Enseignant/index_enseignant.php");
                    }   
                    elseif($row['id_role']==3){
                        header("location:index_etudiant.php");
                    }   
                }
                else{
                    $errors['email'] = 'Ce compte n\'est pas activé, vous pouvez contacter l\'administrateur pour active le'; 
                }
        } else {
            $errors['email'] = '<div class="alert alert-danger row-md-15" id="success-alert">
        <span aria-hidden="true">&times;</span>
        <strong>Mot de passe ou Email incorrect ! </strong>
        </div>';
        }





    //    $passwordQuery = "SELECT * FROM utilisateur WHERE login = '$email'and  pwd ='$password'";
    // // ##############################################################
        $alert = '<div class="alert alert-danger row-md-15" id="success-alert">
        <span aria-hidden="true">&times;</span>
        <strong>Mot de passe ou Email incorrect! </strong>
        </div>';
    // // ################################################################
    //         $password_check = mysqli_query($conn, $passwordQuery);
    //         if (mysqli_num_rows($password_check) > 0) {
    //             $fetchInfo = mysqli_fetch_assoc($password_check);
    //             $status = $fetchInfo['active'];
    //             $name = $fetchInfo['nom'];
    //             $_SESSION['name'] = $name;
    //             $_SESSION['email'] = $fetchInfo['login'];
    //             $_SESSION['password'] = $fetchInfo['pwd'];
                
    //             if ($status == 1) {
    //                 @$login=$_POST["email"];
    //                 @$pass=md5($_POST["password"]);
    //                 @$valider=$_POST["entrer"];
    //                 $erreur="";
    //   $query=mysqli_query($conn,"select id_role from utilisateur where login='$login' and pwd='$pass' limit 1;");
    //   $tab=mysqli_fetch_assoc($query)or die("tfou");
    //   print_r($tab);
    //   print_r($tab['id_role']);
    //   if(mysqli_num_rows($query)==1){
    //     print_r($tab);
    
          
    //      else {
    //         $errors['email'] = 'Le mot de passe ne correspondait pas';
    //     }
   
                   
    // } else {
    //                 $info = "Il semble que vous n’ayez pas encore vérifié votre e-mail $email";
    //                 $_SESSION['message'] = $info;
    //                 header('location: verifier_code.php');
    //             }
    //     } else {
    //             $errors['email'] = $alert;
    //         }
    //     }else {

    //         $errors['email'] = 'Le mot de passe ne correspondait pas';
    //     }
        
    // }
    
}

    // if forgot button will clicked
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $_SESSION['email'] = $email;

        $emailCheckQuery = "SELECT * FROM utilisateur WHERE login= '$email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        // if query run
        if ($emailCheckResult) {
            // if email matched
            if ($emailCheckResult ->num_rows > 0) {
                $code = rand(999999, 111111);
                $updateQuery = "UPDATE utilisateur SET code = $code WHERE login = '$email'";
                $updateResult = mysqli_query($conn, $updateQuery) or die("hh");
                if ($updateResult) {
                       $subject = 'Code de vérification des e-mails';
                    $message = "Notre code de vérification est $code";
                 $url = "https://script.google.com/macros/s/AKfycbw2MsBGjkJ7hzw_cnE5jW-CmqHZbibaNjrEz_DNXZZgCXfptPo5B1yy7x37kFrwSZkeFg/exec";
            $ch = curl_init($url);
            curl_setopt_array($ch, [
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_POSTFIELDS => http_build_query([
                  "recipient" => $email,
                  "subject"   =>$subject,
                  "body"      =>$message
               ])
            ]);                
               $result = curl_exec($ch);
                 
                    if ($result) {
                        $message = "Nous avons envoyé un code de vérification à votre adresse e-mail <br> $email";

                        $_SESSION['message'] = $message;
                        header('location: verifyEmail.php');
                    } else {
                        $errors['otp_errors'] =  '<div class="alert alert-danger row-md-15" id="success-alert">
                                                    <span aria-hidden="true">&times;</span>
                                                    <strong>Échec lors de l’envoi du code ! </strong>
                                                </div>';
                    }
                } else {
                    $errors['db_errors'] = "Échec lors de l’insertion de données dans la base de données !";
                }
            }
            else{
                $errors['invalidEmail'] = '<p style ="color:red">Adresse e-mail non valide</p>';
            }
        }else {
            $errors['db_error'] = "Échec lors de la vérification des e-mails de la base de données!";
        }
    } 
if(isset($_POST['verifyEmail'])){
    $_SESSION['message'] = "";
    $otpverify = mysqli_real_escape_string($conn, $_POST['otpverify']);
    $verifyQuery = "SELECT * FROM utilisateur WHERE code = $otpverify";
    $runVerifyQuery = mysqli_query($conn, $verifyQuery);
    if($runVerifyQuery){
        if(mysqli_num_rows($runVerifyQuery) > 0){
            $newQuery = "UPDATE utilisateur SET code = 0";
            $run = mysqli_query($conn,$newQuery);
            header("location: newPassword.php");
        }else{
            $errors['verification_error'] = "Code de vérification non valide";
        }
    }else{
        $errors['db_error'] = "Échec lors de la vérification du code de vérification de la base de données!";
    }
}
 
// change Password
if(isset($_POST['changePassword'])){
    $password = md5($_POST['password']);
    $confirmPassword = md5($_POST['confirmPassword']);
    
    if (strlen($_POST['password']) < 8) {
        $errors['password_error'] = 'Utilisez 8 caractères ou plus avec un mélange de lettres, de chiffres et de symboles';
    } else {
        // if password not matched so
        if ($_POST['password'] != $_POST['confirmPassword']) {
            $errors['password_error'] = 'Mot de passe ne correspondant pas';
        } else {
            $email = $_SESSION['email'];
            $updatePassword = "UPDATE utilisateur SET pwd = '$password' WHERE login = '$email'";
            $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
           // session_unset($email);
            session_destroy();
            header('location: authentification.php');
        }
    }
}
?>
