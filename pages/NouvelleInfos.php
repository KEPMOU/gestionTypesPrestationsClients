<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteAGT="select * from AGENT";
	$resultatAGT = $con->query($requeteAGT);
	
	$requetVIL="select * from VILLE";
	$resultatVIL = $con->query($requetVIL);
	
	$requetPOS="select * from POSTECOLLECTE";
	$resultatPOS = $con->query($requetPOS);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Collecte d'Informations</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="logoelvire.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle Collecte d'Informations</div>
				<div class="panel-body">
					<form method="post" action="InsertCollecte.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="MATRICULEAGENT" class="control-label">SELECTIONNER L'AGENT COLLECTEUR</label>
							<select name="MATRICULEAGENT" id="MATRICULEAGENT" class="form-control">
								<?php while($filiereAGT=$resultatAGT->fetch()){ ?>
									<option value="<?php echo $filiereAGT['MATRICULEAGENT']?>">
										<?php echo $filiereAGT['NOMAGENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDPOSTECOLLECTE" class="control-label">CHOIX POSTE CONCERNEE</label>
							<select name="IDPOSTECOLLECTE" id="IDPOSTECOLLECTE" class="form-control">
								<?php while($filierePOS=$resultatPOS->fetch()){ ?>
									<option value="<?php echo $filierePOS['IDPOSTECOLLECTE']?>">
										<?php echo $filierePOS['NOMUSERPOSTECOLLECTE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEVILLE" class="control-label">PRECISION DE LA VILLE</label>
							<select name="CODEVILLE" id="CODEVILLE" class="form-control">
								<?php while($filiereVIL=$resultatVIL->fetch()){ ?>
									<option value="<?php echo $filiereVIL['CODEVILLE']?>">
										<?php echo $filiereVIL['NOMVILLE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						
						<div class="form-group">
							<label for="DATECOLLECTE" class="control-label">DATE DE LA COLLECTE</label>
							<input type="date" name="DATECOLLECTE" id="DATECOLLECTE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER LA COLLECTE</button>
						<a class="btn btn-success" href="Inscriptions.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>