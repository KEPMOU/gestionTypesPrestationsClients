<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['CODETYPEPERMIS'];
	$Lib2=1;
	$Lib3=$_POST['DATEINSCRIPTION'];
	$Lib4=$_POST['HEUREINSCRIPTION'];
	$Lib5=15000;
	$Lib6=$_POST['NOMCANDIDATINSCRIPTION'];
	$Lib7=$_POST['PRENOMCANDIDATINSCRIPTION'];
	$Lib8=$_POST['NUMCNICANDIDATINSCRIPTION'];
	$Lib9=$_POST['TELCANDIDATINSCRIPTION'];
	$Lib10=$_POST['DATENAISSCANDIDATINSCRIPTION'];
	$Lib11=$_POST['LIEUNAISSCANDIDATINSCRIPTION'];
	
	$nomPhoto= $_FILES['IMAGEPHOTOCANDIDATINSCRIPTION']['name'];	
	$imageTmp=$_FILES['IMAGEPHOTOCANDIDATINSCRIPTION']['tmp_name'];
	move_uploaded_file($imageTmp,'../images/'.$nomPhoto);
	
	$requete="insert into inscription(CODETYPEPERMIS,IDETATINSCRIPTION,DATEINSCRIPTION,HEUREINSCRIPTION,MONTANTINSCRIPTION,NOMCANDIDATINSCRIPTION,PRENOMCANDIDATINSCRIPTION,NUMCNICANDIDATINSCRIPTION,TELCANDIDATINSCRIPTION,DATENAISSCANDIDATINSCRIPTION,LIEUNAISSCANDIDATINSCRIPTION,IMAGEPHOTOCANDIDATINSCRIPTION) values(?,?,?,?,?,?,?,?,?,?,?,?)";	
	$resultat = $con->prepare($requete);			
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7,$Lib8,$Lib9,$Lib10,$Lib11,$nomPhoto);			
	$resultat->execute($param);	
		
	header("location:PageInscription.php");
	
?>