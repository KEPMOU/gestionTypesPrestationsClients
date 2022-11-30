<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['MATRICULECAISSIERE'];
	$Lib2=$_POST['REFERENCEPOINTVENTE'];
	$Lib3=$_POST['DATEDEBUTAFFECTATION'];
	$Lib4=$_POST['DATEFINAFFECTATION'];

	$requete="INSERT INTO AFFECTER (MATRICULECAISSIERE,REFERENCEPOINTVENTE,DATEDEBUTAFFECTATION,DATEFINAFFECTATION) values(?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4);			
	$resultat->execute($param);	
		
	header("location:ListeAffectationsPointsVte.php");
	
?>