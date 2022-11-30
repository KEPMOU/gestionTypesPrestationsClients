<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 100);
	$Prefix = date('Y');
	$Prefix2 = "RMI";
	$code2 = sprintf("%'.03d",ceil($Nbre));
	
	$Lib1=$Prefix.$code2;
	$Lib2=$_POST['REFERENCEMEDICAMENT'];	
	$Lib3=$_POST['REFERENCEPHARMACIE'];	
	$Lib4=$_POST['DATEINTREGATION'];		
	$Lib5=$_POST['HEUREINTEGRATION'];		
	$Lib6=$_POST['QTESTOCKMEDICAMENTINTEGRE'];		
	$Lib7=$_POST['QTEALERTEMEDICAMENTINTEGRE'];		
	$Lib8=$_POST['QTESEUILMEDICAMENTINTEGRE'];				
	
	$requete="INSERT INTO MEDICAMENTINTEGRE(REFERENCEINTERNEMEDICAMENTINTEGRE,REFERENCEMEDICAMENT,REFERENCEPHARMACIE,DATEINTREGATION,HEUREINTEGRATION,QTESTOCKMEDICAMENTINTEGRE,QTEALERTEMEDICAMENTINTEGRE,QTESEUILMEDICAMENTINTEGRE) values(?,?,?,?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7,$Lib8);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:StockPharmacie.php");
	
?>