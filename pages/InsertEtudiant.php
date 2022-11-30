<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 1000);
	//$Prefix = date('Ymd');
	$Prefix2 = "ETD";
	
	$Lib1=$Prefix2.$Nbre;
	$Lib2=$_POST['CODEFILIERE'];
	$Lib3=$_POST['NOMPRENOMETUDIANT'];
	$Lib4=$_POST['TELEPHONEETUDIANT'];
	$Lib5=$_POST['DATENAISSETUDIANT'];
	
	$requete="INSERT INTO ETUDIANT (MATRICULEETUDIANT,CODEFILIERE,NOMPRENOMETUDIANT,TELEPHONEETUDIANT,DATENAISSETUDIANT) values(?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5);			
	$resultat->execute($param);	
		
	header("location:ListingEtd.php");
	
?>