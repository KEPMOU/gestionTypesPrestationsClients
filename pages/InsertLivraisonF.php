<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['REFERENCELIVRAISON'];
	$Lib2=$_POST['REFERENCEMATERIEL'];	
	$Lib3=$_POST['CODEFOURNISSEUR'];	
	$Lib4=$_POST['DATELIVRAISON'];		
	$Lib5=$_POST['QTELIVRAISON'];		
	
	$requete="INSERT INTO LIVRAISON(REFERENCELIVRAISON,REFERENCEMATERIEL,CODEFOURNISSEUR,DATELIVRAISON,QTELIVRAISON) values(?,?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4,$Lib5);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
	
	$requete2="UPDATE MATERIEL SET QTESTOCKMATERIEL=QTESTOCKMATERIEL + ? WHERE REFERENCEMATERIEL=?";
	$param2=array($Lib5,$Lib2);		
	$resultat2 = $con->prepare($requete2);
	$resultat2->execute($param2);
		
	header("location:ListeLivraisonsF.php");
	
?>