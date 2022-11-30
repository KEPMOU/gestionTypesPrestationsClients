<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$user = $_SESSION['utilisateur']['ID'];
	
	$requeteCLIENT = "SELECT * FROM CLIENT";
	$resultatCLIENT = $con->query($requeteCLIENT);
	
	$requeteMEDICAMENTINTEGRE = "SELECT * FROM MEDICAMENTINTEGRE WHERE QTESTOCKMEDICAMENTINTEGRE > 0";
	$resultatMEDICAMENTINTEGRE = $con->query($requeteMEDICAMENTINTEGRE);
	
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Noter Une Nouvelle Vente de Médicaments Dans Le Stock de La Pharmarie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?><br><br>
		<div class="container"><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Noter Une Nouvelle Vente de Médicaments Dans Le Stock de La Pharmarie</div>
				<div class="panel-body">
					<form method="post" action="InsertVenteMed.php" class="form" enctype="multipart/form-data">													
						<div class="form-group">
							<label for="REFERENCEINTERNEMEDICAMENTINTEGRE" class="control-label">CHOIX DU MEDICAMENT A VENDRE</label>
							<select name="REFERENCEINTERNEMEDICAMENTINTEGRE" id="REFERENCEINTERNEMEDICAMENTINTEGRE" class="form-control">
								<?php while($filiereMEDICAMENTINTEGRE=$resultatMEDICAMENTINTEGRE->fetch()){ ?>
									<option value="<?php echo $filiereMEDICAMENTINTEGRE['REFERENCEINTERNEMEDICAMENTINTEGRE']?>">
										<?php echo $filiereMEDICAMENTINTEGRE['REFERENCEINTERNEMEDICAMENTINTEGRE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="QTEVENTEMEDICAMENT" class="control-label">QUANTITE DE LA VENTE</label>
							<input type="number" name="QTEVENTEMEDICAMENT" id="QTEVENTEMEDICAMENT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATEVENTEMEDICAMENT" class="control-label">DATE DE LA VENTE</label>
							<input type="date" name="DATEVENTEMEDICAMENT" id="DATEVENTEMEDICAMENT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREENREGVENTEMEDICAMENT" class="control-label">HEURE DE LA VENTE</label>
							<input type="time" name="HEUREENREGVENTEMEDICAMENT" id="HEUREENREGVENTEMEDICAMENT" class="form-control"/>
						</div>
														
						<button type="submit" class="btn btn-primary btn-lg btn-block">ENREGISTRER LA NOUVELLE VENTE DE MEDICAMENT</button><br>
						<a class="btn btn-danger btn-lg btn-block" href="VentesPharmacie.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>