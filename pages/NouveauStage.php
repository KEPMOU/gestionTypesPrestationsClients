<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteSTG="select * from TYPESTAGE";
	$resultatSTG = $con->query($requeteSTG);
	
	$requetTYP="select * from STAGIAIRE";
	$resultatTYP = $con->query($requetTYP);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Enregistrement Nouveau Stage</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Enregistrement Nouveau Stage</div>
				<div class="panel-body">
					<form method="post" action="InsertStage.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="CODETYPESTAGE" class="control-label">SELECTIONNER UN TYPE DE STAGE</label>
							<select name="CODETYPESTAGE" id="CODETYPESTAGE" class="form-control">
								<?php while($filiereAGT=$resultatSTG->fetch()){ ?>
									<option value="<?php echo $filiereAGT['CODETYPESTAGE']?>">
										<?php echo $filiereAGT['LIBELLETYPESTAGE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDSTAGIAIRE" class="control-label">CHOIX DU STAGIAIRE ASSOCIE</label>
							<select name="IDSTAGIAIRE" id="IDSTAGIAIRE" class="form-control">
								<?php while($filierePOS=$resultatTYP->fetch()){ ?>
									<option value="<?php echo $filierePOS['IDSTAGIAIRE']?>">
										<?php echo $filierePOS['NOMSTAGIAIRE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEDEBUTSTAGE" class="control-label">DATE DEBUT DU STAGE</label>
							<input type="date" name="DATEDEBUTSTAGE" id="DATEDEBUTSTAGE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATEFINSTAGE" class="control-label">DATE DE FIN DE STAGE</label>
							<input type="date" name="DATEFINSTAGE" id="DATEFINSTAGE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER L'ENREGISTREMENT DU STAGE</button>
						<a class="btn btn-success" href="ListeStage.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>