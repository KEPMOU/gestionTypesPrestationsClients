<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['IDCLIENT'];
	$Lib2=$_POST['REFERENCEPRODUIT'];	
	$Lib3=$_POST['DATEVENTE'];	
	$Lib4=$_POST['HEUREVENTE'];			
	$Lib5=$_POST['QTEVENTE'];			
	
	$requete="INSERT INTO VENTE(IDCLIENT,REFERENCEPRODUIT,DATEVENTE,HEUREVENTE,QTEVENTE) values(?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
	
	$requete2="UPDATE PRODUIT SET QTESTOCKPRODUIT=QTESTOCKPRODUIT - ? WHERE REFERENCEPRODUIT=?";
	$param2=array($Lib5,$Lib2);		
	$resultat2 = $con->prepare($requete2);	
	$resultat2->execute($param2);
		
	header("location:ListeVentes.php");
	
?>