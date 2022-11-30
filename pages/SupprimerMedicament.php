<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['REFERENCEMEDICAMENT'];

	$requete="DELETE FROM MEDICAMENT WHERE REFERENCEMEDICAMENT=?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:ListeMedicaments.php");
	
?>