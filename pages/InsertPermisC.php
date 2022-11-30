<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['CODETYPEPERMIS'];
	$Lib2=$_POST['LIBELLETYPEPERMIS'];
	$Lib3=$_POST['LIMITEAGETYPEPERMIS'];
	$Lib4=$_POST['COUTFORMATIONTYPEPERMIS'];
	
	$requete="insert into typepermis(CODETYPEPERMIS,LIBELLETYPEPERMIS,LIMITEAGETYPEPERMIS,COUTFORMATIONTYPEPERMIS) values(?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4);			
	$resultat->execute($param);	
		
	header("location:ListeTypePermis.php");
	
?>