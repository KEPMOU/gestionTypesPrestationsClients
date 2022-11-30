<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['REFERENCEPRODUIT'];
	$Lib2=$_POST['CODECATEGORIEPRODUIT'];
	$Lib3=$_POST['DESIGNATIONPRODUIT'];
	$Lib4=$_POST['PRIXUNITAIREPRODUIT'];
	$Lib5=$_POST['QTESTOCKPRODUIT'];
	$Lib6=$_POST['QTESEUILPRODUIT'];
	$Lib7=$_POST['QTEALERTEPRODUIT'];
	
	$requete="INSERT INTO PRODUIT(REFERENCEPRODUIT,CODECATEGORIEPRODUIT,DESIGNATIONPRODUIT,PRIXUNITAIREPRODUIT,QTESTOCKPRODUIT,QTESEUILPRODUIT,QTEALERTEPRODUIT) values(?,?,?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7);			
	$resultat->execute($param);	
		
	header("location:ListeProduits.php");
	
?>