<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 1000);
	$Prefix = date('dmY');
	$Prefix2 = "P";
	$code2 = sprintf("%'.03d",ceil($Nbre));
	
	$Lib1=$Prefix2.$Prefix.$code2;
	$Lib2=$_POST['CODECLIENT'];	
	$Lib3=$_POST['CODETYPEPRESTATION'];				
	$Lib4=$_POST['IDETATPRESTATION'];				
	$Lib5=$_POST['LIBELLETYPEPRESTATION'];				
	$Lib6=$_POST['DATEENREGPRESTATION'];				
	$Lib7=$_POST['HEUREENREGPRESTATION'];
	$Lib8=$_POST['MONTANTCOUTPRESTATION'];				
	
	$requete="INSERT INTO PRESTATION(CODEPRESTATION,CODECLIENT,CODETYPEPRESTATION,IDETATPRESTATION,LIBELLEPRESTATION,DATEENREGPRESTATION,HEUREENREGPRESTATION,MONTANTCOUTPRESTATION) values(?,?,?,?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7,$Lib8);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:ListingPrestations.php");
	
?>