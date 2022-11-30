<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteel="select * from TRANCHEPENSION";
	$resultatel = $con->query($requeteel);
	
	$requetcl="select * from ELEVE";
	$resultatcl = $con->query($requetcl);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Règlement Frais Scolarité</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img08.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Règlement Frais Scolarité</div>
				<div class="panel-body">
					<form method="post" action="InsertReg.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="MATRICULEELEVE" class="control-label">ELEVE CONCERNE</label>
							<select name="MATRICULEELEVE" id="MATRICULEELEVE" class="form-control">
								<?php while($filiere=$resultatcl->fetch()){ ?>
									<option value="<?php echo $filiere['MATRICULEELEVE']?>">
										<?php echo $filiere['NOMELEVE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODETRANCHEPENSION" class="control-label">CHOIX DE LA TRANCHE SCOLAIRE</label>
							<select name="CODETRANCHEPENSION" id="CODETRANCHEPENSION" class="form-control">
								<?php while($filiere=$resultatel->fetch()){ ?>
									<option value="<?php echo $filiere['CODETRANCHEPENSION']?>">
										<?php echo $filiere['LIBELLETRANCHEPENSION']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEREGLEMENT" class="control-label">DATE DE REGLEMENT</label>
							<input type="date" name="DATEREGLEMENT" id="DATEREGLEMENT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREREGLEMENT" class="control-label">HEURE DU REGLEMENT</label>
							<input type="time" name="HEUREREGLEMENT" id="HEUREREGLEMENT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="MONTANTREGLEMENT" class="control-label">MONTANT DU REGLEMENT</label>
							<input type="number" name="MONTANTREGLEMENT" id="MONTANTREGLEMENT" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER ENREGISTREMENT DU REGLEMENT</button>
						<a class="btn btn-success" href="Inscriptions.php">ANNULER - RETOUR LISTING REGLEMENT</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>