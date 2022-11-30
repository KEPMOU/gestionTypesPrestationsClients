<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$ReF = $_GET['REFERENCEINTERNEMEDICAMENTINTEGRE'];
	
	$user = $_SESSION['utilisateur']['ID'];
	
	$requeteFOURNISSEUR = "SELECT * FROM FOURNISSEUR";
	$resultatFOURNISSEUR = $con->query($requeteFOURNISSEUR);
	
	$requeteMEDICAMENTINTEGRE = "SELECT * FROM MEDICAMENTINTEGRE WHERE REFERENCEINTERNEMEDICAMENTINTEGRE = '$ReF'";
	$resultatMEDICAMENTINTEGRE = $con->query($requeteMEDICAMENTINTEGRE);
	
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Noter Une Nouvelle Livraisons de Médicaments Dans Le Stock de La Pharmarie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?><br><br>
		<div class="container"><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Noter Une Nouvelle Livraisons de Médicaments Dans Le Stock de La Pharmarie</div>
				<div class="panel-body">
					<form method="post" action="InsertLivraisonMed.php" class="form" enctype="multipart/form-data">						
						<div class="form-group">
							<label for="REFERENCEFOURNISSEUR" class="control-label">LE FOURNISSEUR DE LA LIVRAISON</label>
							<select name="REFERENCEFOURNISSEUR" id="REFERENCEFOURNISSEUR" class="form-control">
								<?php while($filiereFOURNISSEUR=$resultatFOURNISSEUR->fetch()){ ?>
									<option value="<?php echo $filiereFOURNISSEUR['REFERENCEFOURNISSEUR']?>">
										<?php echo $filiereFOURNISSEUR['NOMFOURNISSEUR']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="REFERENCEINTERNEMEDICAMENTINTEGRE" class="control-label">CHOIX DU MEDICAMENT A LIVRER</label>
							<select name="REFERENCEINTERNEMEDICAMENTINTEGRE" id="REFERENCEINTERNEMEDICAMENTINTEGRE" class="form-control" readonly="readonly">
								<?php while($filiereMEDICAMENTINTEGRE=$resultatMEDICAMENTINTEGRE->fetch()){ ?>
									<option value="<?php echo $filiereMEDICAMENTINTEGRE['REFERENCEINTERNEMEDICAMENTINTEGRE']?>">
										<?php echo $filiereMEDICAMENTINTEGRE['REFERENCEINTERNEMEDICAMENTINTEGRE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="QTELIVRAISONMEDICAMENT" class="control-label">QUANTITE DE LA LIVRAISON</label>
							<input type="number" name="QTELIVRAISONMEDICAMENT" id="QTELIVRAISONMEDICAMENT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATELIVRAISONMEDICAMENT" class="control-label">DATE DE LA LIVRAISON</label>
							<input type="date" name="DATELIVRAISONMEDICAMENT" id="DATELIVRAISONMEDICAMENT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREENREGLIVRAISONMEDICAMENT" class="control-label">HEURE DE LA LIVRAISON</label>
							<input type="time" name="HEUREENREGLIVRAISONMEDICAMENT" id="HEUREENREGLIVRAISONMEDICAMENT" class="form-control"/>
						</div>
														
						<button type="submit" class="btn btn-primary btn-lg btn-block">ENREGISTRER LA NOUVELLE LIVRAISON DE MEDICAMENT</button><br>
						<a class="btn btn-danger btn-lg btn-block" href="StockPharmacie.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>