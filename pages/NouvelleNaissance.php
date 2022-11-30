<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requetePERE="SELECT * FROM PERSONNE";
	$resultatPERE = $con->query($requetePERE);
	
	$requeteMERE="SELECT * FROM PERSONNE";
	$resultatMERE = $con->query($requeteMERE);
	
	$requeteJOUR="SELECT * FROM JOUR";
	$resultatJOUR = $con->query($requeteJOUR);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Enregistrement - Naissances</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="GestionNaissance3.JPG">	
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Enregistrement - Nouvelle Naissance</div>
				<div class="panel-body">
					<form method="post" action="InsertNaissance.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="REFERENCENAISSANCE" class="control-label">REFERENCE DE LA NAISSANCE</label>
							<input type="text" name="REFERENCENAISSANCE" id="REFERENCENAISSANCE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="CODEJOUR" class="control-label">JOUR DE LA NAISSANCE</label>
							<select name="CODEJOUR" id="CODEJOUR" class="form-control">
								<?php while($filiereJOUR=$resultatJOUR->fetch()){ ?>
									<option value="<?php echo $filiereJOUR['CODEJOUR']?>">
										<?php echo $filiereJOUR['LIBELLEJOUR']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDPERSONNE" class="control-label">NOM DU PERE</label>
							<select name="IDPERSONNE" id="IDPERSONNE" class="form-control">
								<?php while($filierePERE=$resultatPERE->fetch()){ ?>
									<option value="<?php echo $filierePERE['IDPERSONNE']?>">
										<?php echo $filierePERE['NOMPERSONNE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDPERSONNE" class="control-label">CHOIX DE LA MERE</label>
							<select name="IDPERSONNE" id="IDPERSONNE" class="form-control">
								<?php while($filiereMERE=$resultatMERE->fetch()){ ?>
									<option value="<?php echo $filiereMERE['IDPERSONNE']?>">
										<?php echo $filiereMERE['NOMPERSONNE']?>
									</option>
								<?php } ?>
							</select>
						</div><hr>
						
						<div class="form-group">
							<label for="DATENAISSANCE" class="control-label">DATE DE NAISSANCE</label>
							<input type="date" name="DATENAISSANCE" id="DATENAISSANCE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="LIEUNAISSANCE" class="control-label">LIEU DE NAISSANCE</label>
							<input type="text" name="LIEUNAISSANCE" id="LIEUNAISSANCE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEURENAISSANCE" class="control-label">HEURE DE LA NAISSANCE</label>
							<input type="time" name="HEURENAISSANCE" id="HEURENAISSANCE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER ENREGISTREMENT DE LA NAISSANCE</button>
						<a class="btn btn-success" href="ListeNaissance.php">ANNULER - RETOUR LISTING</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>