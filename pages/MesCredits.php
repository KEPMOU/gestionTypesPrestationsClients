<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	$user = $_SESSION['utilisateur']['ID'];
	
	
	$resultat = $con->query("SELECT DISTINCT CR.REFERENCECREDIT, DC.IDDEMANDECREDIT, CR.DATEOBTENTIONCREDIT, DC.MONTANTDEMANDECREDIT, CR.MONTANTCREDIT
								FROM CREDIT CR, DEMANDECREDIT DC, CLIENT CL, UTILISATEUR U
								WHERE CR.IDDEMANDECREDIT = DC.IDDEMANDECREDIT
								AND DC.REFERENCECLIENT = CL.REFERENCECLIENT
								GROUP BY DC.IDDEMANDECREDIT
								AND CL.ID = U.ID
								AND U.ID = $user
								ORDER BY CR.REFERENCECREDIT");
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Listing de Mes Crédits</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="cca_bank1.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Listing de Mes Crédits</div>
					<div class="panel-body">
						<form method="get" action="MesCredits.php" class="form-inline">
							<div class="form-group">						
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">Page Listing de Mes Crédits</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>REFERENCE</th>
									<th>ID DEMANDE</th>
									<th>DATE OBTENTION</th>
									<th>MONTANT DEMANDE</th>
									<th>MONTANT ACCORDE</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['IDDEMANDECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['DATEOBTENTIONCREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['MONTANTDEMANDECREDIT'] ?></td>
										<td><?php echo $STAGIAIRE['MONTANTCREDIT'] ?></td>	
									</tr>
								<?php } ?>
							</tbody>
						</table>						
					</div>				
				</div>	
				
			</div>
		</div>
	</body>
</html>