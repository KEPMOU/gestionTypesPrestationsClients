<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$requeteel="select * from TYPEMATERIEL";
	$resultatel = $con->query($requeteel);
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire Ajout Nouveau Matériel</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Quincaillerie8.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br>			
			<div class="panel panel-primary">
				<div class="panel-heading">Formulaire Ajout Nouveau Matériel</div>
				<div class="panel-body">
					<form method="post" action="InsertMateriel.php" class="form" enctype="multipart/form-data">
						
						<div class="form-group">
							<label for="REFERENCEMATERIEL" class="control-label">REFERENCE DU MATERIEL</label>
							<input type="text" name="REFERENCEMATERIEL" id="REFERENCEMATERIEL" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="CODETYPEMATERIEL" class="control-label">TYPE DE MATERIEL</label>
							<select name="CODETYPEMATERIEL" id="CODETYPEMATERIEL" class="form-control">
								<?php while($filiere=$resultatel->fetch()){ ?>
									<option value="<?php echo $filiere['CODETYPEMATERIEL']?>">
										<?php echo $filiere['LIBELLETYPEMATERIEL']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DESIGNATIONMATERIEL" class="control-label">DESIGNATION DU MATERIEL</label>
							<input type="text" name="DESIGNATIONMATERIEL" id="DESIGNATIONMATERIEL" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="PRIXUNITAIREMATERIEL" class="control-label">PRIX UNITAIRE MATERIEL</label>
							<input type="number" name="PRIXUNITAIREMATERIEL" id="PRIXUNITAIREMATERIEL" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTESTOCKMATERIEL" class="control-label">STOCK ACTUEL DU MATERIEL</label>
							<input readonly = "readonly"  type="number" name="QTESTOCKMATERIEL" id="QTESTOCKMATERIEL" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTESEUILMATERIEL" class="control-label">SEUIL DE SECURITE DU MATERIEL</label>
							<input readonly = "readonly"  type="number" name="QTESEUILMATERIEL" id="QTESEUILMATERIEL" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="QTEALERTEMATERIEL" class="control-label">QUANTITE ALERTE</label>
							<input readonly = "readonly"  type="number" name="QTEALERTEMATERIEL" id="QTEALERTEMATERIEL" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER ENREGISTEMENT</button><br>
						<a class="btn btn-info btn-lg btn-block" href="ListeStock.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>