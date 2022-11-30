
<?php
	require_once('session.php');
	
	$ReF = $_GET['CODEFAMILLEMEDICAMENT'];
	
	require_once('connexion.php');
	
	$requete="SELECT * FROM FAMILLEMEDICAMENT WHERE CODEFAMILLEMEDICAMENT = '$ReF'";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations Sur La Famille de Médicaments Sélectionnée</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?><br><br><br><br>
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations Sur La Famille de Médicaments Sélectionnée</div>
				<div class="panel-body">
					<form method="post" action="UpdateFamilleMed.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="CODEFAMILLEMEDICAMENT" class="control-label">
								CODE FAMILLE DU MEDICAMENT = <?php echo $STAGIAIRE['CODEFAMILLEMEDICAMENT']; ?>
							</label>
							<input type="hidden" name="CODEFAMILLEMEDICAMENT" 
									id="CODEFAMILLEMEDICAMENT" class="form-control" 
									value="<?php echo $STAGIAIRE['CODEFAMILLEMEDICAMENT']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="LIBELLEFAMILLEMEDICAMENT" class="control-label">LIBELLE FAMILLE DU MEDICAMENT</label>
							<input type="text" name="LIBELLEFAMILLEMEDICAMENT" id="LIBELLEFAMILLEMEDICAMENT" class="form-control"
									value="<?php echo $STAGIAIRE['LIBELLEFAMILLEMEDICAMENT']; ?>"/>
						</div><hr>
											
						<button type="submit" class="btn btn-warning btn-lg btn-block">VALIDER LES MODIFICATIONS</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeFamillesMed.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	