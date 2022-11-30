
<?php
	require_once('session.php');
	$id=$_GET['IDINSCRIPTION'];
	require_once('connexion.php');
	
	$requete="SELECT * FROM INSCRIPTION WHERE IDINSCRIPTION=$id";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
	
	$requetef="SELECT * FROM ETATINSCRIPTION";
	$resultatf = $con->query($requetef);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire de Traitement de L'Inscription</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Auto3.JPG">		
		<div class="container">
			<br>
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire de Traitement de L'Inscription</div>
				<div class="panel-body">
					<form method="post" action="UpdateTraitement.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="IDINSCRIPTION" class="control-label" >
								ID INSCRIPTION = <?php echo $STAGIAIRE['IDINSCRIPTION']; ?>
							</label>
							<input type="hidden" name="IDINSCRIPTION" 
									IDINSCRIPTION="IDINSCRIPTION" class="form-control" 
									value="<?php echo $STAGIAIRE['IDINSCRIPTION']; ?>"/>
						</div>
						
						<fieldset>
							<legend>Information Sur Le Candidat</legend>
							<div class="form-group">
								<label for="NOMCANDIDATINSCRIPTION" class="control-label">LE NOM DU CANDIDAT INSCRIT</label>
								<input type="text" name="NOMCANDIDATINSCRIPTION" id="NOM" class="form-control"
									value="<?php echo $STAGIAIRE['NOMCANDIDATINSCRIPTION']; ?>" readonly="readonly"/>
							</div>
							
							<div class="form-group">
								<label for="PRENOMCANDIDATINSCRIPTION" class="control-label">LE PRENOM DU CANDIDAT INSCRIT</label>
								<input type="text" name="PRENOMCANDIDATINSCRIPTION" id="NOM" class="form-control"
									value="<?php echo $STAGIAIRE['PRENOMCANDIDATINSCRIPTION']; ?>" readonly="readonly"/>
							</div>
							
							<div class="form-group">
								<label for="NUMCNICANDIDATINSCRIPTION" class="control-label">NUMERO CNI DU CANDIDAT INSCRIT</label>
								<input type="text" name="NUMCNICANDIDATINSCRIPTION" id="NOM" class="form-control"
									value="<?php echo $STAGIAIRE['NUMCNICANDIDATINSCRIPTION']; ?>" readonly="readonly"/>
							</div>
								
						</fieldset>
						
						<fieldset>
							<legend>Etat de La Demande d'Inscription A Une Formation</legend>
						<div class="form-group">
							<label for="IDETATINSCRIPTION" class="control-label">Choisir Etat de L'Inscription</label>
							<select name="IDETATINSCRIPTION" id="IDETATINSCRIPTION" class="form-control">
								<?php while($filiere=$resultatf->fetch()){ ?>
									<option value="<?php echo $filiere['IDETATINSCRIPTION']?>" 
										<?php echo $STAGIAIRE['IDETATINSCRIPTION']==$filiere['IDETATINSCRIPTION']?"selected":"" ?>>									
										<?php echo $filiere['LIBELLEETATINSCRIPTION']?>
									</option>									
								<?php } ?>
							</select>
						</div>
						</fieldset>
							
						<button type="submit" class="btn btn-primary">Valider Le Traitement</button>
						<a class="btn btn-warning" href="ListeInscription.php">Annuler - Retour Liste</a></form>
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>



