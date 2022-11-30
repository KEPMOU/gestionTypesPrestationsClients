
<?php
	require_once('session.php');
	$id=$_GET['IDRECETTE'];
	require_once('connexion.php');
	
	$requete="SELECT * FROM RECETTE WHERE IDRECETTE=$id";
	$resultat = $con->query($requete);
	$STAGIAIRE=$resultat->fetch();
	
	$requeteMODP="SELECT * FROM MODEPAIEMENT";
	$resultatMOD = $con->query($requeteMODP);
	
	$requetePRODUIT="SELECT * FROM PRODUIT";
	$resultatPROD = $con->query($requetePRODUIT);
	
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Modifier Les Informations D'Une Recette</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionRecette.JPG">	
		<div class="container">
			<br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Modifier Les Informations D'Une Recette</div>
				<div class="panel-body">
					<form method="post" action="UpdateRecette.php" class="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="IDRECETTE" class="control-label" >
								ID DE LA RECETTE = <?php echo $STAGIAIRE['IDRECETTE']; ?>
							</label>
							<input type="hidden" name="IDRECETTE" 
									id="IDRECETTE" class="form-control" 
									value="<?php echo $STAGIAIRE['IDRECETTE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="CODEMODEPAIEMENT" class="control-label">MODE DE PAIEMENT</label>
							<select name="CODEMODEPAIEMENT" id="CODEMODEPAIEMENT" class="form-control">
								<?php while($filiereMDP=$resultatMOD->fetch()){ ?>
									<option value="<?php echo $filiereMDP['CODEMODEPAIEMENT']?>" 
										<?php echo $STAGIAIRE['CODEMODEPAIEMENT']==$filiereMDP['CODEMODEPAIEMENT']?"selected":"" ?>>									
										<?php echo $filiereMDP['LIBELLEMODEPAIEMENT']?>
									</option>									
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="REFERENCEPRODUIT" class="control-label">LE PRODUIT CONCERNE</label>
							<select name="REFERENCEPRODUIT" id="REFERENCEPRODUIT" class="form-control">
								<?php while($filierePROD=$resultatPROD->fetch()){ ?>
									<option value="<?php echo $filierePROD['REFERENCEPRODUIT']?>" 
										<?php echo $STAGIAIRE['REFERENCEPRODUIT']==$filierePROD['REFERENCEPRODUIT']?"selected":"" ?>>									
										<?php echo $filierePROD['DESIGNATIONPRODUIT']?>
									</option>									
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="DATERECETTE" class="control-label">DATE DE LA VENTE</label>
							<input type="date" name="DATERECETTE" id="DATERECETTE" class="form-control"
									value="<?php echo $STAGIAIRE['DATERECETTE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="HEUREENREGRECETTE" class="control-label">HEURE DE LA VENTE</label>
							<input type="text" name="HEUREENREGRECETTE" id="HEUREENREGRECETTE" class="form-control"
									value="<?php echo $STAGIAIRE['HEUREENREGRECETTE']; ?>"/>
						</div>
						
						<div class="form-group">
							<label for="QTERECETTE" class="control-label">QUANTITE DE LA VENTE</label>
							<input type="text" name="QTERECETTE" id="QTERECETTE" class="form-control"
									value="<?php echo $STAGIAIRE['QTERECETTE']; ?>"/>
						</div>
						
						
						<button type="submit" class="btn btn-primary">VALIDER LA MODIFICATION</button>
						<a class="btn btn-success" href="ListeRecette.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>										
		</div>
	</body>
</html>	