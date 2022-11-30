<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteFAMILLEMEDICAMENT = "SELECT * FROM FAMILLEMEDICAMENT";
	$resultatFAMILLEMEDICAMENT = $con->query($requeteFAMILLEMEDICAMENT);
		
	$requeteFORMEMEDICAMENT = "SELECT * FROM FORMEMEDICAMENT";
	$resultatFORMEMEDICAMENT = $con->query($requeteFORMEMEDICAMENT);
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Enregistrer Un Nouveau Médicament dans La Base de Données</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Enregistrer Un Nouveau Médicament dans La Base de Données</div>
				<div class="panel-body">
					<form method="post" action="InsertMedicament.php" class="form" enctype="multipart/form-data">						
						
						<div class="form-group">
							<label for="CODEFAMILLEMEDICAMENT" class="control-label">LIBELLE FAMILLE MEDICAMENT</label>
							<select name="CODEFAMILLEMEDICAMENT" id="CODEFAMILLEMEDICAMENT" class="form-control">
								<?php while($ListeFAMILLEMEDICAMENT = $resultatFAMILLEMEDICAMENT->fetch()){ ?>
									<option value="<?php echo $ListeFAMILLEMEDICAMENT['CODEFAMILLEMEDICAMENT']?>">
										<?php echo $ListeFAMILLEMEDICAMENT['LIBELLEFAMILLEMEDICAMENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEFORMEMEDICAMENT" class="control-label">LIBELLE FORME MEDICAMENT</label>
							<select name="CODEFORMEMEDICAMENT" id="CODEFORMEMEDICAMENT" class="form-control">
								<?php while($ListeFORMEMEDICAMENT = $resultatFORMEMEDICAMENT->fetch()){ ?>
									<option value="<?php echo $ListeFORMEMEDICAMENT['CODEFORMEMEDICAMENT']?>">
										<?php echo $ListeFORMEMEDICAMENT['LIBELLEFORMEMEDICAMENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						
						<div class="form-group">
							<label for="LIBELLEMEDICAMENT" class="control-label">LIBELLE MEDICAMENT</label>
							<input type="text" name="LIBELLEMEDICAMENT" id="LIBELLEMEDICAMENT" class="form-control"/>
						</div>

						<div class="form-group">
							<label for="PRIXVENTEMEDICAMENT" class="control-label">PRIX VENTE MEDICAMENT</label>
							<input type="number" name="PRIXVENTEMEDICAMENT" id="PRIXVENTEMEDICAMENT" class="form-control"/>
						</div><hr>
						
						<button type="submit" class="btn btn-success btn-lg btn-block">ENREGISTRER LE MEDICAMENT DANS LA BASE DE DONNEES</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeMedicaments.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>