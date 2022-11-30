
<?php
	require_once('session.php');
	
	$RefClient = $_GET['REFERENCEMEDICAMENT'];
	
	require_once('connexion.php');
	
	$requete="SELECT * FROM MEDICAMENT WHERE REFERENCEMEDICAMENT = '$RefClient'";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
	
	$requeteFAMILLEMEDICAMENT = "SELECT * FROM FAMILLEMEDICAMENT";
	$resultatFAMILLEMEDICAMENT = $con->query($requeteFAMILLEMEDICAMENT);
		
	$requeteFORMEMEDICAMENT = "SELECT * FROM FORMEMEDICAMENT";
	$resultatFORMEMEDICAMENT = $con->query($requeteFORMEMEDICAMENT);
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations Sur Le Médicament Sélectionné</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations Sur Le Médicament Sélectionné</div>
				<div class="panel-body">
					<form method="post" action="UpdatePharmacie.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="REFERENCEMEDICAMENT" class="control-label" >
								REFERENCE MEDICAMENT = <?php echo $STAGIAIRE['REFERENCEMEDICAMENT']; ?>
							</label>
							<input type="hidden" name="REFERENCEMEDICAMENT" 
									id="REFERENCEMEDICAMENT" class="form-control" 
									value="<?php echo $STAGIAIRE['REFERENCEMEDICAMENT']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="CODEFAMILLEMEDICAMENT" class="control-label">FAMILLE DU MEDICAMENT</label>
							<select name="CODEFAMILLEMEDICAMENT" id="CODEFAMILLEMEDICAMENT" class="form-control">
								<?php while($ListeFAMILLEMEDICAMENT = $resultatFAMILLEMEDICAMENT->fetch()){ ?>
									<option value="<?php echo $ListeFAMILLEMEDICAMENT['CODEFAMILLEMEDICAMENT']?>">
										<?php echo $ListeFAMILLEMEDICAMENT['LIBELLEFAMILLEMEDICAMENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEFORMEMEDICAMENT" class="control-label">FORME DU MEDICAMENT</label>
							<select name="CODEFORMEMEDICAMENT" id="CODEFORMEMEDICAMENT" class="form-control">
								<?php while($ListeFORMEMEDICAMENT = $resultatFORMEMEDICAMENT->fetch()){ ?>
									<option value="<?php echo $ListeFORMEMEDICAMENT['CODEFORMEMEDICAMENT']?>">
										<?php echo $ListeFORMEMEDICAMENT['LIBELLEFORMEMEDICAMENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="LIBELLEMEDICAMENT" class="control-label">LIBELLE DU MEDICAMENT</label>
							<input type="text" name="LIBELLEMEDICAMENT" id="LIBELLEMEDICAMENT" class="form-control"
									value="<?php echo $STAGIAIRE['LIBELLEMEDICAMENT']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="PRIXVENTEMEDICAMENT" class="control-label">PRIX A LA VENTE</label>
							<input type="number" name="PRIXVENTEMEDICAMENT" id="PRIXVENTEMEDICAMENT" class="form-control"
									value="<?php echo $STAGIAIRE['PRIXVENTEMEDICAMENT']; ?>"/>
						</div><hr>
											
						<button type="submit" class="btn btn-warning btn-lg btn-block">VALIDER LES MODIFICATIONS</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeMedicaments.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	