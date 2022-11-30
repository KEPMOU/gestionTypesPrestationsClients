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
		<title>Gestion des Présences - Arrivées du Matin</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">		
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Gestion des Présences - Arrivées du Matin - Pointage Nouvelle Arrivée</div>
				<div class="panel-body">
					<form method="post" action="InsertArrivee.php" class="form" enctype="multipart/form-data">
						
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
							<label for="DATEARRIVEE" class="control-label">DATE POINTAGE ARRIVEE</label>
							<input type="date" name="DATEARRIVEE" id="DATEARRIVEE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREARRIVEE" class="control-label">HEURE POINTAGE ARRIVEE</label>
							<input type="time" name="HEUREARRIVEE" id="HEUREARRIVEE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary">VALIDER ARRIVEE DU MATIN</button>
						<a class="btn btn-success" href="ListeArrive.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>