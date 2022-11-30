<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 1000);
	//$Prefix = date('Y');
	$Prefix2 = "CLT";
	$code2 = sprintf("%'.03d",ceil($Nbre));
	
	$Lib1=$Prefix2.$code2;
	$Lib2=$_POST['NOMCLIENT'];	
	$Lib3=$_POST['ADRESSECLIENT'];				
	$Lib4=$_POST['TELCLIENT'];				
	
	$requete="INSERT INTO CLIENT(CODECLIENT,NOMCLIENT,ADRESSECLIENT,TELCLIENT) values(?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:ListeClients.php");
	
?>