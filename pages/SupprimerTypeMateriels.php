<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$CodeDiv=$_GET['CODETYPEMATERIEL'];

	$requete="DELETE FROM TYPEMATERIEL WHERE CODETYPEMATERIEL=?";			
	$param=array($CodeDiv);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:ListeTypeMateriels.php");
	
?>