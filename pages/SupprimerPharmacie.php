<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['REFERENCEPHARMACIE'];

	$requete="DELETE FROM PHARMACIE WHERE REFERENCEPHARMACIE=?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:ListePharmaciesYde.php");
	
?>