<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteDEMANDECREDIT="select * from DEMANDECREDIT";
	$resultatDEMANDECREDIT = $con->query($requeteDEMANDECREDIT);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Pour Enregistrer Un Nouveau Crédit</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Pour Enregistrer Un Nouveau Crédit</div>
				<div class="panel-body">
					<form method="post" action="InsertCredit.php" class="form" enctype="multipart/form-data">						
						<div class="form-group">
							<label for="IDDEMANDECREDIT" class="control-label">LA DEMANDE ASSOCIEE</label>
							<select name="IDDEMANDECREDIT" id="IDDEMANDECREDIT" class="form-control">
								<?php while($filiereCLIENT=$resultatDEMANDECREDIT->fetch()){ ?>
									<option value="<?php echo $filiereCLIENT['IDDEMANDECREDIT']?>">
										<?php echo $filiereCLIENT['IDDEMANDECREDIT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEOBTENTIONCREDIT" class="control-label">DATE OBTENTION DU CREDIT</label>
							<input type="date" name="DATEOBTENTIONCREDIT" id="DATEOBTENTIONCREDIT" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="MONTANTCREDIT" class="control-label">MONTANT OBTENUE POUR LE CREDIT</label>
							<input type="number" name="MONTANTCREDIT" id="MONTANTCREDIT" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary btn-lg btn-block">VALIDER ENREGISTREMENT DU NOUVEAU CREDIT</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListingCredits.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>