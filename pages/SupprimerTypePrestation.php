<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['CODETYPEPRESTATION'];

	$requete="DELETE FROM TYPEPRESTATION WHERE CODETYPEPRESTATION = ?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:ListeTypesPrestations.php");
	
?>