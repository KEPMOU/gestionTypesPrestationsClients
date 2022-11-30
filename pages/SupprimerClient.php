<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['CODECLIENT'];

	$requete="DELETE FROM CLIENT WHERE CODECLIENT = ?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:ListeClients.php");
	
?>