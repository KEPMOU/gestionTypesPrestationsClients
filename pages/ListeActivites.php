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
		$resultat = $con->query("SELECT ACT.IDACTIVITE, STG.NOMSTAGIAIRE, ACT.LIBELLEACTIVITE, ACT.DESCRIPTIONACTIVITE, ACT.DATEACTIVITE
								FROM ACTIVITE ACT, STAGIAIRE STG
								WHERE STG.IDSTAGIAIRE = ACT.IDSTAGIAIRE
								AND (STG.NOMSTAGIAIRE like '%$mc%' OR ACT.LIBELLEACTIVITE like '%$mc%')
								ORDER BY ACT.IDACTIVITE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrACTIVITES 
								from ACTIVITE 
								where LIBELLEACTIVITE like '%$mc%' OR DESCRIPTIONACTIVITE like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT ACT.IDACTIVITE, STG.NOMSTAGIAIRE, ACT.LIBELLEACTIVITE, ACT.DESCRIPTIONACTIVITE, ACT.DATEACTIVITE
								FROM ACTIVITE ACT, STAGIAIRE STG
								WHERE STG.IDSTAGIAIRE = ACT.IDSTAGIAIRE
								AND (STG.NOMSTAGIAIRE like '%$mc%' OR ACT.LIBELLEACTIVITE like '%$mc%')
								And STG.IDSTAGIAIRE=$idf
								ORDER BY ACT.IDACTIVITE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrACTIVITES 
								from ACTIVITE 
								where (LIBELLEACTIVITE like '%$mc%' OR DESCRIPTIONACTIVITE like '%$mc%')
								And STG.IDSTAGIAIRE=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrACTIVITES'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from STAGIAIRE";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Gestion des Acitictés</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="marthe.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des Acitictés des Stagiaires</div>
					<div class="panel-body">
						<form method="get" action="ListeActivites.php" class="form-inline">
						<div class="form-group">						
								<select name="IDSTAGIAIRE" id="IDSTAGIAIRE" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Liste Par Stagiaire</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['IDSTAGIAIRE']?>" 
											<?php echo $idf==$filiere['IDSTAGIAIRE']?"selected":"" ?>>
											<?php echo $filiere['NOMSTAGIAIRE']?>
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
					
					Liste des Activités des Stagiaires (<?php echo $nbrPro ?>&nbspActivités) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID Activité</th>
									<th>Nom du Stagiaire</th>
									<th>Libellé Activité</th>
									<th>Description</th>
									<th>Date Activité</th>
									
								
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDACTIVITE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMSTAGIAIRE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEACTIVITE'] ?></td>
										<td><?php echo $STAGIAIRE['DESCRIPTIONACTIVITE'] ?></td>	
										<td><?php echo $STAGIAIRE['DATEACTIVITE'] ?></td>	
											
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="editerstagaire.php?IDACTIVITE=<?php echo $STAGIAIRE['IDACTIVITE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('Etes vous sur de vouloir supprimer le STAGIAIRE?')" 
													href="supprimerstagaire.php?IDACTIVITE=<?php echo $STAGIAIRE['IDACTIVITE'] ?>">
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
											<label>Nombre Activités Par Page </label>
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
											<a href="stagiaires.php?page=<?php echo $i ?>
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