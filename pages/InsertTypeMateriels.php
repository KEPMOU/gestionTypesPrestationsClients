<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['CODETYPEMATERIEL'];
	$Lib2=$_POST['LIBELLETYPEMATERIEL'];
	
	$requete="INSERT INTO TYPEMATERIEL(CODETYPEMATERIEL,LIBELLETYPEMATERIEL) values(?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2);			
	$resultat->execute($param);	
		
	header("location:ListeTypeMateriels.php");
	
?>