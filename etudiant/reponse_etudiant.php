<br><br><br>
<?php 
 session_start() ;
 $email = $_SESSION['email'];
 if($_SESSION["role"]!="etudiant"){
     header("location:../authentification.php");
 }

include_once "../connexion.php";

$id_sous = $_GET['id_sous'];

?>
<script type="text/JavaScript">
    var i = 1;

    function ToAction(url) {
        window.location.href = url;
    }

    function createNewElement() {
        i++;
        // First create a DIV element.
        var txtNewInputBox = document.createElement('div');
        txtNewInputBox.className = 'form-group';
        var div1 = document.createElement('div');
        var div2 = document.createElement('div');

        div2.className = "col-md-6";

      
        // Then add the content (a new input box) of the element.
        var nm =  i;
        txtNewInputBox.innerHTML = "<label class='col-md-1'>Sélectionnez un fichier : </label>"
        div2.innerHTML = "<input type='file' id='fichier' name='file' class = 'form-control'>";
        txtNewInputBox.appendChild(div2);
        document.getElementById("newElementId").appendChild(txtNewInputBox);
    }


</script>
<body>  
 

</br>
</br></br></br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            
            <ol class="breadcrumb">
            <li><a href="#">Acceuil</a></li>
            <li>Rendre  le travail</li>
            </ol>
        </div>
    </div>
   
<div class="form-horizontal">
    <br /><br />
<?php
    $sql = "select * from reponses where id_sous = '$id_sous' and id_etud = (select id_etud from etudiant where email = '$email') ";
$req = mysqli_query($conn,$sql);

if (mysqli_num_rows($req) == 0) {

function test_input($data){
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = htmlentities($data);
    $data = stripcslashes($data);
    return $data;
}
if(isset($_POST['button'])){
        $descri=test_input($_POST['description_sous']);
        $file= $_POST['file'];

    if( !empty($descri) or !empty($file) ){
        $sql="INSERT INTO `reponses`(`description_rep`,`data_reponse`, `id_sous`, `id_etud`) VALUES('$descri','$file','$id_sous',(select id_etud from etudiant where email = '$email')) ";

        $req = mysqli_query($conn,$sql);
        if($req){
            header("location: etudiant.php");
        }else {
            $message = "Etudiant non ajouté";
        }

    }else {
       $message = "Veuillez remplir tous les champs !";
    }
}
include "../nav_bar.php";

?>
    <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo $message;
            }
            ?>

        </p>
        <form action="" method="POST">
        <div class="form-group">
            <label class="col-md-1">Description </label>
            <div class="col-md-6">
                <textarea name="description_sous" id="" class = "form-control" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1">Sélectionnez un fichier : </label>
            <div class="col-md-6">
                <input type="file" id="fichier" name="file" class = "form-control">
            </div>
        </div>
        <div  id="newElementId">
        </div>
        <br>  <br> <br>
        <div class="col-md-12">
        <button type="button" onclick="createNewElement();">
                Ajouter un fichier
        </button>
        </div>
        <br>  <br> <br>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="button" value=Enregistrer class="btn-primary"  />
            </div>
        </div>
</form>

<?php
}else{
    function test_input($data){
        $data = htmlspecialchars($data);
        $data = trim($data);
        $data = htmlentities($data);
        $data = stripcslashes($data);
        return $data;
    }
    if(isset($_POST['button'])){
            $descri=test_input($_POST['description_sous']);
            $file= $_POST['file'];
    
        if( !empty($descri) or !empty($file) ){
            $sql="UPDATE reponses set description_rep = '$descri' ,  `date` = NOW() where id_sous = '$id_sous' and id_etud=(select id_etud from etudiant where email = '$email') ";
    
            $req = mysqli_query($conn,$sql);
            if($req){
                header("location: index_etudiant.php");
            }else {
                $message = "Reponse non ajouté";
            }
    
        }else {
           $message = "Veuillez remplir tous les champs !";
        }
    }
    include "../nav_bar.php";
    $sql = "SELECT * FROM reponses  WHERE  id_sous = '$id_sous' and id_etud = (select id_etud from etudiant where email = '$email')";
    $req1 = mysqli_query($conn , $sql);
    $row = mysqli_fetch_assoc($req1);
      
?>
        <p class="erreur_message">
            <?php 
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
        <div class="form-group">
            <label class="col-md-1">Description </label>
            <div class="col-md-6">
                <textarea name="description_sous" id="" class = "form-control" cols="30" rows="10" ><?=$row['description_rep']?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-1">Sélectionnez un fichier : </label>
            <div class="col-md-6">
                <input type="file" id="fichier" name="file" class = "form-control">
            </div>
        </div>
        <div  id="newElementId">
        </div>
        <br>  <br> <br>
        <div class="col-md-12">
        <button type="button" onclick="createNewElement();">
                Ajouter un fichier
        </button>
        </div>
        <br>  <br> <br>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                <input type="submit" name="button" value=Enregistrer class="btn-primary"  />

            </div>
        </div>
</form>
<?php
}
?>
</body>
</html>