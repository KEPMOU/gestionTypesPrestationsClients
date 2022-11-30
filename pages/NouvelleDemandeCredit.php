<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteCLIENT="select * from CLIENT";
	$resultatCLIENT = $con->query($requeteCLIENT);
	
	$requeteTYPECREDIT="select * from TYPECREDIT";
	$resultatTYPECREDIT = $con->query($requeteTYPECREDIT);
	
	$requeteETATDEMANDE="select * from ETATDEMANDE WHERE CODEETATDEMANDE = 'ED01'";
	$resultatETATDEMANDE = $con->query($requeteETATDEMANDE);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Pour Envoyer Ma Demande de Crédit</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Pour Envoyer Ma Demande de Crédit</div>
				<div class="panel-body">
					<form method="post" action="InsertDemandeCredit.php" class="form" enctype="multipart/form-data">						
						<div class="form-group">
							<label for="REFERENCECLIENT" class="control-label">LE CLIENT ASSOCIE</label>
							<select name="REFERENCECLIENT" id="REFERENCECLIENT" class="form-control" readonly="readonly">
								<?php while($filiereCLIENT=$resultatCLIENT->fetch()){ ?>
									<option value="<?php echo $filiereCLIENT['REFERENCECLIENT']?>">
										<?php echo $filiereCLIENT['NOMCLIENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODETYPECREDIT" class="control-label">LE TYPE DE CREDIT CONCERNE</label>
							<select name="CODETYPECREDIT" id="CODETYPECREDIT" class="form-control">
								<?php while($filiereTYPECREDIT=$resultatTYPECREDIT->fetch()){ ?>
									<option value="<?php echo $filiereTYPECREDIT['CODETYPECREDIT']?>">
										<?php echo $filiereTYPECREDIT['LIBELLETYPECREDIT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEETATDEMANDE" class="control-label">SITUATION DE LA DEMANDE</label>
							<select name="CODEETATDEMANDE" id="CODEETATDEMANDE" class="form-control" readonly="readonly">
								<?php while($filiereETATDEMANDE=$resultatETATDEMANDE->fetch()){ ?>
									<option value="<?php echo $filiereETATDEMANDE['CODEETATDEMANDE']?>">
										<?php echo $filiereETATDEMANDE['LIBELLEETATDEMANDE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEDEMANDECREDIT" class="control-label">DATE DEMANDE CREDIT</label>
							<input type="date" name="DATEDEMANDECREDIT" id="DATEDEMANDECREDIT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREDEMANDECREDIT" class="control-label">HEURE ENVOIE</label>
							<input type="time" name="HEUREDEMANDECREDIT" id="HEUREDEMANDECREDIT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="MONTANTDEMANDECREDIT" class="control-label">MONTANT SOLLICITE</label>
							<input type="number" name="MONTANTDEMANDECREDIT" id="MONTANTDEMANDECREDIT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="COMMENTAIREDEMANDECREDIT" class="control-label">COMMENTAIRE</label>
							<input type="text" name="COMMENTAIREDEMANDECREDIT" id="COMMENTAIREDEMANDECREDIT" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary btn-lg btn-block">VALIDER ENVOIE DEMANDE CREDIT</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeDemandesClient.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>