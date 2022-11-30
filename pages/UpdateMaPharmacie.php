<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['REFERENCEPHARMACIE'];
	$Lib2=$_POST['IDQUARTIER'];	
	$Lib3=$_POST['NOMPHARMACIE'];	
	$Lib4=$_POST['LOCALISATIONPHARMACIE'];		
	$Lib5=$_POST['CONTACTSPHARMACIE'];		
	$Lib6=$_POST['HEUREOUVRTUREPHARMACIE'];
	$Lib7=$_POST['HEUREFERMETUREPHARMACIE'];
	$Lib8=$_POST['ID'];
	
	$requete="UPDATE PHARMACIE SET IDQUARTIER=?, NOMPHARMACIE=?, LOCALISATIONPHARMACIE=?, CONTACTSPHARMACIE=?, HEUREOUVRTUREPHARMACIE=?, HEUREFERMETUREPHARMACIE=?, ID=? WHERE REFERENCEPHARMACIE=?";
	$param=array($Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib7,$Lib8,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:MaPharmacie.php");

?>