<?php	
	
	$id=$_GET['REFERENCEVOYAGE'];
	
	require_once('connexion.php');
	
	$requeteELEVE="select * from MODEREGLEMENT";
	$resultatEL = $con->query($requeteELEVE);
	
	$requeteELEVE1="select * from VOYAGE WHERE REFERENCEVOYAGE ='$id'";
	$resultatEL1 = $con->query($requeteELEVE1);
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Réservation de Voyage</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionAgenceVoyage1.JPG">		
		<div class="container"><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle Réservation de Voyage</div>
				<div class="panel-body">
					<form method="post" action="InsertReservation.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="CODEMODEREGLEMENT" class="control-label">MODE DE REGLEMENT</label>
							<select name="CODEMODEREGLEMENT" id="CODEMODEREGLEMENT" class="form-control">
								<?php while($filiereELEV=$resultatEL->fetch()){ ?>
									<option value="<?php echo $filiereELEV['CODEMODEREGLEMENT']?>">
										<?php echo $filiereELEV['LIBELLEMODEREGLEMENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="REFERENCEVOYAGE" class="control-label">CHOIX DU VOYAGE</label>
							<select readonly="readonly" name="REFERENCEVOYAGE" id="REFERENCEVOYAGE" class="form-control">
								<?php while($filiereELEV1=$resultatEL1->fetch()){ ?>
									<option value="<?php echo $filiereELEV1['REFERENCEVOYAGE']?>">
										<?php echo $filiereELEV1['REFERENCEVOYAGE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="NUMCNIUSAGER" class="control-label">VOTRE NUMERO DE CNI</label>
							<input type="text" name="NUMCNIUSAGER" id="NUMCNIUSAGER" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="NOMUSAGER" class="control-label">VOTRE NOM ET PRENOM</label>
							<input type="text" name="NOMUSAGER" id="NOMUSAGER" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="TELUSAGER" class="control-label">VOTRE CONTACT TELEPHONE</label>
							<input type="text" name="TELUSAGER" id="TELUSAGER" class="form-control"/>
						</div>

						<div class="form-group">
							<label for="DATEENREGRESERVATION" class="control-label">DATE DE LA RESERVATION</label>
							<input type="date" name="DATEENREGRESERVATION" id="DATEENREGRESERVATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREENREGRESERVATION" class="control-label">HEURE DE LA RESERVATION</label>
							<input type="time" name="HEUREENREGRESERVATION" id="HEUREENREGRESERVATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="NBREPLACERESERVATION" class="control-label">NOMBRE DE PLACE</label>
							<input type="number" name="NBREPLACERESERVATION" id="NBREPLACERESERVATION" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary btn-lg btn-block">VALIDER LA RESERVATION</button><br>
						<a class="btn btn-success btn-lg btn-block" href="ListeVoyagesProg.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>