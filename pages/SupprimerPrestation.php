<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['CODEPRESTATION'];

	$requete="DELETE FROM PRESTATION WHERE CODEPRESTATION = ?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:ListingPrestations.php");
	
?>