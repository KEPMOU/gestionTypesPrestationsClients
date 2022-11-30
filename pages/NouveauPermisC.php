<?php
	require_once('session.php');
	
	require_once('connexion.php');

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Un Nouveau Permis de Conduire</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Auto3.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Un Nouveau Permis de Conduire</div>
				<div class="panel-body">
					<form method="post" action="InsertPermisC.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="CODETYPEPERMIS" class="control-label">CODE TYPEP ERMIS</label>
							<input type="text" name="CODETYPEPERMIS" id="CODETYPEPERMIS" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="LIBELLETYPEPERMIS" class="control-label">LIBELLE TYPE PERMIS</label>
							<input type="text" name="LIBELLETYPEPERMIS" id="LIBELLETYPEPERMIS" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="LIMITEAGETYPEPERMIS" class="control-label">LIMITE AGE TYPE PERMIS</label>
							<input type="number" name="LIMITEAGETYPEPERMIS" id="LIMITEAGETYPEPERMIS" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="COUTFORMATIONTYPEPERMIS" class="control-label">COUT FORMATION TYPE PERMIS</label>
							<input type="number" name="COUTFORMATIONTYPEPERMIS" id="COUTFORMATIONTYPEPERMIS" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER NOUVEAU TYPE DE PERMIS</button>
						<a class="btn btn-warning" href="ListeTypePermis.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>