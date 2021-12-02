<?php 
//if(isset($_GET["numero"]) && is_numeric($_GET["numero"]))
	if(isset($_GET["numero"]))
{
    //Mostramos la imagen
 //   echo "<img src='crearCodigo.php?numero=".$_POST["numero"]."'>";

    include('lib/full/qrlib.php'); 
     
    // outputs image directly into browser, as PNG stream 
    //QRcode::png('PHP QR Code :)');
	QRcode::png($_GET["numero"]);
}