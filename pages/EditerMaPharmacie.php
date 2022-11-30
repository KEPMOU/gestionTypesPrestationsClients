
<?php
	require_once('session.php');
	
	$user = $_SESSION['utilisateur']['ID'];
	
	$idPharmac = $_GET['REFERENCEPHARMACIE'];
	
	require_once('connexion.php');
	
	$requete="SELECT P.REFERENCEPHARMACIE, Q.NOMQUARTIER, P.NOMPHARMACIE, P.LOCALISATIONPHARMACIE, P.CONTACTSPHARMACIE, P.HEUREOUVRTUREPHARMACIE, P.HEUREFERMETUREPHARMACIE
								FROM UTILISATEUR U, PHARMACIE P, QUARTIER Q
								WHERE Q.IDQUARTIER = P.IDQUARTIER
								AND P.ID = U.ID
								AND U.ID = $user
								AND P.REFERENCEPHARMACIE = '$idPharmac'";
								
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
	
	$requeteQUARTIER = "SELECT * FROM QUARTIER";
	$resultatQUARTIER = $con->query($requeteQUARTIER);
		
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations Sur Ma Pharmacie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations Sur Ma Pharmacie</div>
				<div class="panel-body">
					<form method="post" action="UpdateMaPharmacie.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="REFERENCEPHARMACIE" class="control-label" >
								REFERENCE PHARMACIE = <?php echo $STAGIAIRE['REFERENCEPHARMACIE']; ?>
							</label>
							<input type="hidden" name="REFERENCEPHARMACIE" 
									id="REFERENCEPHARMACIE" class="form-control" 
									value="<?php echo $STAGIAIRE['REFERENCEPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="ID" class="control-label" >
								ID COMPTE UTILISATEUR = <?php echo $_SESSION['utilisateur']['ID']; ?>
							</label>
							<input type="hidden" name="ID" 
									id="ID" class="form-control" 
									value="<?php echo user; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="IDQUARTIER" class="control-label">QUARTIER DE LOCALISATION</label>
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
							<input type="text" name="NOMPHARMACIE" id="NOMPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['NOMPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="LOCALISATIONPHARMACIE" class="control-label">LOCALISATION DE LA PHARMACIE</label>
							<input type="text" name="LOCALISATIONPHARMACIE" id="NOMPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['LOCALISATIONPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="CONTACTSPHARMACIE" class="control-label">CONTACTS TELEPHONES DE LA PHARMACIE</label>
							<input type="text" name="CONTACTSPHARMACIE" id="CONTACTSPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['CONTACTSPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREOUVRTUREPHARMACIE" class="control-label">HEURE OUVRTURE DE LA PHARMACIE</label>
							<input type="time" name="HEUREOUVRTUREPHARMACIE" id="HEUREOUVRTUREPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['HEUREOUVRTUREPHARMACIE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREFERMETUREPHARMACIE" class="control-label">HEURE FERMETURE DE LA PHARMACIE</label>
							<input type="time" name="HEUREFERMETUREPHARMACIE" id="HEUREFERMETUREPHARMACIE" class="form-control"
									value="<?php echo $STAGIAIRE['HEUREFERMETUREPHARMACIE']; ?>"/>
						</div>
											
						<button type="submit" class="btn btn-primary btn-lg btn-block">VALIDER LES MODIFICATIONS</button><br>
						<a class="btn btn-danger btn-lg btn-block" href="MaPharmacie.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	