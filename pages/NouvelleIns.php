<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteel="select * from CLASSE";
	$resultatel = $con->query($requeteel);
	
	$requetcl="select * from ELEVE";
	$resultatcl = $con->query($requetcl);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Inscription</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img08.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle Inscription</div>
				<div class="panel-body">
					<form method="post" action="InsertIns.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="MATRICULEELEVE" class="control-label">ELEVE A INSCRIRE</label>
							<select name="MATRICULEELEVE" id="MATRICULEELEVE" class="form-control">
								<?php while($filiere=$resultatel->fetch()){ ?>
									<option value="<?php echo $filiere['MATRICULEELEVE']?>">
										<?php echo $filiere['NOMELEVE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODECLASSE" class="control-label">CHOIX DE LA CLASSE</label>
							<select name="CODECLASSE" id="CODECLASSE" class="form-control">
								<?php while($filiere=$resultatcl->fetch()){ ?>
									<option value="<?php echo $filiere['CODECLASSE']?>">
										<?php echo $filiere['LIBELLECLASSE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEINSCRIPTION" class="control-label">DATE DE INSCRIPTION</label>
							<input type="date" name="DATEINSCRIPTION" id="DATEINSCRIPTION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREINSCRIPTION" class="control-label">HEURE DE L'INSCRIPTION</label>
							<input type="time" name="HEUREINSCRIPTION" id="HEUREINSCRIPTION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="MONTANTINSCRIPTION" class="control-label">MONTANT DE L'INSCRIPTION</label>
							<input type="number" name="MONTANTINSCRIPTION" id="MONTANTINSCRIPTION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="ANNEESCOLAIRE" class="control-label">ANNEE SCOLAIRE ASSOCIEE</label>
							<input type="text" name="ANNEESCOLAIRE" id="ANNEESCOLAIRE" class="form-control"/>
						</div>
						
												
						<button type="submit" class="btn btn-primary">VALIDER INSCRIPTION ELEVE</button>
						<a class="btn btn-success" href="Inscriptions.php">ANNULER - RETOUR INSCRIPTIONS</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>