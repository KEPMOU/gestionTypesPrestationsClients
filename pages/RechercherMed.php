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
	
	
		$resultat = $con->query("SELECT M.REFERENCEMEDICAMENT, M.LIBELLEMEDICAMENT, M.PRIXVENTEMEDICAMENT, P.NOMPHARMACIE, P.CONTACTSPHARMACIE, P.LOCALISATIONPHARMACIE
								FROM MEDICAMENT M, MEDICAMENTINTEGRE MI, PHARMACIE P
								WHERE M.REFERENCEMEDICAMENT = MI.REFERENCEMEDICAMENT
								AND MI.REFERENCEPHARMACIE = P.REFERENCEPHARMACIE
								AND (M.LIBELLEMEDICAMENT LIKE '%$mc%' OR P.NOMPHARMACIE LIKE '%$mc%')
								ORDER BY M.REFERENCEMEDICAMENT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(REFERENCEMEDICAMENT) AS nbrCLASSE
								FROM MEDICAMENT 
								WHERE LIBELLEMEDICAMENT LIKE '%$mc%'");
	
	
	
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
		<title>Page Gestion des Recherches Sur Un Médicament</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		 <div id="wrapper">
			<?php include('EnteteUsager.php');?><br><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Gestion des Recherches Sur Un Médicament</div>
					<div class="panel-body">
						<form method="get" action="RechercherMed.php" class="form-inline">
						<div class="form-group">						
								<input type="type" name="motCle" 
										placeholder="Taper Un Mot Clé"
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
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Page Gestion des Recherches Sur Un Médicament
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>REFERENCE</th>
									<th>NOM DU MEDICAMENT</th>
									<th>PRIX DE VENTE</th>
									<th>NOM PHARMACIE</th>
									<th>CONTACT</th>
									<th>ADRESSE PHARMACIE</th>
									<th>ACTIONS</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['PRIXVENTEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['NOMPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['CONTACTSPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['LOCALISATIONPHARMACIE'] ?></td>
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
											<a href="RechercherMed.php?page=<?php echo $i ?>
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