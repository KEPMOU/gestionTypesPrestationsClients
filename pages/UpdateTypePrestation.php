<?php
	require_once('session.php');
?>

<?php
	require_once('connexion.php');
	
	$Lib1=$_POST['CODETYPEPRESTATION'];
	$Lib2=$_POST['LIBELLETYPEPRESTATION'];	
	$Lib3=$_POST['COUTTYPEPRESTATION'];		
	
	$requete="UPDATE TYPEPRESTATION SET LIBELLETYPEPRESTATION = ?, COUTTYPEPRESTATION = ? WHERE CODETYPEPRESTATION = ?";
	$param=array($Lib2,$Lib3,$Lib1);		
	
	$resultat = $con->prepare($requete);	
	$resultat->execute($param);
	
	header("location:ListeTypesPrestations.php");

?>