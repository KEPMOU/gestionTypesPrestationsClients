<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 10000);
	//$Prefix = date('Ym');
	$Prefix2 = "MED";
	
	$Lib1=$Prefix2.$Nbre;
	$Lib2=$_POST['CODEFAMILLEMEDICAMENT'];	
	$Lib3=$_POST['CODEFORMEMEDICAMENT'];	
	$Lib4=$_POST['LIBELLEMEDICAMENT'];		
	$Lib5=$_POST['PRIXVENTEMEDICAMENT'];				
	
	$requete="INSERT INTO MEDICAMENT(REFERENCEMEDICAMENT,CODEFAMILLEMEDICAMENT,CODEFORMEMEDICAMENT,LIBELLEMEDICAMENT,PRIXVENTEMEDICAMENT) values(?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:ListeMedicaments.php");
	
?>