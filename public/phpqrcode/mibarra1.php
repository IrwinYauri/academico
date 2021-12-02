<center>
<?php $n4=10100; 
$d1="http://fersystem.hol.es/mibiblioteca/verlibro2.php?cod1=";
for($n=1;$n<4;$n++)
{$n4=$n4+1;
$r=$d1.$n4;	
echo $r;
echo "<br>";
?>
<img src='crearCodigo.php?numero=<?php echo $n4; ?>'>
<br>
<img src='mibarra2.php?numero=<?php echo $r; ?>'>
 <?php
 echo "<br>";
}
 ?>
 </center>
 