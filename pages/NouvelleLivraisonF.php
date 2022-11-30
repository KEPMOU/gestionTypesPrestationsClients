<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteMATERIEL="select * from MATERIEL";
	$resultatMATERIEL = $con->query($requeteMATERIEL);
	
	$requeteFOUR="select * from FOURNISSEUR";
	$resultatFOUR = $con->query($requeteFOUR);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Ajout Nouvelle Livraison Fournisseur</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Quincaillerie8.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Ajout Nouvelle Livraison Fournisseur</div>
				<div class="panel-body">
					<form method="post" action="InsertLivraisonF.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="REFERENCELIVRAISON" class="control-label">REFERENCE DE LA LIVRAISON</label>
							<input type="text" name="REFERENCELIVRAISON" id="REFERENCELIVRAISON" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="REFERENCEMATERIEL" class="control-label">LE MATERIEL CONCERNE</label>
							<select name="REFERENCEMATERIEL" id="REFERENCEMATERIEL" class="form-control">
								<?php while($filiereMAT=$resultatMATERIEL->fetch()){ ?>
									<option value="<?php echo $filiereMAT['REFERENCEMATERIEL']?>">
										<?php echo $filiereMAT['DESIGNATIONMATERIEL']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEFOURNISSEUR" class="control-label">LE FOURNISSEUR ASSOCIE</label>
							<select name="CODEFOURNISSEUR" id="CODEFOURNISSEUR" class="form-control">
								<?php while($filiere=$resultatFOUR->fetch()){ ?>
									<option value="<?php echo $filiere['CODEFOURNISSEUR']?>">
										<?php echo $filiere['NOMFOURNISSEUR']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATELIVRAISON" class="control-label">DATE DE LA LIVRAISON</label>
							<input type="date" name="DATELIVRAISON" id="DATELIVRAISON" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTELIVRAISON" class="control-label">QUANTITE DE LA LIVRAISON</label>
							<input type="number" name="QTELIVRAISON" id="QTELIVRAISON" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTEMENT</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeLivraisonsF.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>