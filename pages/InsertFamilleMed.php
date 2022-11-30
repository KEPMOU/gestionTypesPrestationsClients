<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 1000);
	//$Prefix = date('Ymd');
	$Prefix2 = "FAMMED";
	
	$Lib1=$Prefix2.$Nbre;
	$Lib2=$_POST['LIBELLEFAMILLEMEDICAMENT'];

	$requete="INSERT INTO FAMILLEMEDICAMENT (CODEFAMILLEMEDICAMENT,LIBELLEFAMILLEMEDICAMENT) values(?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2);			
	$resultat->execute($param);	
		
	header("location:ListeFamillesMed.php");
	
?>