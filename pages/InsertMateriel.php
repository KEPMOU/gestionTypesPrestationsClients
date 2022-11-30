<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['REFERENCEMATERIEL'];
	$Lib2=$_POST['CODETYPEMATERIEL'];
	$Lib3=$_POST['DESIGNATIONMATERIEL'];
	$Lib4=$_POST['PRIXUNITAIREMATERIEL'];
	$Lib5=$_POST['QTESTOCKMATERIEL'];
	$Lib6=$_POST['QTESEUILMATERIEL'];
	$Lib7=$_POST['QTEALERTEMATERIEL'];
	
	$requete="INSERT INTO MATERIEL(REFERENCEMATERIEL,CODETYPEMATERIEL,DESIGNATIONMATERIEL,PRIXUNITAIREMATERIEL,QTESTOCKMATERIEL,QTESEUILMATERIEL,QTEALERTEMATERIEL) values(?,?,?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7);			
	$resultat->execute($param);	
		
	header("location:ListeStock.php");
	
?>