
<?php
	require_once('session.php');
	
	$ReF = $_GET['CODEFORMEMEDICAMENT'];
	
	require_once('connexion.php');
	
	$requete="SELECT * FROM FORMEMEDICAMENT WHERE CODEFORMEMEDICAMENT = '$ReF'";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations Sur La Forme de Médicaments Sélectionnée</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?><br><br><br><br>
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations Sur La Forme de Médicaments Sélectionnée</div>
				<div class="panel-body">
					<form method="post" action="UpdateFormeMed.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="CODEFORMEMEDICAMENT" class="control-label">
								CODE FORME MEDICAMENT = <?php echo $STAGIAIRE['CODEFORMEMEDICAMENT']; ?>
							</label>
							<input type="hidden" name="CODEFORMEMEDICAMENT" 
									id="CODEFORMEMEDICAMENT" class="form-control" 
									value="<?php echo $STAGIAIRE['CODEFORMEMEDICAMENT']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="LIBELLEFORMEMEDICAMENT" class="control-label">LIBELLE FORME MEDICAMENT</label>
							<input type="text" name="LIBELLEFORMEMEDICAMENT" id="LIBELLEFORMEMEDICAMENT" class="form-control"
									value="<?php echo $STAGIAIRE['LIBELLEFORMEMEDICAMENT']; ?>"/>
						</div><hr>
											
						<button type="submit" class="btn btn-warning btn-lg btn-block">VALIDER LES MODIFICATIONS</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeFormesMed.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	