<?php
	require_once('session.php');
	
	require_once('connexion.php');
	
	$id = $_GET['IDDEMANDECREDIT'];
	
	$user = $_SESSION['utilisateur']['ID'];
	
	$requeteCLIENT="SELECT *
						FROM DEMANDECREDIT D, CLIENT CL, UTILISATEUR U
						WHERE D.REFERENCECLIENT = CL.REFERENCECLIENT
						AND CL.ID = U.ID
						AND U.ID = $user
						AND D.IDDEMANDECREDIT = $id";
						
	$resultatCLIENT = $con->query($requeteCLIENT);
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Ajouter Une Garantie A Ma Demande de Crédit</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		<?php include('entete.php');?>
		<div class="container"><br><br><br>
			
			<div class="panel panel-primary">
				<div class="panel-heading">Ajouter Une Garantie A Ma Demande de Crédit</div>
				<div class="panel-body">
					<form method="post" action="InsertMaGarantie.php" class="form" enctype="multipart/form-data">						
						<div class="form-group">
							<label for="IDDEMANDECREDIT" class="control-label">ID DE LA DEMANDE</label>
							<select name="IDDEMANDECREDIT" id="IDDEMANDECREDIT" class="form-control" readonly="readonly">
								<?php while($filiereCLIENT=$resultatCLIENT->fetch()){ ?>
									<option value="<?php echo $filiereCLIENT['IDDEMANDECREDIT']?>">
										<?php echo $filiereCLIENT['IDDEMANDECREDIT']?>
									</option>
								<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="LIBELLEGARANTIE" class="control-label">LIBELLE DE LA GARANTIE</label>
							<input type="text" name="LIBELLEGARANTIE" id="LIBELLEGARANTIE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="DESCRIPTIONGARANTIE" class="control-label">DESCRIPTION</label>
							<input type="text" name="DESCRIPTIONGARANTIE" id="DESCRIPTIONGARANTIE" class="form-control"/>
						</div>
						
						<div class="form-group">
							<label for="VALEURGARANTIE" class="control-label">VALEUR DE LA GARANTIE</label>
							<input type="number" name="VALEURGARANTIE" id="VALEURGARANTIE" class="form-control"/>
						</div>
												
						<button type="submit" class="btn btn-primary btn-lg btn-block">AJOUTER LA NOUVELLE GARANTIE A CETTE DEMANDE</button><br>
						<a class="btn btn-info btn-lg btn-block" href="MesDemandes.php">ANNULER - RETOUR</a></form>
							
					</form>
				</div>
			</div>
				
		</div>
	</body>
</html>