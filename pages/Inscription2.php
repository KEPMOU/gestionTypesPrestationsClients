<?php
	require_once('connexion.php');
	
	$requeteSTG="select * from typepermis";
	$resultatSTG = $con->query($requeteSTG);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Inscription du Candidat A Une Formation</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Auto3.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Inscription du Candidat A Une Formation</div>
				<div class="panel-body">
					<form method="post" action="InsertInscription.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="CODETYPEPERMIS" class="control-label">SELECTIONNER LE TYPE DE PERMIS</label>
							<select name="CODETYPEPERMIS" id="CODETYPEPERMIS" class="form-control">
								<?php while($filiereAGT=$resultatSTG->fetch()){ ?>
									<option value="<?php echo $filiereAGT['CODETYPEPERMIS']?>">
										<?php echo $filiereAGT['LIBELLETYPEPERMIS']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATEINSCRIPTION" class="control-label">DATE INSCRIPTION</label>
							<input type="date" name="DATEINSCRIPTION" id="DATEINSCRIPTION" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREINSCRIPTION" class="control-label">HEURE DE L'INSCRIPTION</label>
							<input type="time" name="HEUREINSCRIPTION" id="HEUREINSCRIPTION" class="form-control"/>
						</div>
						
						<fieldset>
							<legend>Information Sur Le Candidat</legend>
								<div class="form-group">
									<label for="NOMCANDIDATINSCRIPTION" class="control-label">NOM DU CANDIDAT</label>
									<input type="text" name="NOMCANDIDATINSCRIPTION" id="NOMCANDIDATINSCRIPTION" class="form-control"/>
								</div>
								
								<div class="form-group">
									<label for="PRENOMCANDIDATINSCRIPTION" class="control-label">PRENOM DU CANDIDAT</label>
									<input type="text" name="PRENOMCANDIDATINSCRIPTION" id="PRENOMCANDIDATINSCRIPTION" class="form-control"/>
								</div>
								
								<div class="form-group">
									<label for="NUMCNICANDIDATINSCRIPTION" class="control-label">NUMERO DE LA CNI DU CANDIDAT</label>
									<input type="text" name="NUMCNICANDIDATINSCRIPTION" id="NUMCNICANDIDATINSCRIPTION" class="form-control"/>
								</div>
								
								<div class="form-group">
									<label for="TELCANDIDATINSCRIPTION" class="control-label">TELEPHONE DU CANDIDAT</label>
									<input type="text" name="TELCANDIDATINSCRIPTION" id="TELCANDIDATINSCRIPTION" class="form-control"/>
								</div>
								
								<div class="form-group">
									<label for="DATENAISSCANDIDATINSCRIPTION" class="control-label">DATE DE NAISSANCE DU CANDIDAT</label>
									<input type="date" name="DATENAISSCANDIDATINSCRIPTION" id="DATENAISSCANDIDATINSCRIPTION" class="form-control"/>
								</div>
								
								<div class="form-group">
									<label for="LIEUNAISSCANDIDATINSCRIPTION" class="control-label">LIEU DE NAISSANCE DU CANDIDAT</label>
									<input type="text" name="LIEUNAISSCANDIDATINSCRIPTION" id="LIEUNAISSCANDIDATINSCRIPTION" class="form-control"/>
								</div>
								
								<div class="form-group">
									<label for="IMAGEPHOTOCANDIDATINSCRIPTION" class="control-label">IMAGE PHOTO DU CANDIDAT</label>
									<input type="file" name="IMAGEPHOTOCANDIDATINSCRIPTION" id="IMAGEPHOTOCANDIDATINSCRIPTION" class="form-control"/>
								</div>
								
						</fieldset>
					
												
						<button type="submit" class="btn btn-primary">VALIDER VOTRE INSCRIPTION</button>
						<a class="btn btn-success" href="ListeTypeP.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>