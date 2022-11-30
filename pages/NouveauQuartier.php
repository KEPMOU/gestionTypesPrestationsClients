<?php
	require_once('session.php');
	
	require_once('connexion.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Un Nouveau Quartier dans La Base de Données</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Un Nouveau Quartier dans La Base de Données</div>
				<div class="panel-body">
					<form method="post" action="InsertQuartier.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="NOMQUARTIER" class="control-label">NOM DU QUARTIER</label>
							<input type="text" name="NOMQUARTIER" id="NOMQUARTIER" class="form-control"/>
						</div>
											
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTEMENT</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeQuartiers.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>