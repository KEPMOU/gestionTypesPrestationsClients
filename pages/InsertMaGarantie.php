<?php
	require_once('session.php');
?>

<?php

	require_once('connexion.php');
	
	$Lib1=$_POST['IDDEMANDECREDIT'];
	$Lib2=$_POST['LIBELLEGARANTIE'];	
	$Lib3=$_POST['DESCRIPTIONGARANTIE'];	
	$Lib4=$_POST['VALEURGARANTIE'];				
	
	$requete="INSERT INTO GARANTIE(IDDEMANDECREDIT,LIBELLEGARANTIE,DESCRIPTIONGARANTIE,VALEURGARANTIE) values(?,?,?,?)";		
	$param=array($Lib1,$Lib2,$Lib3,$Lib4);
	$resultat = $con->prepare($requete);
	$resultat->execute($param);
		
	header("location:MesDemandes.php");
	
?>