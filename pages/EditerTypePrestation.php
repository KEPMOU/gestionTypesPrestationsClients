
<?php
	require_once('session.php');
	
	$ReF = $_GET['CODETYPEPRESTATION'];
	
	require_once('connexion.php');
	
	$requete="SELECT * FROM TYPEPRESTATION WHERE CODETYPEPRESTATION = '$ReF'";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations du Type Prestation Sélectionné</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('EnteteUser.php');?><br><br><br>
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations du Type Prestation Sélectionné</div>
				<div class="panel-body">
					<form method="post" action="UpdateTypePrestation.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="CODETYPEPRESTATION" class="control-label" >
								CODE TYPE PRESTATION = <?php echo $STAGIAIRE['CODETYPEPRESTATION']; ?>
							</label>
							<input type="hidden" name="CODETYPEPRESTATION" 
									id="CODETYPEPRESTATION" class="form-control" 
									value="<?php echo $STAGIAIRE['CODETYPEPRESTATION']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="LIBELLETYPEPRESTATION" class="control-label">LIBELLE TYPE PRESTATION</label>
							<input type="text" name="LIBELLETYPEPRESTATION" id="LIBELLETYPEPRESTATION" class="form-control"
									value="<?php echo $STAGIAIRE['LIBELLETYPEPRESTATION']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="COUTTYPEPRESTATION" class="control-label">COUT TYPE PRESTATION</label>
							<input type="number" name="COUTTYPEPRESTATION" id="COUTTYPEPRESTATION" class="form-control"
									value="<?php echo $STAGIAIRE['COUTTYPEPRESTATION']; ?>"/>
						</div><hr>
											
						<button type="submit" class="btn btn-warning btn-lg btn-block">VALIDER LES MODIFICATIONS</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeTypesPrestations.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	