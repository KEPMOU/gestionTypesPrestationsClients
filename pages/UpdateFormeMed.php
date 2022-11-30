<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['CODEFORMEMEDICAMENT'];
	$Lib2=$_POST['LIBELLEFORMEMEDICAMENT'];		
	
	$requete="UPDATE FORMEMEDICAMENT SET LIBELLEFORMEMEDICAMENT=? WHERE CODEFORMEMEDICAMENT=?";
	$param=array($Lib2,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:ListeFormesMed.php");

?>