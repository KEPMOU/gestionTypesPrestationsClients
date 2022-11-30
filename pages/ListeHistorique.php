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
	
		$resultat = $con->query("SELECT REC.IDRECETTE, PDT.DESIGNATIONPRODUIT, PDT.PRIXUNITAIREPRODUIT, REC.DATERECETTE, REC.HEUREENREGRECETTE, REC.QTERECETTE, (REC.QTERECETTE * PDT.PRIXUNITAIREPRODUIT) AS TOTAL
								FROM PRODUIT PDT, RECETTE REC
								WHERE REC.REFERENCEPRODUIT = PDT.REFERENCEPRODUIT
								AND (REC.IDRECETTE like '%$mc%' OR PDT.DESIGNATIONPRODUIT like '%$mc%')
								ORDER BY REC.IDRECETTE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) AS nbrRECE
								from RECETTE 
								WHERE IDRECETTE like '%$mc%'");
		
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrRECE'];
	
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
		<title>Page Affichage de L'Historique des Ventes de La Mini Alimentation</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionRecette.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Une Vente de La Mini Alimentation</div>
					<div class="panel-body">
						<form method="get" action="ListeHistorique.php" class="form-inline">
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
								
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Affichage de L'Historique des Ventes de La Mini Alimentation 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>La Vente</th>
									<th>Produit</th>
									<th>Prix</th>
									<th>Date Vente</th>
									<th>Heure Vente</th>
									<th>Quantité</th>
									<th>Montant Facture</th>
									
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDRECETTE'] ?></td>
										<td><?php echo $STAGIAIRE['DESIGNATIONPRODUIT'] ?></td>
										<td><?php echo $STAGIAIRE['PRIXUNITAIREPRODUIT'] ?></td>
										<td><?php echo $STAGIAIRE['DATERECETTE'] ?></td>
										<td><?php echo $STAGIAIRE['HEUREENREGRECETTE'] ?></td>	
										<td><?php echo $STAGIAIRE['QTERECETTE'] ?></td>		
										<td><?php echo $STAGIAIRE['TOTAL'] ?></td>			
											
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
											<a href="ListeHistorique.php?page=<?php echo $i ?>
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