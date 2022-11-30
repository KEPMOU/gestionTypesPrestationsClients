<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['REFERENCEMEDICAMENT'];
	$Lib2=$_POST['CODEFAMILLEMEDICAMENT'];	
	$Lib3=$_POST['CODEFORMEMEDICAMENT'];	
	$Lib4=$_POST['LIBELLEMEDICAMENT'];		
	$Lib5=$_POST['PRIXVENTEMEDICAMENT'];
	
	$requete="UPDATE MEDICAMENT SET CODEFAMILLEMEDICAMENT=?, CODEFORMEMEDICAMENT=?, LIBELLEMEDICAMENT=?, PRIXVENTEMEDICAMENT=? WHERE REFERENCEMEDICAMENT=?";
	$param=array($Lib2,$Lib3,$Lib4,$Lib5,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:ListeMedicaments.php");

?>