<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['NUMEROCOMPTE'];
	$Lib2="GEST01";
	$Lib3=$_POST['CODETYPECOMPTE'];	
	$Lib4=$_POST['REFERENCECLIENT'];	
	$Lib5=$_POST['DATECREATIONCOMPTE'];		
	$Lib6=$_POST['HEURECREATIONCOMPTE'];		
	$Lib7=$_POST['SOLDEDEPARTCOMPTE'];			
	$Lib8=$_POST['SOLDEACTUELLECOMPTE'];			
	
	$requete="INSERT INTO COMPTE(NUMEROCOMPTE,MATRICULEGESTIONNAIRE,CODETYPECOMPTE,REFERENCECLIENT,DATECREATIONCOMPTE,HEURECREATIONCOMPTE,SOLDEDEPARTCOMPTE,SOLDEACTUELLECOMPTE) values(?,?,?,?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7,$Lib8);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:ListingComptesClient.php");
	
?>