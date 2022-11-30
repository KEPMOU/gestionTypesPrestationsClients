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
		<title>Gestion des Présences - Départs du Soir</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Gestion des Présences - Départs du Soir - Pointage Nouveau Départ</div>
				<div class="panel-body">
					<form method="post" action="InsertDepart.php" class="form" enctype="multipart/form-data">
						
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
							<label for="DATEDEPART" class="control-label">DATE POINTAGE DEPART</label>
							<input type="date" name="DATEDEPART" id="DATEDEPART" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREDEPART" class="control-label">HEURE POINTAGE DEPART</label>
							<input type="time" name="HEUREDEPART" id="HEUREDEPART" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER DEPART DU SOIR</button>
						<a class="btn btn-success" href="ListeDepart.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>