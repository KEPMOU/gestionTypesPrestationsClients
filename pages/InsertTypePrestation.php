<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 100);
	//$Prefix = date('Y');
	$Prefix2 = "TP";
	$code2 = sprintf("%'.02d",ceil($Nbre));
	
	$Lib1=$Prefix2.$code2;
	$Lib2=$_POST['LIBELLETYPEPRESTATION'];	
	$Lib3=$_POST['COUTTYPEPRESTATION'];				
	
	$requete="INSERT INTO TYPEPRESTATION(CODETYPEPRESTATION,LIBELLETYPEPRESTATION,COUTTYPEPRESTATION) values(?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:ListeTypesPrestations.php");
	
?>