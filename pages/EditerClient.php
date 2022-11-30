
<?php
	require_once('session.php');
	
	$ReF = $_GET['CODECLIENT'];
	
	require_once('connexion.php');
	
	$requete="SELECT * FROM CLIENT WHERE CODECLIENT = '$ReF'";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations Sur Le Client Sélectionné</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('EnteteUser.php');?><br><br><br>
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations Sur Le Client Sélectionné</div>
				<div class="panel-body">
					<form method="post" action="UpdateClient.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="CODECLIENT" class="control-label" >
								CODE DU CLIENT = <?php echo $STAGIAIRE['CODECLIENT']; ?>
							</label>
							<input type="hidden" name="CODECLIENT" 
									id="CODECLIENT" class="form-control" 
									value="<?php echo $STAGIAIRE['CODECLIENT']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="NOMCLIENT" class="control-label">NOM DU CLIENT</label>
							<input type="text" name="NOMCLIENT" id="NOMCLIENT" class="form-control"
									value="<?php echo $STAGIAIRE['NOMCLIENT']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="ADRESSECLIENT" class="control-label">ADRESSE DU CLIENT</label>
							<input type="text" name="ADRESSECLIENT" id="ADRESSECLIENT" class="form-control"
									value="<?php echo $STAGIAIRE['ADRESSECLIENT']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="TELCLIENT" class="control-label">TELEPHONES DU CLIENT</label>
							<input type="text" name="TELCLIENT" id="TELCLIENT" class="form-control"
									value="<?php echo $STAGIAIRE['TELCLIENT']; ?>"/>
						</div><hr>
											
						<button type="submit" class="btn btn-warning btn-lg btn-block">VALIDER LES MODIFICATIONS</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeClients.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	