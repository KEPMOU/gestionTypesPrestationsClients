<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$id=$_GET['CODECATEGORIEPRODUIT'];

	$requete="DELETE FROM CATEGORIEPRODUIT WHERE CODECATEGORIEPRODUIT=?";			
	$param=array($id);	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);	
	
	header("location:ListeCatProduit.php");
	
?>