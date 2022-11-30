<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requetePROD="select * from PRODUIT";
	$resultatPROD = $con->query($requetePROD);
	
	$requeteCLIENT="select * from CLIENT";
	$resultatCLIENT = $con->query($requeteCLIENT);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Ajout Nouvelle Vente de Produit</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body style="background-color:#1c87c9;">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Ajout Nouvelle Vente de Produit</div>
				<div class="panel-body">
					<form method="post" action="InsertVente.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="REFERENCEPRODUIT" class="control-label">LE PRODUIT CONCERNE</label>
							<select name="REFERENCEPRODUIT" id="REFERENCEPRODUIT" class="form-control">
								<?php while($filierePRODUIT=$resultatPROD->fetch()){ ?>
									<option value="<?php echo $filierePRODUIT['REFERENCEPRODUIT']?>">
										<?php echo $filierePRODUIT['LIBELLEPRODUIT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDCLIENT" class="control-label">LE CLIENT ASSOCIE</label>
							<select name="IDCLIENT" id="IDCLIENT" class="form-control">
								<?php while($filiereCLIENT=$resultatCLIENT->fetch()){ ?>
									<option value="<?php echo $filiereCLIENT['IDCLIENT']?>">
										<?php echo $filiereCLIENT['NOMCLIENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEVENTE" class="control-label">DATE DE LA VENTE</label>
							<input type="date" name="DATEVENTE" id="DATEVENTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREVENTE" class="control-label">HEURE DE LA VENTE</label>
							<input type="time" name="HEUREVENTE" id="HEUREVENTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTEVENTE" class="control-label">QUANTITE DE LA VENTE</label>
							<input type="number" name="QTEVENTE" id="QTEVENTE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER AJOUT VENTE</button>
						<a class="btn btn-success" href="ListeVentes.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>