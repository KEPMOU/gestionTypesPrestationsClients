<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
		$resultat = $con->query("SELECT VTE.IDVENTE, CLT.NOMCLIENT, PDT.LIBELLEPRODUIT, VTE.DATEVENTE, VTE.HEUREVENTE, VTE.QTEVENTE
								FROM CLIENT CLT, VENTE VTE, PRODUIT PDT
								WHERE CLT.IDCLIENT = VTE.IDCLIENT
								AND VTE.REFERENCEPRODUIT = PDT.REFERENCEPRODUIT
								AND (CLT.NOMCLIENT like '%$mc%' OR PDT.LIBELLEPRODUIT like '%$mc%')
								ORDER BY VTE.IDVENTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrVENTE
								from VENTE 
								where IDVENTE like '%$mc%'");
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrVENTE'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion des Ventes de Produits En Stock</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body style="background-color:#1c87c9;">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Une Vente de Produits En Stock</div>
					<div class="panel-body">
						<form method="get" action="ListeVentes.php" class="form-inline">
						<div class="form-group">						
								
								<input type="text" name="motCle" 
										placeholder="Taper Un Mot Clé"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success">
									<i class="glyphicon glyphicon-search"></i>
									Rechercher . . .
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<a class="btn btn-success" href="NouvelleVente.php">Nouvelle Vente de Produits En Stock</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Ventes Enregistrées (<?php echo $nbrPro ?>&nbspVente(s) de Stock) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID Vente</th>
									<th>Le Client</th>
									<th>Le Produit</th>
									<th>Date de La Vente</th>
									<th>Heure</th>
									<th>Quantite de La Vente</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDVENTE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMCLIENT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEPRODUIT'] ?></td>
										<td><?php echo $STAGIAIRE['DATEVENTE'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREVENTE'] ?></td>			
										<td><?php echo $STAGIAIRE['QTEVENTE'] ?></td>			
											
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de Ligne de Données Par Page </label>
											<input type="hidden" name="motCle" 
												value="<?php echo $mc ?>">
											<input type="hidden" name="page" 
												value="<?php echo $page ?>">
											<select name="size" class="form-control"
													onchange="this.form.submit()">
												<option <?php if($size==5)  echo "selected" ?>>5</option>
												<option <?php if($size==10) echo "selected" ?>>10</option>
												<option <?php if($size==15) echo "selected" ?>>15</option>
												<option <?php if($size==20) echo "selected" ?>>20</option>
												<option <?php if($size==25) echo "selected" ?>>25</option>
											</select>
										</form>
									</li>
									<?php for($i=1;$i<=$nbrPage;$i++){ ?>
										<li class="<?php if($i==$page) echo 'active' ?>">
											<a href="ListeVentes.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>
							
						</div>
						
					</div>				
				</div>	
				
			</div>
		</div>
	</body>
</html>