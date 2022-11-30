<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$MatAgent=$_POST['IDSTAGIAIRE'];
	$PosteC=$_POST['LIBELLEACTIVITE'];
	$CodeV=$_POST['DESCRIPTIONACTIVITE'];
	$DateC=$_POST['DATEACTIVITE'];
	
	$requete="insert into activite(IDSTAGIAIRE,LIBELLEACTIVITE,DESCRIPTIONACTIVITE,DATEACTIVITE) values(?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($MatAgent,$PosteC,$CodeV,$DateC);			
	$resultat->execute($param);	
		
	header("location:ListeActivites.php");
	
?>