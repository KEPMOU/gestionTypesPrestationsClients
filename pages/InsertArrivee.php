<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$MatAgent=$_POST['IDSTAGIAIRE'];
	$PosteC=$_POST['DATEARRIVEE'];
	$CodeV=$_POST['HEUREARRIVEE'];
	
	$requete="insert into arrivee(IDSTAGIAIRE,DATEARRIVEE,HEUREARRIVEE) values(?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($MatAgent,$PosteC,$CodeV);			
	$resultat->execute($param);	
		
	header("location:ListeArrive.php");
	
?>