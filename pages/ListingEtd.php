<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['CODEFILIERE']))
		$idf=$_GET['CODEFILIERE'];
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
		$resultat = $con->query("SELECT ETD.MATRICULEETUDIANT, FIL.LIBELLEFILIERE, ETD.NOMPRENOMETUDIANT, ETD.TELEPHONEETUDIANT, ETD.DATENAISSETUDIANT
								FROM FILIERE FIL, ETUDIANT ETD
								WHERE FIL.CODEFILIERE = ETD.CODEFILIERE 
								AND (ETD.MATRICULEETUDIANT LIKE '%$mc%' OR ETD.NOMPRENOMETUDIANT LIKE '%$mc%')
								ORDER BY ETD.MATRICULEETUDIANT
								LIMIT $size
								OFFSET $offset");
								
		$resultat2 = $con->query("SELECT COUNT(*) AS nbrREC
								FROM ETUDIANT 
								WHERE MATRICULEETUDIANT LIKE '%$mc%' OR NOMPRENOMETUDIANT LIKE '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT ETD.MATRICULEETUDIANT, FIL.LIBELLEFILIERE, ETD.NOMPRENOMETUDIANT, ETD.TELEPHONEETUDIANT, ETD.DATENAISSETUDIANT
								FROM FILIERE FIL, ETUDIANT ETD
								WHERE FIL.CODEFILIERE = ETD.CODEFILIERE 
								AND (ETD.MATRICULEETUDIANT LIKE '%$mc%' OR ETD.NOMPRENOMETUDIANT LIKE '%$mc%')
								AND ETD.CODEFILIERE = '$idf'
								ORDER BY ETD.MATRICULEETUDIANT");
								
		$resultat2 = $con->query("SELECT COUNT(*) AS nbrREC
								FROM ETUDIANT 
								WHERE MATRICULEETUDIANT LIKE '%$mc%' OR NOMPRENOMETUDIANT LIKE '%$mc%'
								AND CODEFILIERE = '$idf'");
	
	}
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrREC'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale									
										
	$requetef="SELECT * FROM FILIERE";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion des Etudiants de L'IPES</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body>
		 <div id="wrapper">
			<?php include('EnteteUser.php');?>
			<div class="container"><br>
				<div class="panel panel-primary espace60">
					<div class="panel-heading">Page Gestion des Etudiants de L'IPES</div>
					<div class="panel-body">
						<form method="get" action="ListingEtd.php" class="form-inline">
						<div class="form-group">						
								<select name="CODEFILIERE" id="CODEFILIERE" class="form-control"
									onChange="this.form.submit();">
									<option value="ALL" >Lister Les Etudiants Par Filières</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['CODEFILIERE']?>" 
											<?php echo $idf==$filiere['CODEFILIERE']?"selected":"" ?>>
											<?php echo $filiere['LIBELLEFILIERE']?>
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
								&nbsp&nbsp&nbsp
								<?php if($_SESSION['utilisateur']['ROLE']=="Administration") {?>
									<a class="btn btn-success btn-lg" href="AjouterEtudiant.php">Enregistrer Un Nouvel Etudiant dans La BDD</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Etudiants Enregistrés dans La Base de Donners de L'IPES
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>MATRICULE ETUDIANT</th>
									<th>LIBELLE FILIERE</th>
									<th>NOM PRENOM ETUDIANT</th>
									<th>TELEPHONES ETUDIANT</th>
									<th>DATE NAISSANCE</th>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['MATRICULEETUDIANT'] ?></td>
										<td><?php echo $STAGIAIRE['LIBELLEFILIERE'] ?></td>
										<td><?php echo $STAGIAIRE['NOMPRENOMETUDIANT'] ?></td>
										<td><?php echo $STAGIAIRE['TELEPHONEETUDIANT'] ?></td>	
										<td><?php echo $STAGIAIRE['DATENAISSETUDIANT'] ?></td>												
									</tr>
								<?php } ?>
							</tbody>
						</table>
						
						<div>																						
								<ul class="nav nav-pills nav-right">
									<li>
										<form class="form-inline">
											<label>Nombre de Ligne de Données Par Page </label>
											<input type="hidden" name="CODEFILIERE" 
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
											<a href="ListingEtd.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&CODEFILIERE=<?php echo $idf ?>
											&size=<?php echo $size ?>">
												Page <?php echo $i ?>
											</a>
										</li>
									<?php } ?>	
								</ul>							
						</div>					
					</div>				
				</div>
					<?php if($_SESSION['utilisateur']['ROLE']=="Administration") {?>
									<a class="btn btn-primary btn-lg btn-block" href="AjouterEtudiant.php">Enregistrer Un Nouvel Etudiant dans La Base de Données de L'IPES</a>
								<?php } ?>	
			</div>									
		</div>
	</body>
</html>