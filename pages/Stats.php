<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	$resultatCLIENT = $con->query("SELECT COUNT(*) AS nbreCLIENT FROM CLIENT");
	$nbrCLT = $resultatCLIENT->fetch();
	$NbCLIENT = $nbrCLT['nbreCLIENT'];
	
	$resultatPRESTATION = $con->query("SELECT COUNT(*) AS nbrePRESTATION FROM PRESTATION");
	$nbrPRESTATION = $resultatPRESTATION->fetch();
	$NbPRESTATION = $nbrPRESTATION['nbrePRESTATION'];
	
	$resultatREGLEMENTPRESTATION = $con->query("SELECT COUNT(*) AS nbreREGLEMENTPRESTATION FROM REGLEMENTPRESTATION");
	$nbrREGLEMENTPRESTATION = $resultatREGLEMENTPRESTATION->fetch();
	$NbREGLEMENTPRESTATION = $nbrREGLEMENTPRESTATION['nbreREGLEMENTPRESTATION'];
	
	$resultatTYPEPRESTATION = $con->query("SELECT COUNT(*) AS nbreTYPEPRESTATION FROM TYPEPRESTATION");
	$nbrTYPEPRESTATION = $resultatTYPEPRESTATION->fetch();
	$NbTYPEPRESTATION = $nbrTYPEPRESTATION['nbreTYPEPRESTATION'];
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Affichage des Statistiques</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		 <div id="wrapper">
			<?php include('EnteteUser.php');?>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Affichage des Statistiques</div>
					<div class="panel-body">
						<p><font size="6.5em"> <font weight="5px"><center>Liste des Statistiques de Gestion</p>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
						<center>Liste des Statistiques de Gestion</center>
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>CLIENTS</th>
									<th>PRESTATIONS</th>
									<th>REGLEMENTS</th>
									<th>TYPES PRESTATION</th>
									
								</tr>
							</thead>
							<tbody>
								
									<tr>																		
																					
										<td><?php echo $NbCLIENT ?></td>											
										<td><?php echo $NbPRESTATION ?></td>											
										<td><?php echo $NbREGLEMENTPRESTATION ?></td>											
										<td><?php echo $NbTYPEPRESTATION ?></td>											
																				
									</tr>
								
							</tbody>
						</table>
						<div>																						
								
						</div>
						
					</div>				
				</div>	
				
			</div>
		</div>
	</body>
</html>