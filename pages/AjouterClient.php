<?php
	require_once('session.php');
	
	require_once('connexion.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Un Nouveau Client de L'Entreprise</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Un Nouveau Client de L'Entreprise</div>
				<div class="panel-body">
					<form method="post" action="InsertClient.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="NOMCLIENT" class="control-label">NOM DU CLIENT</label>
							<input type="text" name="NOMCLIENT" id="NOMCLIENT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="ADRESSECLIENT" class="control-label">ADRESSE DU CLIENT</label>
							<input type="text" name="ADRESSECLIENT" id="ADRESSECLIENT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="TELCLIENT" class="control-label">TELEPHONES DU CLIENT</label>
							<input type="text" name="TELCLIENT" id="TELCLIENT" class="form-control"/>
						</div>
											
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTREMENT DU NOUVEAU CLIENT</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeClients.php">ANNULER - RETOUR SUR LA LISTE</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>