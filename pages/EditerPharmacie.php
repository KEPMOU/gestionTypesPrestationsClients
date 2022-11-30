
<?php
	require_once('session.php');
	
	$RefClient = $_GET['REFERENCEPHARMACIE'];
	
	require_once('connexion.php');
	
	$requete="SELECT * FROM PHARMACIE WHERE REFERENCEPHARMACIE = '$RefClient'";
	$resultat = $con->query($requete);
	
	
	$STAGIAIRE=$resultat->fetch();
	
	$requeteUTILISATEUR = "SELECT *
						FROM UTILISATEUR
						WHERE ID <> 1
						AND ID NOT IN (SELECT UT.ID
											FROM PHARMACIE PH, UTILISATEUR UT
											WHERE PH.ID = UT.ID)";
						
	$resultatUTILISATEUR = $con->query($requeteUTILISATEUR);
	
	$requeteQUARTIER = "SELECT * FROM QUARTIER";
	$resultatQUARTIER = $con->query($requeteQUARTIER);
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations de La Pharmacie Sélectionnée</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations de La Pharmacie Sélectionnée</div>
				<div class="panel-body">
					<form method="post" action="UpdatePharmacie.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="REFERENCEPHARMACIE" class="control-label" >
								REFERENCE DE LA PHARMACIE = <?php echo $STAGIAIRE['REFERENCEPHARMACIE']; ?>
							</label>
							<input type="hidden" name="REFERENCEPHARMACIE" 
									id="REFERENCEPHARMACIE" class="form-control" 
									value="<?php echo $STAGIAIRE['REFERENCEPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="IDQUARTIER" class="control-label">LOCALISATION DE LA PHARMACIE</label>
							<select name="IDQUARTIER" id="IDQUARTIER" class="form-control">
								<?php while($filiereQUARTIER = $resultatQUARTIER->fetch()){ ?>
									<option value="<?php echo $filiereQUARTIER['IDQUARTIER']?>">
										<?php echo $filiereQUARTIER['NOMQUARTIER']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="NOMPHARMACIE" class="control-label">NOM PHARMACIE</label>
							<input type="text" name="NOMPHARMACIE" id="NOMPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['NOMPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="LOCALISATIONPHARMACIE" class="control-label">LOCALISATION PHARMACIE</label>
							<input type="text" name="LOCALISATIONPHARMACIE" id="LOCALISATIONPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['LOCALISATIONPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="CONTACTSPHARMACIE" class="control-label">TELEPHONES PHARMACIE</label>
							<input type="text" name="CONTACTSPHARMACIE" id="CONTACTSPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['CONTACTSPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREOUVRTUREPHARMACIE" class="control-label">HEURE OUVRTURE PHARMACIE</label>
							<input type="time" name="HEUREOUVRTUREPHARMACIE" id="HEUREOUVRTUREPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['HEUREOUVRTUREPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREFERMETUREPHARMACIE" class="control-label">HEURE FERMETURE PHARMACIE</label>
							<input type="time" name="HEUREFERMETUREPHARMACIE" id="HEUREFERMETUREPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['HEUREFERMETUREPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="ID" class="control-label">ID COMPTE UTILISATEUR</label>
							<input type="text" name="ID" id="ID" class="form-control" readonly="readonly"
									value="<?php echo $STAGIAIRE['ID']; ?>"/>
						</div>
											
						<button type="submit" class="btn btn-warning btn-lg btn-block">VALIDER LES MODIFICATIONS</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListePharmaciesYde.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	