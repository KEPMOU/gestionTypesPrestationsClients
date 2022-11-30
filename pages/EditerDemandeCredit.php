
<?php
	require_once('session.php');
	
	$idDemande = $_GET['IDDEMANDECREDIT'];
	
	require_once('connexion.php');
	
	$requete="SELECT * FROM DEMANDECREDIT WHERE IDDEMANDECREDIT = $idDemande";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
	
	$requeteETATDEMANDE = "SELECT * FROM ETATDEMANDE";
	$resultatETATDEMANDE = $con->query($requeteETATDEMANDE);
		
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier La Situation Sur Une Demande de Crédit</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations Sur Une Demande de Crédit</div>
				<div class="panel-body">
					<form method="post" action="UpdateDemandeCredit.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="IDDEMANDECREDIT" class="control-label" >
								ID DE LA DEMANDE DE CREDIT = <?php echo $STAGIAIRE['IDDEMANDECREDIT']; ?>
							</label>
							<input type="hidden" name="IDDEMANDECREDIT" 
									id="IDDEMANDECREDIT" class="form-control" 
									value="<?php echo $STAGIAIRE['IDDEMANDECREDIT']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="CODEETATDEMANDE" class="control-label">LIBELLE ETAT DE LA DEMANDE</label>
							<select name="CODEETATDEMANDE" id="CODEETATDEMANDE" class="form-control">
								<?php while($filiereETATDEMANDE = $resultatETATDEMANDE->fetch()){ ?>
									<option value="<?php echo $filiereETATDEMANDE['CODEETATDEMANDE']?>">
										<?php echo $filiereETATDEMANDE['LIBELLEETATDEMANDE']?>
									</option>
								<?php } ?>
							</select>
						</div>
											
						<button type="submit" class="btn btn-primary btn-lg btn-block">VALIDER LES MODIFICATIONS</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListingDemandes.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	