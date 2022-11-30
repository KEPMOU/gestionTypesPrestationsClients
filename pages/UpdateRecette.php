<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['IDRECETTE'];
	$Lib2=$_POST['CODEMODEPAIEMENT'];
	$Lib3=$_POST['REFERENCEPRODUIT'];
	$Lib4=$_POST['DATERECETTE'];
	$Lib5=$_POST['HEUREENREGRECETTE'];
	$Lib6=$_POST['QTERECETTE'];
	
	$requete="UPDATE RECETTE SET CODEMODEPAIEMENT=?, REFERENCEPRODUIT=?, DATERECETTE=?, HEUREENREGRECETTE=?, QTERECETTE=? WHERE IDRECETTE=?";
	$param=array($Lib2,$Lib3,$Lib4,$Lib5,$Lib6,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:ListeRecette.php");

?>