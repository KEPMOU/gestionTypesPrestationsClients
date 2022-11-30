<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['CODETYPEVOYAGE'];
	$Lib2=$_POST['LIBELLETYPEVOYAGE'];
	$Lib3=$_POST['PRIXTYPEVOYAGE'];
	
	$requete="UPDATE TYPEVOYAGE SET LIBELLETYPEVOYAGE=?, PRIXTYPEVOYAGE=? WHERE CODETYPEVOYAGE=?";
	$param=array($Lib2,$Lib3,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:ListeTypeVoyage.php");

?>