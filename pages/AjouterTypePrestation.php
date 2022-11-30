<?php
	require_once('session.php');
	
	require_once('connexion.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Un Nouveau Type de Prestation de L'Entreprise</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Un Nouveau Type de Prestation de L'Entreprise</div>
				<div class="panel-body">
					<form method="post" action="InsertTypePrestation.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="LIBELLETYPEPRESTATION" class="control-label">LIBELLE TYPE PRESTATION</label>
							<input type="text" name="LIBELLETYPEPRESTATION" id="LIBELLETYPEPRESTATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="COUTTYPEPRESTATION" class="control-label">COUT TYPE PRESTATION</label>
							<input type="number" name="COUTTYPEPRESTATION" id="COUTTYPEPRESTATION" class="form-control"/>
						</div>
											
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER TYPE DE PRESTATION</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeTypesPrestations.php">ANNULER - RETOUR SUR LA LISTE</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>