<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$user = $_SESSION['utilisateur']['ID'];
	
	$requetePHARMACIE = "SELECT * FROM PHARMACIE P, UTILISATEUR U
						WHERE P.ID = U.ID
							AND U.ID = $user";
	$resultatPHARMACIE = $con->query($requetePHARMACIE);
	
	$requeteMEDICAMENT = "SELECT * FROM MEDICAMENT";
	$resultatMEDICAMENT = $con->query($requeteMEDICAMENT);
	
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Pour Intégrer Un Médicament Dans Le Stock de La Pharmarie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?><br><br>
		<div class="container"><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Pour Intégrer Un Médicament Dans Le Stock de La Pharmarie</div>
				<div class="panel-body">
					<form method="post" action="InsertIntegrationMed.php" class="form" enctype="multipart/form-data">						
						<div class="form-group">
							<label for="REFERENCEPHARMACIE" class="control-label">MA PHARMACIE - NOM DE LA PHARMACIE</label>
							<select name="REFERENCEPHARMACIE" id="REFERENCEPHARMACIE" class="form-control" readonly="readonly">
								<?php while($filierePHARMACIE=$resultatPHARMACIE->fetch()){ ?>
									<option value="<?php echo $filierePHARMACIE['REFERENCEPHARMACIE']?>">
										<?php echo $filierePHARMACIE['NOMPHARMACIE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="REFERENCEMEDICAMENT" class="control-label">CHOIX DU MEDICAMENT A INTEGRER</label>
							<select name="REFERENCEMEDICAMENT" id="REFERENCEMEDICAMENT" class="form-control">
								<?php while($filiereMEDICAMENT=$resultatMEDICAMENT->fetch()){ ?>
									<option value="<?php echo $filiereMEDICAMENT['REFERENCEMEDICAMENT']?>">
										<?php echo $filiereMEDICAMENT['LIBELLEMEDICAMENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEINTREGATION" class="control-label">DATE INTREGATION</label>
							<input type="date" name="DATEINTREGATION" id="DATEINTREGATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREINTEGRATION" class="control-label">HEURE INTEGRATION</label>
							<input type="time" name="HEUREINTEGRATION" id="HEUREINTEGRATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTESTOCKMEDICAMENTINTEGRE" class="control-label">STOCK ACTUEL DU MEDICAMENT</label>
							<input type="number" name="QTESTOCKMEDICAMENTINTEGRE" readonly id="QTESTOCKMEDICAMENTINTEGRE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTEALERTEMEDICAMENTINTEGRE" class="control-label">QUANTITE POUR LES ALERTES</label>
							<input type="number" name="QTEALERTEMEDICAMENTINTEGRE" id="QTEALERTEMEDICAMENTINTEGRE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTESEUILMEDICAMENTINTEGRE" class="control-label">SEUIL DE SECURITE POUR LES VENTES</label>
							<input type="number" name="QTESEUILMEDICAMENTINTEGRE" id="QTESEUILMEDICAMENTINTEGRE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATEPEREMPTIONMEDICAMENTINTEGRE" class="control-label">DATE PEREMPTION DY MEDICAMENT</label>
							<input type="date" name="DATEPEREMPTIONMEDICAMENTINTEGRE" id="DATEPEREMPTIONMEDICAMENTINTEGRE" class="form-control"/>
						</div>
														
						<button type="submit" class="btn btn-primary btn-lg btn-block">INTEGRER LE MEDICAMENT DANS LE STOCK INTERNE</button><br>
						<a class="btn btn-danger btn-lg btn-block" href="StockPharmacie.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>