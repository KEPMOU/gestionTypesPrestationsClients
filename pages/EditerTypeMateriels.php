
<?php
	require_once('session.php');
	$id=$_GET['CODETYPEMATERIEL'];
	require_once('connexion.php');
	
	$requete="SELECT * FROM TYPEMATERIEL WHERE CODETYPEMATERIEL='$id'";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations Un Type de Matériel</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Quincaillerie8.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br><br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations Un Type de Matériel</div>
				<div class="panel-body">
					<form method="post" action="UpdateTypeMateriels.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="CODETYPEMATERIEL" class="control-label" >
								CODE TYPE MATERIEL = <?php echo $STAGIAIRE['CODETYPEMATERIEL']; ?>
							</label>
							<input type="hidden" name="CODETYPEMATERIEL" 
									id="CODETYPEMATERIEL" class="form-control" 
									value="<?php echo $STAGIAIRE['CODETYPEMATERIEL']; ?>"/>
						</div>						
						
						<div class="form-group">
							<label for="LIBELLETYPEMATERIEL" class="control-label">LIBELLE TYPE MATERIEL</label>
							<input type="text" name="LIBELLETYPEMATERIEL" id="LIBELLETYPEMATERIEL" class="form-control"
									value="<?php echo $STAGIAIRE['LIBELLETYPEMATERIEL']; ?>"/>
						</div>
										
						<button type="submit" class="btn btn-success btn-lg btn-block">VALIDER LA MODIFICATION</button><hr>
						<a class="btn btn-info btn-lg btn-block" href="ListeTypeMateriels.php">ANNULER - RETOUR</a>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	