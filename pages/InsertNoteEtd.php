<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');

	$Lib1=$_POST['MATRICULEETUDIANT'];
	$Lib2=$_POST['CODEUNITEENSEIGNEMENT'];
	$Lib3=$_POST['REFERENCEEVALUATION'];
	$Lib4=$_POST['NOTEEVALUATIONETUDIANT'];
	
	$requete="INSERT INTO LIGNEEVALUATION (MATRICULEETUDIANT,CODEUNITEENSEIGNEMENT,REFERENCEEVALUATION,NOTEEVALUATIONETUDIANT) values(?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4);			
	$resultat->execute($param);	
		
	header("location:ListingNotes.php");
	
?>