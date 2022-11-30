<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteMP="select * from MODEPAIEMENT";
	$resultatMP = $con->query($requeteMP);
	
	$requetePDT="select * from PRODUIT";
	$resultatPDT = $con->query($requetePDT);
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Nouvelle Recette Journalière</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionRecette.JPG">	
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Nouvelle Recette Journalière</div>
				<div class="panel-body">
					<form method="post" action="InsertRecetteJ.php" class="form" enctype="multipart/form-data">
						
						
						<div class="form-group">
							<label for="CODEMODEPAIEMENT" class="control-label">CHOIX DU MODE DE PAIEMENT</label>
							<select name="CODEMODEPAIEMENT" id="CODEMODEPAIEMENT" class="form-control">
								<?php while($filiereMP=$resultatMP->fetch()){ ?>
									<option value="<?php echo $filiereMP['CODEMODEPAIEMENT']?>">
										<?php echo $filiereMP['LIBELLEMODEPAIEMENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="REFERENCEPRODUIT" class="control-label">CHOIX DU PRODUIT A VENDRE</label>
							<select name="REFERENCEPRODUIT" id="REFERENCEPRODUIT" class="form-control">
								<?php while($filierePDT=$resultatPDT->fetch()){ ?>
									<option value="<?php echo $filierePDT['REFERENCEPRODUIT']?>">
										<?php echo $filierePDT['DESIGNATIONPRODUIT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATERECETTE" class="control-label">DATE DE LA RECETTE</label>
							<input type="date" name="DATERECETTE" id="DATERECETTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREENREGRECETTE" class="control-label">HEURE DE LA RECETTE</label>
							<input type="time" name="HEUREENREGRECETTE" id="HEUREENREGRECETTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTERECETTE" class="control-label">QUANTITE DE LA RECETTE</label>
							<input type="number" name="QTERECETTE" id="QTERECETTE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER NOUVELLE RECETTE</button>
						<a class="btn btn-success" href="ListeRecette.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>