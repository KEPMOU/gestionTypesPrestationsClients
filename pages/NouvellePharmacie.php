<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
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
		<title>Enregistrer Une Nouvelle Pharmacie dans La Base de Données</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>
			<div class="panel panel-primary">
				<div class="panel-heading">Enregistrer Une Nouvelle Pharmacie dans La Base de Données</div>
				<div class="panel-body">
					<form method="post" action="InsertPharmacie.php" class="form" enctype="multipart/form-data">						
						
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
							<label for="NOMPHARMACIE" class="control-label">NOM DE LA PHARMACIE</label>
							<input type="text" name="NOMPHARMACIE" id="NOMPHARMACIE" class="form-control"/>
						</div>

						<div class="form-group">
							<label for="LOCALISATIONPHARMACIE" class="control-label">LOCALISATION DE LA PHARMACIE</label>
							<input type="text" name="LOCALISATIONPHARMACIE" id="LOCALISATIONPHARMACIE" class="form-control"/>
						</div>

						<div class="form-group">
							<label for="CONTACTSPHARMACIE" class="control-label">TELEPHONES DE LA PHARMACIE</label>
							<input type="text" name="CONTACTSPHARMACIE" id="CONTACTSPHARMACIE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREOUVRTUREPHARMACIE" class="control-label">HEURE OUVRTURE PHARMACIE</label>
							<input type="time" name="HEUREOUVRTUREPHARMACIE" id="HEUREOUVRTUREPHARMACIE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREFERMETUREPHARMACIE" class="control-label">HEURE FERMETURE PHARMACIE</label>
							<input type="time" name="HEUREFERMETUREPHARMACIE" id="HEUREFERMETUREPHARMACIE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="ID" class="control-label">LOGIN COMPTE UTILISATEUR ASSOCIE</label>
							<select name="ID" id="ID" class="form-control">
								<?php while($ListeUTILISATEUR = $resultatUTILISATEUR->fetch()){ ?>
									<option value="<?php echo $ListeUTILISATEUR['ID']?>">
										<?php echo $ListeUTILISATEUR['LOGIN']?>
									</option>
								<?php } ?>
							</select>
						</div><hr>
						
						<button type="submit" class="btn btn-success btn-lg btn-block">ENREGISTRER LA NOUVELLE PHARMACIE DANS LA BASE DE DONNEES</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListePharmaciesYde.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>