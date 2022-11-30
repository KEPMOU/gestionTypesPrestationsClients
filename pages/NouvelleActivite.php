<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requetPOS="select * from STAGIAIRE";
	$resultatPOS = $con->query($requetPOS);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouvelle Activité du Stagiaire</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Nouvelle Activité du Stagiaire</div>
				<div class="panel-body">
					<form method="post" action="InsertActivite.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="IDSTAGIAIRE" class="control-label">CHOIX DU STAGIAIRE</label>
							<select name="IDSTAGIAIRE" id="IDSTAGIAIRE" class="form-control">
								<?php while($filierePOS=$resultatPOS->fetch()){ ?>
									<option value="<?php echo $filierePOS['IDSTAGIAIRE']?>">
										<?php echo $filierePOS['NOMSTAGIAIRE']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						
						<div class="form-group">
							<label for="LIBELLEACTIVITE" class="control-label">LIBELLE DE L'ACTIVITE</label>
							<input type="text" name="LIBELLEACTIVITE" id="LIBELLEACTIVITE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DESCRIPTIONACTIVITE" class="control-label">DESCRIPTION DE L'ACTIVITE</label>
							<input type="text" name="DESCRIPTIONACTIVITE" id="DESCRIPTIONACTIVITE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DATEACTIVITE" class="control-label">DATEA DE L'ACTIVITE</label>
							<input type="date" name="DATEACTIVITE" id="DATEACTIVITE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER L'ENCADREMENT</button>
						<a class="btn btn-success" href="ListeActivites.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>