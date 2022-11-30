<?php
	require_once('session.php');
	
	require_once('connexion.php');
		
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Nouveau Type de Matériel - Quincaillerie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Quincaillerie8.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Nouveau Type de Matériel - Quincaillerie</div>
				<div class="panel-body">
					<form method="post" action="InsertTypeMateriels.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="CODETYPEMATERIEL" class="control-label">CODE TYPE MATERIEL</label>
							<input type="text" name="CODETYPEMATERIEL" id="CODETYPEMATERIEL" class="form-control"/>
						</div>						
						
						<div class="form-group">
							<label for="LIBELLETYPEMATERIEL" class="control-label">LIBELLE TYPE MATERIEL</label>
							<input type="text" name="LIBELLETYPEMATERIEL" id="LIBELLETYPEMATERIEL" class="form-control"/>
						</div><hr>					
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTREMENT</button><hr>
						<a class="btn btn-info btn-lg btn-block" href="ListeTypeMateriels.php">ANNULER - RETOUR</a>
					</form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>