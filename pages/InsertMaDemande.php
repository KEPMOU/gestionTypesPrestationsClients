<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['REFERENCECLIENT'];
	$Lib2=$_POST['CODETYPECREDIT'];	
	$Lib3=$_POST['CODEETATDEMANDE'];	
	$Lib4=$_POST['DATEDEMANDECREDIT'];		
	$Lib5=$_POST['HEUREDEMANDECREDIT'];		
	$Lib6=$_POST['MONTANTDEMANDECREDIT'];		
	$Lib7=$_POST['COMMENTAIREDEMANDECREDIT'];		
	
	$requete="INSERT INTO DEMANDECREDIT(REFERENCECLIENT,CODETYPECREDIT,CODEETATDEMANDE,DATEDEMANDECREDIT,HEUREDEMANDECREDIT,MONTANTDEMANDECREDIT,COMMENTAIREDEMANDECREDIT) values(?,?,?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:MesDemandes.php");
	
?>