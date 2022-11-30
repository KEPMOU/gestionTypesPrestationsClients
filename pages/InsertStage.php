<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$MatAgent=$_POST['CODETYPESTAGE'];
	$PosteC=$_POST['IDSTAGIAIRE'];
	$CodeV=$_POST['DATEDEBUTSTAGE'];
	$DateC=$_POST['DATEFINSTAGE'];
	
	$requete="insert into stage(CODETYPESTAGE,IDSTAGIAIRE,DATEDEBUTSTAGE,DATEFINSTAGE) values(?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($MatAgent,$PosteC,$CodeV,$DateC);			
	$resultat->execute($param);	
		
	header("location:ListeStage.php");
	
?>