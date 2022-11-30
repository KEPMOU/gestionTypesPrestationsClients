<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$RequeteETUDIANT = "SELECT * FROM ETUDIANT";
	$ResultatETUDIANT = $con->query($RequeteETUDIANT);
	
	$RequeteUNITEENSEIGNEMENT = "SELECT * FROM UNITEENSEIGNEMENT";
	$ResultatUNITEENSEIGNEMENT = $con->query($RequeteUNITEENSEIGNEMENT);
	
	$RequeteEVALUATION = "SELECT * FROM EVALUATION";
	$ResultatEVALUATION = $con->query($RequeteEVALUATION);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Enregistrer Nouvelle Note</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		<?php include('EnteteUser.php');?>
		<div class="container"><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Enregistrer Une Nouvelle Note Pour L'UE En Relation Avec L'Evaluation</div>
				<div class="panel-body">
					<form method="post" action="InsertNoteEtd.php" class="form" enctype="multipart/form-data">
												
						<div class="form-group">
							<label for="MATRICULEETUDIANT" class="control-label">SELECTION ETUDIANT</label>
							<select name="MATRICULEETUDIANT" id="MATRICULEETUDIANT" class="form-control">
								<?php while($ListeETUDIANT = $ResultatETUDIANT->fetch()){ ?>
									<option value="<?php echo $ListeETUDIANT['MATRICULEETUDIANT']?>">
										<?php echo $ListeETUDIANT['NOMPRENOMETUDIANT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEUNITEENSEIGNEMENT" class="control-label">SELECTION UNITE ENSEIGNEMENT</label>
							<select name="CODEUNITEENSEIGNEMENT" id="CODEUNITEENSEIGNEMENT" class="form-control">
								<?php while($ListeUNITEENSEIGNEMENT = $ResultatUNITEENSEIGNEMENT->fetch()){ ?>
									<option value="<?php echo $ListeUNITEENSEIGNEMENT['CODEUNITEENSEIGNEMENT']?>">
										<?php echo $ListeUNITEENSEIGNEMENT['LIBELLEUNITEENSEIGNEMENT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="REFERENCEEVALUATION" class="control-label">SELECTION EVALUATION</label>
							<select name="REFERENCEEVALUATION" id="REFERENCEEVALUATION" class="form-control">
								<?php while($ListeEVALUATION = $ResultatEVALUATION->fetch()){ ?>
									<option value="<?php echo $ListeEVALUATION['REFERENCEEVALUATION']?>">
										<?php echo $ListeEVALUATION['LIBELLEEVALUATION']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="NOTEEVALUATIONETUDIANT" class="control-label">NOTE EVALUATION ETUDIANT</label>
							<input type="number" name="NOTEEVALUATIONETUDIANT" id="NOTEEVALUATIONETUDIANT" class="form-control"/>
						</div><hr>
												
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTEMENT NOTES ETUDIANT</button><br>
						<a class="btn btn-danger btn-lg btn-block" href="ListingNotes.php">ANNULER - RETOUR SUR LA LISTE DES NOTES</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>