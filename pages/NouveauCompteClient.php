<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteTYPECOMPTE = "SELECT * FROM TYPECOMPTE";
	$resultatTYPECOMPTE = $con->query($requeteTYPECOMPTE);
	
	$requeteCLIENT = "SELECT * FROM CLIENT";
	$resultatCLIENT = $con->query($requeteCLIENT);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Pour Enregistrer Un Nouveau Compte Client</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Pour Enregistrer Un Nouveau Compte Client</div>
				<div class="panel-body">
					<form method="post" action="InsertCompteClient.php" class="form" enctype="multipart/form-data">						
						
						<div class="form-group">
							<label for="NUMEROCOMPTE" class="control-label">NUMERO DU COMPTE</label>
							<input type="text" name="NUMEROCOMPTE" id="NUMEROCOMPTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="CODETYPECOMPTE" class="control-label">LIBELLE TYPE COMPTE</label>
							<select name="CODETYPECOMPTE" id="CODETYPECOMPTE" class="form-control">
								<?php while($filiereTYPECOMPTE = $resultatTYPECOMPTE->fetch()){ ?>
									<option value="<?php echo $filiereTYPECOMPTE['CODETYPECOMPTE']?>">
										<?php echo $filiereTYPECOMPTE['LIBELLETYPECOMPTE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="REFERENCECLIENT" class="control-label">NOM DU CLIENT</label>
							<select name="REFERENCECLIENT" id="REFERENCECLIENT" class="form-control">
								<?php while($filiereCLIENT = $resultatCLIENT->fetch()){ ?>
									<option value="<?php echo $filiereCLIENT['REFERENCECLIENT']?>">
										<?php echo $filiereCLIENT['NOMCLIENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATECREATIONCOMPTE" class="control-label">DATE CREATION DU COMPTE</label>
							<input type="date" name="DATECREATIONCOMPTE" id="DATECREATIONCOMPTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEURECREATIONCOMPTE" class="control-label">HEURE CREATION DU COMPTE</label>
							<input type="time" name="HEURECREATIONCOMPTE" id="HEURECREATIONCOMPTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="SOLDEDEPARTCOMPTE" class="control-label">MONTANT A L'OUVERTURE</label>
							<input type="number" name="SOLDEDEPARTCOMPTE" id="SOLDEDEPARTCOMPTE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="SOLDEACTUELLECOMPTE" class="control-label">MONTANT ACTUEL DU COMPTE</label>
							<input type="number" name="SOLDEACTUELLECOMPTE" id="SOLDEACTUELLECOMPTE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary btn-lg btn-block">VALIDER ENREGISTREMENT DU NOUVEAU COMPTE</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListingComptesClient.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>