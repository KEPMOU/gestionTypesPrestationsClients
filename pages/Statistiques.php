<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	$resultatCATEGORIEPRODUIT = $con->query("SELECT COUNT(*) AS nbrCATEGORIEPRODUIT FROM CATEGORIEPRODUIT");
	$nbrCAT=$resultatCATEGORIEPRODUIT->fetch();
	$nbrCATE=$nbrCAT['nbrCATEGORIEPRODUIT'];
	
	$resultatPRODUIT = $con->query("SELECT COUNT(*) AS nbrPRODUIT FROM PRODUIT");
	$nbrPROD=$resultatPRODUIT->fetch();
	$nbrPDT=$nbrPROD['nbrPRODUIT'];
	
	$resultatRECETTE = $con->query("SELECT COUNT(*) AS nbrRECETTE FROM RECETTE");
	$nbrREC=$resultatRECETTE->fetch();
	$nbrRECETT=$nbrREC['nbrRECETTE'];
			
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Affichage des Statistiques</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionRecette.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Affichage des Statistiques</div>
					<div class="panel-body">
						<p><font size="6.5em"> <font weight="5px"><center>Liste des Statistiques de Gestion (En Terme de Nombre de Ligne Dans La Base de Données)</p>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
						<center>Liste des Statistiques de Gestion (En Terme de Nombre de Ligne Dans La Base de Données)</center>
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Catégorie des Produits</th>
									<th>Les Produits En Stock</th>
									<th>Les Recettes</th>
									
								</tr>
							</thead>
							<tbody>
								
									<tr>																		
																					
										<td><?php echo $nbrCATE ?></td>											
										<td><?php echo $nbrPDT ?></td>											
										<td><?php echo $nbrRECETT ?></td>											
																				
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