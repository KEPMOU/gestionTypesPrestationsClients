<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['CODECLIENT'];
	$Lib2=$_POST['NOMCLIENT'];	
	$Lib3=$_POST['ADRESSECLIENT'];		
	$Lib4=$_POST['TELCLIENT'];		
	
	$requete="UPDATE CLIENT SET NOMCLIENT = ?, ADRESSECLIENT = ?, TELCLIENT = ? WHERE CODECLIENT = ?";
	$param=array($Lib2,$Lib3,$Lib4,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:ListeClients.php");

?>