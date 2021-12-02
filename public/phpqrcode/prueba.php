<?php 

    include('lib/full/qrlib.php'); 
     
    // outputs image directly into browser, as PNG stream 
    //QRcode::png('PHP QR Code :)');
	QRcode::png('http://fersystem.hol.es/mibiblioteca/verlibro2.php?cod1=10650');