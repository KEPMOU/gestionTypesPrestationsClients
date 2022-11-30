<?php
	require_once('session.php');
?>

<?php
	
	require_once('connexion.php');
	
	$user = $_SESSION['utilisateur']['ID'];
	
	
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
	
	
		$resultat = $con->query("SELECT MI.REFERENCEINTERNEMEDICAMENTINTEGRE, M.REFERENCEMEDICAMENT, M.LIBELLEMEDICAMENT, M.PRIXVENTEMEDICAMENT, MI.QTESTOCKMEDICAMENTINTEGRE
								FROM UTILISATEUR U, PHARMACIE P, MEDICAMENT M, MEDICAMENTINTEGRE MI
								WHERE M.REFERENCEMEDICAMENT = MI.REFERENCEMEDICAMENT
								AND MI.REFERENCEPHARMACIE = P.REFERENCEPHARMACIE
								AND P.ID = U.ID
								AND (MI.REFERENCEINTERNEMEDICAMENTINTEGRE LIKE '%$mc%' OR M.LIBELLEMEDICAMENT LIKE '%$mc%')
								AND U.ID = $user
								ORDER BY MI.REFERENCEINTERNEMEDICAMENTINTEGRE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(MI.REFERENCEINTERNEMEDICAMENTINTEGRE) AS nbrCLASSE
								FROM UTILISATEUR U, PHARMACIE P, MEDICAMENT M, MEDICAMENTINTEGRE MI
								WHERE M.REFERENCEMEDICAMENT = MI.REFERENCEMEDICAMENT
								AND MI.REFERENCEPHARMACIE = P.REFERENCEPHARMACIE
								AND P.ID = U.ID
								AND U.ID = $user");
	
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrCLASSE'];
	
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
		<title>Page Gestion du Stock Interne de La Pharmacie</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		 <div id="wrapper">
			<?php include('EnteteUser.php');?><br><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Gestion du Stock Interne de La Pharmacie</div>
					<div class="panel-body">
						<form method="get" action="StockPharmacie.php" class="form-inline">
						<div class="form-group">						
								<input type="type" name="motCle" 
										placeholder="Tapez Un Mot Clé"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success btn-lg">
									<i class="glyphicon glyphicon-search"></i>
									Lancer La Recherche . . .
								</button>
							</div>
						</form>
					</div>
				</div>
				<form class="form-inline" method="post" action="#">
					<button type="submit" id="pdf" name="StockInternePharmacie"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer Le Stock Interne de Votre Pharmacie</button>
				</form><br>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Médicaments du Stock de La Pharmacie (<?php echo $nbrPro ?>&nbspMédicaments du Stock de La Pharmacie) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Ref. Interne</th>
									<th>Ref. National</th>
									<th>Libellé du Médicament</th>
									<th>Prix Vente</th>
									<th>Stock En Interne</th>
									
									<?php if($_SESSION['utilisateur']['ROLE']=="AdminPharm") {?> 
										<th>ACTIONS</th>
									<?php } ?>
									
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCEINTERNEMEDICAMENTINTEGRE'] ?></td>
										<td><?php echo $STAGIAIRE['REFERENCEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['PRIXVENTEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['QTESTOCKMEDICAMENTINTEGRE'] ?></td>
										
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="AdminPharm") {?>
												<!--  Action Editer un stagiaire -->
												
												<a class="btn btn-success btn-sm" href="NoterVenteMed.php?REFERENCEINTERNEMEDICAMENTINTEGRE=<?php echo $STAGIAIRE['REFERENCEINTERNEMEDICAMENTINTEGRE'] ?>">
													<span class="glyphicon glyphicon-minus-sign"></span> Vendre
												</a>
												
												&nbsp&nbsp
												<a class="btn btn-success btn-sm" href="NoterLivraisonMed.php?REFERENCEINTERNEMEDICAMENTINTEGRE=<?php echo $STAGIAIRE['REFERENCEINTERNEMEDICAMENTINTEGRE'] ?>">
													<span class="glyphicon glyphicon-plus-sign"></span> Livrer
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
											<a href="StockPharmacie.php?page=<?php echo $i ?>
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