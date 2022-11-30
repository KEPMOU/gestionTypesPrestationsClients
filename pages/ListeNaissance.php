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
	
	if($idf==0){// TOUTES LES FILIERES
		$resultat = $con->query("SELECT NAISS.REFERENCENAISSANCE, JR.LIBELLEJOUR, NAISS.DATENAISSANCE, NAISS.LIEUNAISSANCE, NAISS.HEURENAISSANCE
								FROM NAISSANCE NAISS, JOUR JR
								WHERE NAISS.CODEJOUR = JR.CODEJOUR
								AND (NAISS.REFERENCENAISSANCE like '%$mc%' OR NAISS.LIEUNAISSANCE like '%$mc%')
								ORDER BY NAISS.REFERENCENAISSANCE DESC
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrNAISS 
								from NAISSANCE 
								where REFERENCENAISSANCE like '%$mc%' OR LIEUNAISSANCE like '%$mc%'");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrNAISS'];
	
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
		<title>Gestion des Etats Civils A La Mairie de Yaounde II</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="GestionNaissance3.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher Les Naissances Enregistrées</div>
					<div class="panel-body">
						<form method="get" action="ListeNaissance.php" class="form-inline">
						<div class="form-group">						
								
								<input type="text" name="motCle" 
										placeholder="Tapez Un Mot Clé"
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
									<a class="btn btn-success" href="NouvelleNaissance.php">Enregistrer Une Nouvelle Naissance</a>
									
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Naissances Enregistrées - Affichage Listing Complet 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Ref.</th>
									<th>Libellé du Jour</th>
									<th>Date Naissance</th>
									<th>Lieu Naissance</th>
									<th>Heure Naissance</th>
									
								
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['REFERENCENAISSANCE'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEJOUR'] ?></td>
										<td><?php echo $STAGIAIRE['DATENAISSANCE'] ?></td>
										<td><?php echo $STAGIAIRE['LIEUNAISSANCE'] ?></td>	
										<td><?php echo $STAGIAIRE['HEURENAISSANCE'] ?></td>	
											
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="editerstagaire.php?REFERENCENAISSANCE=<?php echo $STAGIAIRE['REFERENCENAISSANCE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a href="supprimerstagaire.php?REFERENCENAISSANCE=<?php echo $STAGIAIRE['REFERENCENAISSANCE'] ?>">
													<span class="glyphicon glyphicon-th"></span>
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
											<a href="ListeNaissance.php?page=<?php echo $i ?>
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