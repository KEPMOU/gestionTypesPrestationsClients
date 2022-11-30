<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteAGT="select * from ENCADREUR";
	$resultatAGT = $con->query($requeteAGT);
	
	$requetPOS="select * from STAGIAIRE";
	$resultatPOS = $con->query($requetPOS);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Affectation Encadrement</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle Affectation Encadrement</div>
				<div class="panel-body">
					<form method="post" action="InsertAffectation.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="MATRICULEENCADREUR" class="control-label">SELECTIONNER ENCADREUR</label>
							<select name="MATRICULEENCADREUR" id="MATRICULEENCADREUR" class="form-control">
								<?php while($filiereAGT=$resultatAGT->fetch()){ ?>
									<option value="<?php echo $filiereAGT['MATRICULEENCADREUR']?>">
										<?php echo $filiereAGT['NOMENCADREUR']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="IDSTAGIAIRE" class="control-label">CHOIX DU STAGIAIRE</label>
							<select name="IDSTAGIAIRE" id="IDSTAGIAIRE" class="form-control">
								<?php while($filierePOS=$resultatPOS->fetch()){ ?>
									<option value="<?php echo $filierePOS['IDSTAGIAIRE']?>">
										<?php echo $filierePOS['NOMSTAGIAIRE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						
						<div class="form-group">
							<label for="DATEAFFECTATION" class="control-label">DATE ENREGISTREMENT</label>
							<input type="date" name="DATEAFFECTATION" id="DATEAFFECTATION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREAFFECTATION" class="control-label">HEURE ENREGISTREMENT</label>
							<input type="time" name="HEUREAFFECTATION" id="HEUREAFFECTATION" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER L'ENCADREMENT</button>
						<a class="btn btn-success" href="ListeEncadrement.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>