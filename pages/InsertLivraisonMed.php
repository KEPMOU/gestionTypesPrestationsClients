<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Nbre = rand(1, 100);
	$Prefix = date('Ymd');
	$Prefix2 = "LIVMED";
	$code2 = sprintf("%'.03d",ceil($Nbre));
	
	$Lib1=$Prefix2.$Prefix.$code2;
	$Lib2=$_POST['REFERENCEFOURNISSEUR'];	
	$Lib3=$_POST['REFERENCEINTERNEMEDICAMENTINTEGRE'];	
	$Lib4=$_POST['QTELIVRAISONMEDICAMENT'];		
	$Lib5=$_POST['DATELIVRAISONMEDICAMENT'];		
	$Lib6=$_POST['HEUREENREGLIVRAISONMEDICAMENT'];						
	$Lib7="LIVRAISON DE MEDICAMENT";						
	
	$requete="INSERT INTO LIVRAISONMEDICAMENT(REFERENCELIVRAISONMEDICAMENT,REFERENCEFOURNISSEUR,REFERENCEINTERNEMEDICAMENTINTEGRE,QTELIVRAISONMEDICAMENT,DATELIVRAISONMEDICAMENT,HEUREENREGLIVRAISONMEDICAMENT) values(?,?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5,$Lib6);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
	
	$requete2="UPDATE MEDICAMENTINTEGRE SET QTESTOCKMEDICAMENTINTEGRE=QTESTOCKMEDICAMENTINTEGRE + ? WHERE REFERENCEINTERNEMEDICAMENTINTEGRE=?";
	$param2=array($Lib4,$Lib3);		
	$resultat2 = $con->prepare($requete2);
	$resultat2->execute($param2);
	
	$requete3="INSERT INTO LIGNEINVENTAIREMEDICAMENT(REFERENCEINTERNEMEDICAMENTINTEGRE,LIBELLELIGNEINVENTAIREMEDICAMENT,QTELIGNEINVENTAIREMEDICAMENT) values(?,?,?)";		
	$param3=array($Lib3,$Lib7,$Lib4);
	$resultat3 = $con->prepare($requete3);
	$resultat3->execute($param3);
		
	header("location:LivraisonsPharmacie.php");
	
?>