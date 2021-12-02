<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/bootstrap-theme.css">
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js" ></script>
<!-- <script src="js/ver1.js"></script> -->
<!--fin  jQuery y bootstrap -->
<!-- iconos -->
<link rel="stylesheet" href="css/font-awesome.css">
<center>
<!--
<br>
<img alt="12345" src="php-barcode/barcode.php?codetype=Code25&size=40&text=12345" />
<br><br><br>
<img alt="testing" src="php-barcode/barcode.php?text=10101&print=true" />
<img src='mibarra2.php?numero=".$_POST["numero"]."'>
<br>
<img src='mibarra2.php?numero=10101'> //-->
<h4>Lista de libro<h4>
<?php
include("../lib.php");

//$q="select id,nombre,autor,codigobiblioteca,estado from libro1 where id='".$nn."'";
$q="select id,nombre,autor,codigobiblioteca,estado from libro1";
$r=mysqli_query($cn,$q);
echo "<table style='width:400px' class='table table-striped'>
<tr><th>codigo-barra<th>qr<th  style='width:150px'>nombre<th style='width:50px'>autor<th>codinterno</tr>
";
while($data=mysqli_fetch_array($r))
{
$x1=$data[0];
$d="http://fersystem.hol.es/mibiblioteca/verlibro.php?cod1=".$x1;
$x2=$data[1];
$x3=$data[2];
$x4=$data[3];
$x5=$data[4];
echo "<tr>
<td><img alt='testing' src='php-barcode/barcode.php?text=$x1&print=true'  />
<td><img src='mibarra2.php?numero=$d'>
<br>$x1<td>$x2
<td>$x3<td>$x4</tr>
";
}
echo "</table>"
?>