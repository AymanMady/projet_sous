<?php





$DB=mysqli_connect("localhost","root","","revsion");
?>
<br>
<table border="1"style="width:60%">
<?php
$requet1="select * from emp ";
$execute=$DB->query($requet1);
if($execute-> num_rows>0 ){
 ?>
 <tr><th>id</th><th>nom</th><th>prenom</th><th>grad</th><th >salair</th><th colspan="2">action</th></tr>
<?php   
    while($row=$execute->fetch_assoc()){



?>
<tr>

<td><?php echo $row['id']?></td>
<td><?php echo $row['nom']?></td>
<td><?php echo $row['pronom']?></td>
<td><?php echo $row['grad']?></td>
<td><?php echo $row['salaire']?></td>
<td><a href="exo3_3.php?id=<?php echo  $row['id'] ;?>">modifie</a></td>
<td><a href="exo3_2.php?id=<?php echo  $row['id'] ;?>">suprime</a></td>
<?php

?>


</tr>
<?php
    }
}

?>

</table>

<br>
<br>
<br>
<br>
<br>


