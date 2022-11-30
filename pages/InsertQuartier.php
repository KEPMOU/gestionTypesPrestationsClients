<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');

	$Lib1=$_POST['NOMQUARTIER'];

	$requete="INSERT INTO QUARTIER (NOMQUARTIER) values(?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1);			
	$resultat->execute($param);	
		
	header("location:ListeQuartiers.php");
	
?>