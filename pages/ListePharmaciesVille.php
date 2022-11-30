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
		$resultat = $con->query("SELECT P.REFERENCEPHARMACIE, Q.NOMQUARTIER, P.NOMPHARMACIE, P.LOCALISATIONPHARMACIE, P.CONTACTSPHARMACIE, P.HEUREOUVRTUREPHARMACIE, P.HEUREFERMETUREPHARMACIE
								FROM QUARTIER Q, PHARMACIE P
								WHERE Q.IDQUARTIER = P.IDQUARTIER
								AND (P.NOMPHARMACIE LIKE '%$mc%' OR P.LOCALISATIONPHARMACIE LIKE '%$mc%')
								ORDER BY P.REFERENCEPHARMACIE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) as nbrSEQ 
								FROM PHARMACIE 
								WHERE NOMPHARMACIE LIKE '%$mc%' OR LOCALISATIONPHARMACIE LIKE '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT P.REFERENCEPHARMACIE, Q.NOMQUARTIER, P.NOMPHARMACIE, P.LOCALISATIONPHARMACIE, P.CONTACTSPHARMACIE, P.HEUREOUVRTUREPHARMACIE, P.HEUREFERMETUREPHARMACIE
								FROM QUARTIER Q, PHARMACIE P
								WHERE Q.IDQUARTIER = P.IDQUARTIER
								AND (P.NOMPHARMACIE LIKE '%$mc%' OR P.LOCALISATIONPHARMACIE LIKE '%$mc%')
								AND P.IDQUARTIER=$idf
								ORDER BY P.REFERENCEPHARMACIE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) as nbrSEQ 
								FROM PHARMACIE 
								where (NOMPHARMACIE LIKE '%$mc%' OR LOCALISATIONPHARMACIE LIKE '%$mc%')
								And IDQUARTIER=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrSEQ'];
	
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
		<title>Page Liste des Pharmacies Enregistrées dans La Base de Données</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		 <div id="wrapper">
			<?php include('EnteteUsager.php');?><br><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Les Informations Les Pharmacies de La Base de Données</div>
					<div class="panel-body">
						<form method="get" action="ListePharmaciesVille.php" class="form-inline">
						<div class="form-group">						
								<select name="IDQUARTIER" id="IDQUARTIER" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Lister Pharmacies Selon Quartier</option>
									<?php while($filieref=$resultatf->fetch()){ ?>
										<option value="<?php echo $filieref['IDQUARTIER']?>" 
											<?php echo $idf==$filieref['IDQUARTIER']?"selected":"" ?>>
											<?php echo $filieref['NOMQUARTIER']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="text" name="motCle" 
										placeholder="Taper Nom Ou Localisation"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success btn-lg">
									<i class="glyphicon glyphicon-search"></i>
									Lancer La Recherche . . .
								</button>
								&nbsp&nbsp&nbsp
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Pharmacies Enregistrées dans La Base de Données (<?php echo $nbrPro ?> Pharmacie (s) ) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Nom de La Pharmacie</th>
									<th>Localisation</th>
									<th>Situation Géographique</th>
									<th>Contacts</th>
									<th>Ouverture</th>
									<th>Fermeture</th>								
								
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										
										<td><?php echo $STAGIAIRE['NOMPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMQUARTIER'] ?></td>
										<td><?php echo $STAGIAIRE['LOCALISATIONPHARMACIE'] ?></td>
										<td><?php echo $STAGIAIRE['CONTACTSPHARMACIE'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREOUVRTUREPHARMACIE'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREFERMETUREPHARMACIE'] ?></td>	
											
									</tr>
								<?php } ?>
							</tbody>
						</table><hr>
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de Lignes de Données Par Page </label>
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
											<a href="ListePharmaciesVille.php?page=<?php echo $i ?>
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
				
			</div>
		</div>
	</body>
</html>