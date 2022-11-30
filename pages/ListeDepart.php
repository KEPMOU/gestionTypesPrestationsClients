<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['IDSTAGIAIRE']))
		$idf=$_GET['IDSTAGIAIRE'];
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
		$resultat = $con->query("SELECT DEP.IDDEPART, STG.NOMSTAGIAIRE, STG.PRENOMSTAGIAIRE, DEP.DATEDEPART, DEP.HEUREDEPART
								FROM DEPART DEP, STAGIAIRE STG
								WHERE STG.IDSTAGIAIRE = DEP.IDSTAGIAIRE
								AND (STG.NOMSTAGIAIRE like '%$mc%' OR DEP.DATEDEPART like '%$mc%')
								ORDER BY DEP.HEUREDEPART DESC
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrDEPART 
								from DEPART 
								where DATEDEPART like '%$mc%' OR HEUREDEPART like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT DEP.IDDEPART, STG.NOMSTAGIAIRE, STG.PRENOMSTAGIAIRE, DEP.DATEDEPART, DEP.HEUREDEPART
								FROM DEPART DEP, STAGIAIRE STG
								WHERE STG.IDSTAGIAIRE = DEP.IDSTAGIAIRE
								AND (STG.NOMSTAGIAIRE like '%$mc%' OR DEP.DATEDEPART like '%$mc%')
								And STG.IDSTAGIAIRE=$idf
								ORDER BY DEP.HEUREDEPART DESC
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrDEPART 
								from DEPART 
								where (DATEDEPART like '%$mc%')
								And IDSTAGIAIRE=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrDEPART'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from stagiaire";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des Départs - Le Soir</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des Départs - Le Soir</div>
					<div class="panel-body">
						<form method="get" action="ListeDepart.php" class="form-inline">
						<div class="form-group">						
								<select name="IDSTAGIAIRE" id="IDSTAGIAIRE" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Sélection Stagiaire</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['IDSTAGIAIRE']?>" 
											<?php echo $idf==$filiere['IDSTAGIAIRE']?"selected":"" ?>>
											<?php echo $filiere['NOMSTAGIAIRE']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="date" name="motCle" 
										placeholder="Choisir Une Date"
										id="motCle" class="form-control" 
										value="<?php echo $mc; ?>"/>
								<input type="hidden" name="size"  value="<?php echo $size ?>">		
								<input type="hidden" name="page"  value="<?php echo $page ?>">
								<button type="submit" class="btn btn-success">
									<i class="glyphicon glyphicon-search"></i>
									Lancer La Recherche . . .
								</button>
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
									<a class="btn btn-success" href="NouvelleActivite.php">Nouvelle Activité</a>
									<a class="btn btn-success" href="NouvelleArrivée.php">Pointer Arrivée</a>
									<a class="btn btn-success" href="NouveauDepart.php">Pointer Départ</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Départs - Affichage Listing Complet 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID ARRIVEE</th>
									<th>NOM DU STAGIAIRE</th>
									<th>PRENOM DU STAGIAIRE</th>
									<th>DATE CONCERNEE</th>
									<th>HEURE POINTAGE DEPART</th>
									
								
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDDEPART'] ?></td>
										<td><?php echo $STAGIAIRE['NOMSTAGIAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['PRENOMSTAGIAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['DATEDEPART'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREDEPART'] ?></td>	
											
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="editerstagaire.php?IDDEPART=<?php echo $STAGIAIRE['IDDEPART'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer le STAGIAIRE?')" 
													href="supprimerstagaire.php?IDDEPART=<?php echo $STAGIAIRE['IDDEPART'] ?>">
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
											<input type="hidden" name="IDSTAGIAIRE" 
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
											<a href="ListeDepart.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&IDSTAGIAIRE=<?php echo $idf ?>
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