<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['IDDEMANDECREDIT'];
	$Lib2=$_POST['CODEETATDEMANDE'];	
	
	$requete="UPDATE DEMANDECREDIT SET CODEETATDEMANDE=? WHERE IDDEMANDECREDIT=?";
	$param=array($Lib2,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:ListingDemandes.php");

?>