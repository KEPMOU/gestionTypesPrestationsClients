<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['CODEMODEPAIEMENT'];
	$Lib2=$_POST['REFERENCEPRODUIT'];
	$Lib3=$_POST['DATERECETTE'];
	$Lib4=$_POST['HEUREENREGRECETTE'];
	$Lib5=$_POST['QTERECETTE'];
	
	$requete="INSERT INTO RECETTE (CODEMODEPAIEMENT,REFERENCEPRODUIT,DATERECETTE,HEUREENREGRECETTE,QTERECETTE) values(?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5);			
	$resultat->execute($param);	
		
	header("location:ListeRecette.php");
	
?>