<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$RequeteCLIENT = "SELECT * FROM CLIENT";
	$ResultatCLIENT = $con->query($RequeteCLIENT);
	
	$RequeteTYPEPRESTATION = "SELECT * FROM TYPEPRESTATION";
	$ResultatTYPEPRESTATION = $con->query($RequeteTYPEPRESTATION);
	
	$RequeteETATPRESTATION = "SELECT * FROM ETATPRESTATION WHERE IDETATPRESTATION = 2";
	$ResultatETATPRESTATION = $con->query($RequeteETATPRESTATION);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Une Nouvelle Prestation du Client</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Une Nouvelle Prestation du Client</div>
				<div class="panel-body">
					<form method="post" action="InsertPrestation.php" class="form" enctype="multipart/form-data">
												
						<div class="form-group">
							<label for="CODECLIENT" class="control-label">SELECTION CLIENT DE L'ENTREPRISE</label>
							<select name="CODECLIENT" id="CODECLIENT" class="form-control">
								<?php while($ListeCLIENT = $ResultatCLIENT->fetch()){ ?>
									<option value="<?php echo $ListeCLIENT['CODECLIENT']?>">
										<?php echo $ListeCLIENT['NOMCLIENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODETYPEPRESTATION" class="control-label">SELECTION TYPE DE LA PRESTATION</label>
							<select name="CODETYPEPRESTATION" id="CODETYPEPRESTATION" class="form-control">
								<?php while($ListeTYPEPRESTATION = $ResultatTYPEPRESTATION->fetch()){ ?>
									<option value="<?php echo $ListeTYPEPRESTATION['CODETYPEPRESTATION']?>">
										<?php echo $ListeTYPEPRESTATION['LIBELLETYPEPRESTATION']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDETATPRESTATION" class="control-label">SELECTION ETAT DE LA PRESTATION</label>
							<select name="IDETATPRESTATION" id="IDETATPRESTATION" class="form-control">
								<?php while($ListeETATPRESTATION = $ResultatETATPRESTATION->fetch()){ ?>
									<option value="<?php echo $ListeETATPRESTATION['IDETATPRESTATION']?>">
										<?php echo $ListeETATPRESTATION['LIBELLEETATPRESTATION']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="LIBELLEPRESTATION" class="control-label">LIBELLE DE LA PRESTATION</label>
							<input type="text" name="LIBELLEPRESTATION" id="LIBELLEPRESTATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATEENREGPRESTATION" class="control-label">DATE ENREGISTEMENT</label>
							<input type="date" name="DATEENREGPRESTATION" id="DATEENREGPRESTATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREENREGPRESTATION" class="control-label">HEURE ENREGISTEMENT</label>
							<input type="time" name="HEUREENREGPRESTATION" id="HEUREENREGPRESTATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="MONTANTCOUTPRESTATION" class="control-label">MONTANT DE LA PRESTATION</label>
							<input type="number" name="MONTANTCOUTPRESTATION" id="MONTANTCOUTPRESTATION" class="form-control"/>
						</div><hr>
												
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTEMENT NOUVELLE PRESTATION</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListingPrestations.php">ANNULER - RETOUR SUR LA LISTE DES PRESTATIONS</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>