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
	
	
		$resultat = $con->query("SELECT CODEFORMEMEDICAMENT, LIBELLEFORMEMEDICAMENT
								FROM FORMEMEDICAMENT
								WHERE (CODEFORMEMEDICAMENT LIKE '%$mc%' OR LIBELLEFORMEMEDICAMENT LIKE '%$mc%')
								ORDER BY CODEFORMEMEDICAMENT
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("SELECT COUNT(*) as nbrPRODUIT
								FROM FORMEMEDICAMENT 
								WHERE CODEFORMEMEDICAMENT LIKE '%$mc%'");
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrPRODUIT'];
	
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
		<title>Page Gestion des Formes de Médicaments</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img20.JPG">
		 <div id="wrapper">
			<?php include('EnteteUser.php');?><br>
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Page Gestion des Formes de Médicaments</div>
					<div class="panel-body">
						<form method="get" action="ListeFormesMed.php" class="form-inline">
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
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Formes de Médicaments Enregistrées dans La Base de Données (<?php echo $nbrPro ?>&nbspFormes de Médicaments Enregistrées dans La Base de Données) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>CODE FAMILLE DU MEDICAMENT</th>
									<th>LIBELLE FAMILLE DU MEDICAMENT</th>
									
									 <?php if($_SESSION['utilisateur']['ROLE']=="SuperAdministrateur") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['CODEFORMEMEDICAMENT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEFORMEMEDICAMENT'] ?></td>
											
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="SuperAdministrateur") {?>
												<!--  Action Editer un stagiaire -->
												<a class="btn btn-success btn-sm" href="EditerFormeMed.php?CODEFORMEMEDICAMENT=<?php echo $STAGIAIRE['CODEFORMEMEDICAMENT'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
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
											<a href="ListeFormesMed.php?page=<?php echo $i ?>
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
				
				<?php if($_SESSION['utilisateur']['ROLE']=="SuperAdministrateur") {?>
									<a class="btn btn-success btn-lg btn-block" href="NouvelleFormeMed.php">Ajouter Une Nouvelle Forme de Médicaments</a>
								<?php } ?>
				
			</div>
		</div>
	</body>
</html>