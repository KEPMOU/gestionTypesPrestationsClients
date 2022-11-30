<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	$user = $_SESSION['utilisateur']['ID'];
	
	$iddemande = $_GET['IDDEMANDECREDIT'];
	
	
		$resultat = $con->query("SELECT G.IDGARANTIE, D.IDDEMANDECREDIT, G.LIBELLEGARANTIE, G.VALEURGARANTIE
								FROM GARANTIE G, DEMANDECREDIT D, CLIENT CL, UTILISATEUR U
								WHERE G.IDDEMANDECREDIT = D.IDDEMANDECREDIT
								AND D.REFERENCECLIENT = CL.REFERENCECLIENT
								AND CL.ID = U.ID
								AND U.ID = $user
								AND G.IDDEMANDECREDIT = $iddemande
								ORDER BY D.IDDEMANDECREDIT");
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Liste des Garanties de La Demande de Crédit</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Liste des Garanties de La Demande de Crédit</div>
					<div class="panel-body">
						<form method="get" action="MesGaranties.php" class="form-inline">
							<div class="form-group">						
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Garanties de La Demande de Crédit Numéro = <?php echo $iddemande ?> 
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>N° de La Demande</th>
									<th>Libellé de La Garantie</th>
									<th>Valeur de La Garantie</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDGARANTIE'] ?></td>
										<td><?php echo $STAGIAIRE['IDDEMANDECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEGARANTIE'] ?></td>
										<td><?php echo $STAGIAIRE['VALEURGARANTIE'] ?></td>	
									</tr>
								<?php } ?>
							</tbody>
						</table>						
					</div>
					
				</div>	
				<a class="btn btn-info btn-lg btn-block" href="MesDemandes.php">ANNULER - RETOUR</a>
			</div>
		</div>
	</body>
</html>