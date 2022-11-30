<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['IDQUARTIER']))
		$idf=$_GET['IDQUARTIER'];
	else
		$idf=0;
		
	if(isset($_GET['size']))
		$size=$_GET['size'];
	else
		$size=4;
		
	if(isset($_GET['page']))
		$page=$_GET['page'];
	else
		$page=1;
			
	$offset=($page-1)*$size;
	
	if($idf==0){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT P.REFERENCEPHARMACIE, Q.NOMQUARTIER, P.NOMPHARMACIE, P.LOCALISATIONPHARMACIE, P.CONTACTSPHARMACIE, P.HEUREOUVRTUREPHARMACIE, P.HEUREFERMETUREPHARMACIE, UT.ID
								FROM QUARTIER Q, PHARMACIE P, UTILISATEUR UT
								WHERE Q.IDQUARTIER = P.IDQUARTIER
								AND P.ID = UT.ID
								AND (Q.NOMQUARTIER LIKE '%$mc%' OR P.NOMPHARMACIE LIKE '%$mc%')
								ORDER BY P.REFERENCEPHARMACIE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) AS nbrPDT 
								FROM PHARMACIE 
								WHERE REFERENCEPHARMACIE LIKE '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT P.REFERENCEPHARMACIE, Q.NOMQUARTIER, P.NOMPHARMACIE, P.LOCALISATIONPHARMACIE, P.CONTACTSPHARMACIE, P.HEUREOUVRTUREPHARMACIE, P.HEUREFERMETUREPHARMACIE, UT.ID
								FROM QUARTIER Q, PHARMACIE P, UTILISATEUR UT
								WHERE Q.IDQUARTIER = P.IDQUARTIER
								AND P.ID = UT.ID
								AND (Q.NOMQUARTIER LIKE '%$mc%' OR P.NOMPHARMACIE LIKE '%$mc%')
								AND P.IDQUARTIER = $idf
								ORDER BY P.REFERENCEPHARMACIE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) AS nbrPDT 
								FROM PHARMACIE 
								WHERE (REFERENCEPHARMACIE LIKE '%$mc%')
								AND IDQUARTIER= $idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrPDT'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="SELECT * FROM QUARTIER";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion des Pharmacies de La Ville de Yaoundé</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		 <div id="wrapper">
			<?php include('EnteteUser.php');?><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Gestion des Pharmacies de La Ville de Yaoundé</div>
					<div class="panel-body">
						<form method="get" action="ListePharmaciesYde.php" class="form-inline">
						<div class="form-group">						
								<select name="IDQUARTIER" id="IDQUARTIER" class="form-control"
									onChange="this.form.submit();">
									<option value="0">Lister Les Pharmacies Par Localisations</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['IDQUARTIER']?>" 
											<?php echo $idf==$filiere['IDQUARTIER']?"selected":"" ?>>
											<?php echo $filiere['NOMQUARTIER']?>
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
							</div>
						</form>
					</div>
				</div>
				
				<form class="form-inline" method="post" action="Imprimer_ListePharmacies.php">
					<button type="submit" id="pdf" name="ListePharmacies"  class="btn btn-success btn-lg btn-block hidden-print">
					<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimer La Liste des Pharmacies Enregistrées dans La Base de Données</button>
				</form><br>
				
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste de Pharmacies - (<?php echo $nbrPro ?>&nbspPharmacies Enregistrées dans La Base de Données) 
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>REFERENCE</th>
									<th>LOCALISATION</th>
									<th>PHARMACIE</th>
									<th>CONTACTS</th>
									<th>OUVRTURE</th>
									<th>FERMETURE</th>
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="SuperAdministrateur") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCEPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMQUARTIER'] ?></td>
										<td><?php echo $STAGIAIRE['NOMPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['CONTACTSPHARMACIE'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREOUVRTUREPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['HEUREFERMETUREPHARMACIE'] ?></td>
										
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="SuperAdministrateur") {?>
												<!--  Action Editer un stagiaire -->
												<a class="btn btn-success btn-sm" href="EditerPharmacie.php?REFERENCEPHARMACIE=<?php echo $STAGIAIRE['REFERENCEPHARMACIE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a class="btn btn-danger btn-sm" Onclick="return confirm('VOULEZ - VOUS VRAIMENT SUPPRIMER CETTE PHARMACIE ?')" 
													href="SupprimerPharmacie.php?REFERENCEPHARMACIE=<?php echo $STAGIAIRE['REFERENCEPHARMACIE'] ?>">
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
											<input type="hidden" name="IDQUARTIER" 
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
											<a href="ListePharmaciesYde.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&IDQUARTIER=<?php echo $idf ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>
							
						</div>
						
					</div>				
				</div>
				
				<?php if($_SESSION['utilisateur']['ROLE']=="SuperAdministrateur") {?>
									<a class="btn btn-success btn-lg btn-block" href="NouvellePharmacie.php">Enregistrer Une Nouvelle Pharmacie dans La Base de Données</a>
								<?php } ?>
				
			</div>
		</div>
	</body>
</html>