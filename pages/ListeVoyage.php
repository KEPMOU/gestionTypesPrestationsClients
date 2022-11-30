<?php
	require_once('session.php');
?>

<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODEAGENCE']))
		$idf=$_GET['CODEAGENCE'];
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
		$resultat = $con->query("SELECT VOY.REFERENCEVOYAGE, DEST.LIBELLEDESTINATION, AG.NOMAGENCE, TV.LIBELLETYPEVOYAGE, TV.PRIXTYPEVOYAGE, B.IMMATRICULATIONBUS, VOY.DATEVOYAGE, VOY.HEUREDEPARTVOYAGE, VOY.DUREEHEUEVOYAGE
								FROM VOYAGE VOY, DESTINATION DEST, AGENCE AG, TYPEVOYAGE TV, BUS B
								WHERE DEST.CODEDESTINATION = VOY.CODEDESTINATION
								AND VOY.CODEAGENCE = AG.CODEAGENCE
								AND VOY.CODETYPEVOYAGE = TV.CODETYPEVOYAGE
								AND VOY.IMMATRICULATIONBUS = B.IMMATRICULATIONBUS
								AND (VOY.REFERENCEVOYAGE like '%$mc%' OR VOY.IMMATRICULATIONBUS like '%$mc%')
								ORDER BY VOY.DATEVOYAGE
								LIMIT $size
								OFFSET $offset");
								
		$resultat2 = $con->query("SELECT COUNT(*) as NbreVoyage 
								FROM VOYAGE 
								WHERE REFERENCEVOYAGE like '%$mc%' OR IMMATRICULATIONBUS like '%$mc%'");
								
	}
	else{
		$resultat = $con->query("SELECT VOY.REFERENCEVOYAGE, DEST.LIBELLEDESTINATION, AG.NOMAGENCE, TV.LIBELLETYPEVOYAGE, TV.PRIXTYPEVOYAGE, B.IMMATRICULATIONBUS, VOY.DATEVOYAGE, VOY.HEUREDEPARTVOYAGE, VOY.DUREEHEUEVOYAGE
								FROM VOYAGE VOY, DESTINATION DEST, AGENCE AG, TYPEVOYAGE TV, BUS B
								WHERE DEST.CODEDESTINATION = VOY.CODEDESTINATION
								AND VOY.CODEAGENCE = AG.CODEAGENCE
								AND VOY.CODETYPEVOYAGE = TV.CODETYPEVOYAGE
								AND VOY.IMMATRICULATIONBUS = B.IMMATRICULATIONBUS
								AND (VOY.REFERENCEVOYAGE like '%$mc%' OR VOY.IMMATRICULATIONBUS like '%$mc%')
								And VOY.CODEAGENCE='$idf'
								ORDER BY VOY.DATEVOYAGE
								LIMIT $size
								OFFSET $offset");
								
		$resultat2 = $con->query("SELECT COUNT(*) as NbreVoyage 
								FROM VOYAGE 
								where (REFERENCEVOYAGE like '%$mc%' OR IMMATRICULATIONBUS like '%$mc%')
								And CODEAGENCE='$idf'");
								
	}
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['NbreVoyage'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from AGENCE";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des Voyages Programmés</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="gestionAgenceVoyage1.JPG">
		 <div id="wrapper">
			<?php include('Entete_Admin.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des Voyages Programmés</div>
					<div class="panel-body">
						<form method="get" action="ListeVoyage.php" class="form-inline">
						<div class="form-group">						
								<select name="CODEAGENCE" id="CODEAGENCE" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Voyages Par Agence Départ</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODEAGENCE']?>" 
											<?php echo $idf==$filiere['CODEAGENCE']?"selected":"" ?>>
											<?php echo $filiere['NOMAGENCE']?>
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
									Lancer La Recherche . . .
								</button>
								&nbsp&nbsp&nbsp
									<a class="btn btn-success btn-lg" href="NouveauVoyage.php">Programmer Un Nouveau Voyage</a>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Voyages Programmés (<?php echo $nbrPro ?>&nbspVoyages Programmés ) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Voyage</th>
									<th>Destination</th>
									<th>Départ</th>
									<th>Type</th>
									<th>Prix</th>
									<th>Date</th>
									<th>Départ</th>
									<th>Bus</th>
									<th>Actions</th>
									
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCEVOYAGE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEDESTINATION'] ?></td>
										<td><?php echo $STAGIAIRE['NOMAGENCE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLETYPEVOYAGE'] ?></td>
										<td><?php echo $STAGIAIRE['PRIXTYPEVOYAGE'] ?></td>
										<td><?php echo $STAGIAIRE['DATEVOYAGE'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREDEPARTVOYAGE'] ?></td>	
										<td><?php echo $STAGIAIRE['IMMATRICULATIONBUS'] ?></td>
										<td>
											<?php {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerVoyage.php?REFERENCEVOYAGE=<?php echo $STAGIAIRE['REFERENCEVOYAGE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span> Editer
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
											<label>Nombre de Voyages Par Page </label>
											<input type="hidden" name="CODEAGENCE" 
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
											<a href="ListeVoyagesProg.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODEAGENCE=<?php echo $idf ?>
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