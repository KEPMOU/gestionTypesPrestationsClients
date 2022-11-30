<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$MatAgent=$_POST['IDSTAGIAIRE'];
	$PosteC=$_POST['DATEDEPART'];
	$CodeV=$_POST['HEUREDEPART'];
	
	$requete="insert into depart(IDSTAGIAIRE,DATEDEPART,HEUREDEPART) values(?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($MatAgent,$PosteC,$CodeV);			
	$resultat->execute($param);	
		
	header("location:ListeDepart.php");
	
?>