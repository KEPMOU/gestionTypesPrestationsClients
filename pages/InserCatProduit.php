<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['CODECATEGORIEPRODUIT'];
	$Lib2=$_POST['LIBELLECATEGORIEPRODUIT'];
	
	$requete="INSERT INTO CATEGORIEPRODUIT (CODECATEGORIEPRODUIT,LIBELLECATEGORIEPRODUIT) values(?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2);			
	$resultat->execute($param);	
		
	header("location:ListeCatProduit.php");
	
?>