<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$MatAgent=$_POST['MATRICULEENCADREUR'];
	$PosteC=$_POST['IDSTAGIAIRE'];
	$CodeV=$_POST['DATEAFFECTATION'];
	$DateC=$_POST['HEUREAFFECTATION'];
	
	$requete="insert into affectation(MATRICULEENCADREUR,IDSTAGIAIRE,DATEAFFECTATION,HEUREAFFECTATION) values(?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($MatAgent,$PosteC,$CodeV,$DateC);			
	$resultat->execute($param);	
		
	header("location:ListeEncadrement.php");
	
?>