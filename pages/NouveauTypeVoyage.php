<?php
	require_once('session.php');
	
	require_once('connexion.php');
		
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Un Nouveau Type de Voyage</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionVoyages6.JPG">	
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Un Nouveau Type de Voyage</div>
				<div class="panel-body">
					<form method="post" action="InsertTypeVoyage.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="CODETYPEVOYAGE" class="control-label">CODE DU TYPE DE VOYAGE</label>
							<input type="text" name="CODETYPEVOYAGE" id="CODETYPEVOYAGE" class="form-control"/>
						</div>						
						
						<div class="form-group">
							<label for="LIBELLETYPEVOYAGE" class="control-label">LIBELLE DU TYPE DE VOYAGE</label>
							<input type="text" name="LIBELLETYPEVOYAGE" id="LIBELLETYPEVOYAGE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="PRIXTYPEVOYAGE" class="control-label">PRIX DU VOYAGE</label>
							<input type="number" name="PRIXTYPEVOYAGE" id="PRIXTYPEVOYAGE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER NOUVEAU TYPE VOYAGE</button>
						<a class="btn btn-success" href="ListeTypeVoyage.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>