<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 100);
	$Prefix = date('Ymd');
	$Prefix2 = "VTEMED";
	$code2 = sprintf("%'.03d",ceil($Nbre));
	
	$Lib1=$Prefix2.$Prefix.$code2;
	$Lib2=$_POST['REFERENCEINTERNEMEDICAMENTINTEGRE'];	
	$Lib3=$_POST['QTEVENTEMEDICAMENT'];	
	$Lib4=$_POST['DATEVENTEMEDICAMENT'];		
	$Lib5=$_POST['HEUREENREGVENTEMEDICAMENT'];
	$Lib6="VENTE DE MEDICAMENT";	
	
	$requete="INSERT INTO VENTEMEDICAMENT(REFERENCEVENTEMEDICAMENT,REFERENCEINTERNEMEDICAMENTINTEGRE,QTEVENTEMEDICAMENT,DATEVENTEMEDICAMENT,HEUREENREGVENTEMEDICAMENT) values(?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
	
	$requete2="UPDATE MEDICAMENTINTEGRE SET QTESTOCKMEDICAMENTINTEGRE=QTESTOCKMEDICAMENTINTEGRE - ? WHERE REFERENCEINTERNEMEDICAMENTINTEGRE=?";
	$param2=array($Lib3,$Lib2);		
	$resultat2 = $con->prepare($requete2);
	$resultat2->execute($param2);
	
	$requete3="INSERT INTO LIGNEINVENTAIREMEDICAMENT(REFERENCEINTERNEMEDICAMENTINTEGRE,LIBELLELIGNEINVENTAIREMEDICAMENT,QTELIGNEINVENTAIREMEDICAMENT) values(?,?,?)";		
	$param3=array($Lib2,$Lib6,$Lib3);
	$resultat3 = $con->prepare($requete3);
	$resultat3->execute($param3);
		
	header("location:VentesPharmacie.php");
	
?>