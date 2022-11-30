<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 10000);
	$Prefix = date('dmY');
	$Prefix2 = "REG";
	$code2 = sprintf("%'.04d",ceil($Nbre));
	
	$Lib1=$Prefix2.$Prefix.$code2;
	$Lib2=$_POST['CODEPRESTATION'];	
	$Lib3=$_POST['DATEREGLEMENTPRESTATION'];				
	$Lib4=$_POST['HEUREENREGREGLEMENTPRESTATION'];				
	$Lib5=$_POST['MONTANTREGLEMENTPRESTATION'];						
	
	$requete = "INSERT INTO REGLEMENTPRESTATION(REFERENCEREGLEMENTPRESTATION,CODEPRESTATION,DATEREGLEMENTPRESTATION,HEUREENREGREGLEMENTPRESTATION,MONTANTREGLEMENTPRESTATION) values(?,?,?,?,?)";		
	$param = array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
	
	$requete2 = "UPDATE PRESTATION SET IDETATPRESTATION = 3 WHERE CODEPRESTATION = ?";
	$param2 = array($Lib2);		
	$resultat2 = $con->prepare($requete2);	
	$resultat2->execute($param2);
		
	header("location:ListingReglements.php");
	
?>