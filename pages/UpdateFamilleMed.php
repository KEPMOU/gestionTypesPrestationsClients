<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['CODEFAMILLEMEDICAMENT'];
	$Lib2=$_POST['LIBELLEFAMILLEMEDICAMENT'];		
	
	$requete="UPDATE FAMILLEMEDICAMENT SET LIBELLEFAMILLEMEDICAMENT=? WHERE CODEFAMILLEMEDICAMENT=?";
	$param=array($Lib2,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:ListeFamillesMed.php");

?>