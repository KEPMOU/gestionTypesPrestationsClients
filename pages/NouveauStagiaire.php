<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteGENRE="select * from GENRE";
	$resultatGENRE = $con->query($requeteGENRE);
	
	$requetFORMATION="select * from FORMATION";
	$resultatFORMATION = $con->query($requetFORMATION);
	
	$requetSTATUT="select * from STATUT";
	$resultatSTATUT = $con->query($requetSTATUT);
	
	$requetDIPLOME="select * from DIPLOME";
	$resultatDIPLOME = $con->query($requetDIPLOME);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Enregistrement Nouveau Stagiaire</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Enregistrement Nouveau Stagiaire</div>
				<div class="panel-body">
					<form method="post" action="InserStagiaire.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="CODEGENRE" class="control-label">CIVILITE STAGIAIRE</label>
							<select name="CODEGENRE" id="CODEGENRE" class="form-control">
								<?php while($filiereG=$resultatGENRE->fetch()){ ?>
									<option value="<?php echo $filiereG['CODEGENRE']?>">
										<?php echo $filiereG['LIBELLEGENRE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODESTATUT" class="control-label">CHOIX DU STATUT</label>
							<select name="CODESTATUT" id="CODESTATUT" class="form-control">
								<?php while($filiereSTATUT=$resultatSTATUT->fetch()){ ?>
									<option value="<?php echo $filiereSTATUT['CODESTATUT']?>">
										<?php echo $filiereSTATUT['LIBELLESTATUT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEFORMATION" class="control-label">CHOIX DE LA FORMATION</label>
							<select name="CODEFORMATION" id="CODEFORMATION" class="form-control">
								<?php while($filiereFORM=$resultatFORMATION->fetch()){ ?>
									<option value="<?php echo $filiereFORM['CODEFORMATION']?>">
										<?php echo $filiereFORM['LIBELLEFORMATION']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="CODEDIPLOME" class="control-label">LIBELLE FORMATION</label>
							<select name="CODEDIPLOME" id="CODEDIPLOME" class="form-control">
								<?php while($filiereDIPL=$resultatDIPLOME->fetch()){ ?>
									<option value="<?php echo $filiereDIPL['CODEDIPLOME']?>">
										<?php echo $filiereDIPL['LIBELLEDIPLOME']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						
						<div class="form-group">
							<label for="NOMSTAGIAIRE" class="control-label">NOM DU STAGIAIRE</label>
							<input type="text" name="NOMSTAGIAIRE" id="NOMSTAGIAIRE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="PRENOMSTAGIAIRE" class="control-label">PRENOM DU STAGIAIRE</label>
							<input type="text" name="PRENOMSTAGIAIRE" id="PRENOMSTAGIAIRE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATENAISSSTAGIAIRE" class="control-label">DATE DE NAISSSANCE</label>
							<input type="date" name="DATENAISSSTAGIAIRE" id="DATENAISSSTAGIAIRE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="TELSTAGIAIRE" class="control-label">TELEPHONE</label>
							<input type="text" name="TELSTAGIAIRE" id="TELSTAGIAIRE" class="form-control"/>
						</div>
						
						
												
						<button type="submit" class="btn btn-primary">VALIDER ENREGISTREMENT</button>
						<a class="btn btn-success" href="ListeStagiaire.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>