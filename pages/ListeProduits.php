<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODECATEGORIEPRODUIT']))
		$idf=$_GET['CODECATEGORIEPRODUIT'];
	else
		$idf="ALL";
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	if($idf=="ALL"){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT PDT.REFERENCEPRODUIT, CAT.LIBELLECATEGORIEPRODUIT, PDT.DESIGNATIONPRODUIT, PDT.PRIXUNITAIREPRODUIT, PDT.QTESTOCKPRODUIT, PDT.QTESEUILPRODUIT, PDT.QTEALERTEPRODUIT
								FROM CATEGORIEPRODUIT CAT, PRODUIT PDT
								WHERE CAT.CODECATEGORIEPRODUIT = PDT.CODECATEGORIEPRODUIT
								AND (PDT.REFERENCEPRODUIT like '%$mc%' OR PDT.DESIGNATIONPRODUIT like '%$mc%')
								ORDER BY PDT.REFERENCEPRODUIT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrPRODUIT
								from PRODUIT 
								where REFERENCEPRODUIT like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT PDT.REFERENCEPRODUIT, CAT.LIBELLECATEGORIEPRODUIT, PDT.DESIGNATIONPRODUIT, PDT.PRIXUNITAIREPRODUIT, PDT.QTESTOCKPRODUIT, PDT.QTESEUILPRODUIT, PDT.QTEALERTEPRODUIT
								FROM CATEGORIEPRODUIT CAT, PRODUIT PDT
								WHERE CAT.CODECATEGORIEPRODUIT = PDT.CODECATEGORIEPRODUIT
								AND (PDT.REFERENCEPRODUIT like '%$mc%' OR PDT.DESIGNATIONPRODUIT like '%$mc%')
								And CAT.CODECATEGORIEPRODUIT='$idf'
								ORDER BY PDT.REFERENCEPRODUIT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrPRODUIT 
								from PRODUIT 
								where (DESIGNATIONPRODUIT like '%$mc%')
								And CODECATEGORIEPRODUIT='$idf'");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrPRODUIT'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from CATEGORIEPRODUIT";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion des Produits de La Mini Alimentation</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionRecette.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Une Produit de La Mini Alimentation</div>
					<div class="panel-body">
						<form method="get" action="ListeProduits.php" class="form-inline">
						<div class="form-group">						
								<select name="CODECATEGORIEPRODUIT" id="CODECATEGORIEPRODUIT" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Lister Par Mode de Paiement</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODECATEGORIEPRODUIT']?>" 
											<?php echo $idf==$filiere['CODECATEGORIEPRODUIT']?"selected":"" ?>>
											<?php echo $filiere['LIBELLECATEGORIEPRODUIT']?>
										</option>									
									<?php } ?>
								</select>
								
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
									<a class="btn btn-success" href="NouveauProduit.php">Ajouter Un Produit En Stock</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Produits de La Meni Alimentation (<?php echo $nbrPro ?>&nbspProduit(s) de La Mini Alimentation) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Refence du Produit</th>
									<th>Catégorie</th>
									<th>Le Produit</th>
									<th>Prix Unitaire</th>
									<th>Stock Actuel</th>
									<th>Seuil de Sécurité</th>
									<th>Alerte</th>
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCEPRODUIT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLECATEGORIEPRODUIT'] ?></td>
										<td><?php echo $STAGIAIRE['DESIGNATIONPRODUIT'] ?></td>
										<td><?php echo $STAGIAIRE['PRIXUNITAIREPRODUIT'] ?></td>	
										<td><?php echo $STAGIAIRE['QTESTOCKPRODUIT'] ?></td>		
										<td><?php echo $STAGIAIRE['QTESEUILPRODUIT'] ?></td>		
										<td><?php echo $STAGIAIRE['QTEALERTEPRODUIT'] ?></td>		
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerProduit.php?REFERENCEPRODUIT=<?php echo $STAGIAIRE['REFERENCEPRODUIT'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('VOULEZ - VOUS VRAIMENT SUPPRIMER CETTE RECETTE ?')" 
													href="SupprimerProduit.php?REFERENCEPRODUIT=<?php echo $STAGIAIRE['REFERENCEPRODUIT'] ?>">
													<span class="glyphicon glyphicon-trash"></span>
												</a>
																							
											<?php } ?>
											
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de Ligne de Données Par Page </label>
											<input type="hidden" name="CODECATEGORIEPRODUIT" 
												value="<?php echo $idf ?>">
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
											<a href="ListeProduits.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODECATEGORIEPRODUIT=<?php echo $idf ?>
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