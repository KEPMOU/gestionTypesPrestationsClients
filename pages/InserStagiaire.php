<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['CODESTATUT'];
	$Lib2=$_POST['CODEFORMATION'];
	$Lib3=$_POST['CODEDIPLOME'];
	$Lib4=$_POST['CODEGENRE'];
	$Lib5=$_POST['NOMSTAGIAIRE'];
	$Lib6=$_POST['PRENOMSTAGIAIRE'];
	$Lib7=$_POST['DATENAISSSTAGIAIRE'];
	$Lib8=$_POST['TELSTAGIAIRE'];
	
	$requete="insert into stagiaire(CODESTATUT,CODEFORMATION,CODEDIPLOME,CODEGENRE,NOMSTAGIAIRE,PRENOMSTAGIAIRE,DATENAISSSTAGIAIRE,TELSTAGIAIRE) values(?,?,?,?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7,$Lib8);			
	$resultat->execute($param);	
		
	header("location:ListeStage.php");
	
?>