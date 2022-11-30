<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 100);
	$Prefix = date('Ym');
	$Prefix2 = "PHARM";
	
	$Lib1=$Prefix2.$Prefix.$Nbre;
	$Lib2=$_POST['IDQUARTIER'];	
	$Lib3=$_POST['NOMPHARMACIE'];	
	$Lib4=$_POST['LOCALISATIONPHARMACIE'];		
	$Lib5=$_POST['CONTACTSPHARMACIE'];		
	$Lib6=$_POST['HEUREOUVRTUREPHARMACIE'];		
	$Lib7=$_POST['HEUREFERMETUREPHARMACIE'];		
	$Lib8=$_POST['ID'];			
	
	$requete="INSERT INTO PHARMACIE(REFERENCEPHARMACIE,IDQUARTIER,NOMPHARMACIE,LOCALISATIONPHARMACIE,CONTACTSPHARMACIE,HEUREOUVRTUREPHARMACIE,HEUREFERMETUREPHARMACIE,ID) values(?,?,?,?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7,$Lib8);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:ListePharmaciesYde.php");
	
?>