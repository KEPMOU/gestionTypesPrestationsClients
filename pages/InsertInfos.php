<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$MatAgent=$_POST['MATRICULEAGENT'];
	$PosteC=$_POST['IDPOSTECOLLECTE'];
	$CodeV=$_POST['CODEVILLE'];
	$DateC=$_POST['DATECOLLECTE'];
	
	$requete="insert into collecte(MATRICULEAGENT,IDPOSTECOLLECTE,CODEVILLE,DATECOLLECTE) values(?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($MatAgent,$PosteC,$CodeV,$DateC);			
	$resultat->execute($param);	
		
	header("location:ListingCollecte.php");
	
?>