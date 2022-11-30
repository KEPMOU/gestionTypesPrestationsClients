<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$RequetePRESTATION = "SELECT * FROM PRESTATION";
	$ResultatPRESTATION = $con->query($RequetePRESTATION);

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Un Nouveau Règlement des Prestations Client</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Un Nouveau Règlement des Prestations Client</div>
				<div class="panel-body">
					<form method="post" action="InsertReglement.php" class="form" enctype="multipart/form-data">
												
						<div class="form-group">
							<label for="CODEPRESTATION" class="control-label">SELECTION CODE DE LA PRESTATION A REGLER</label>
							<select name="CODEPRESTATION" id="CODEPRESTATION" class="form-control">
								<?php while($ListePRESTATION = $ResultatPRESTATION->fetch()){ ?>
									<option value="<?php echo $ListePRESTATION['CODEPRESTATION']?>">
										<?php echo $ListePRESTATION['CODEPRESTATION']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEREGLEMENTPRESTATION" class="control-label">DATE REGLEMENT PRESTATION</label>
							<input type="date" name="DATEREGLEMENTPRESTATION" id="DATEREGLEMENTPRESTATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREENREGREGLEMENTPRESTATION" class="control-label">HEURE REGLEMENT PRESTATION</label>
							<input type="time" name="HEUREENREGREGLEMENTPRESTATION" id="HEUREENREGREGLEMENTPRESTATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="MONTANTREGLEMENTPRESTATION" class="control-label">MONTANT REGLEMENT PRESTATION</label>
							<input type="number" name="MONTANTREGLEMENTPRESTATION" id="MONTANTREGLEMENTPRESTATION" class="form-control"/>
						</div><hr>
												
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTEMENT REGLEMENT PRESTATION</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListingReglements.php">ANNULER - RETOUR SUR LA LISTE DES REGLEMENTS</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>