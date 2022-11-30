<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 100);
	//$Prefix = date('Ymd');
	$Prefix2 = "CATGP";
	
	$Lib1=$Prefix2.$Nbre;
	$Lib2=$_POST['LIBELLECATEGORIE'];

	$requete="INSERT INTO CATEGORIE (CODECATEGORIE,LIBELLECATEGORIE) values(?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2);			
	$resultat->execute($param);	
		
	header("location:ListeCategories.php");
	
?>