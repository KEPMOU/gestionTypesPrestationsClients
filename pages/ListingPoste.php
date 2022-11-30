<?php
	require_once('session.php');
?>
<?php
	
	require_once('connexion.php');
	
	if(isset($_GET['motCle']))
		$mc=$_GET['motCle'];
	else
		$mc="";
	
	if(isset($_GET['MATRICULEENSEIGNANT']))
		$idf=$_GET['MATRICULEENSEIGNANT'];
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
		$resultat = $con->query("SELECT ENS.GENREENSEIGNANT, ENS.MATRICULEENSEIGNANT, ARR.DATEARRIVEE, ARR.HEUREARRIVEE, ENS.NOMENSEIGNANT, ENS.TELENSEIGNANT
								FROM ENSEIGNANT ENS, CLASSE CLASS, ARRIVEE ARR
								WHERE ENS.MATRICULEENSEIGNANT = ARR.MATRICULEENSEIGNANT
								AND (ENS.MATRICULEENSEIGNANT like '%$mc%' OR ENS.NOMENSEIGNANT like '%$mc%')
								ORDER BY ARR.HEUREARRIVEE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrARRIV 
								from ARRIVEE 
								where MATRICULEENSEIGNANT like '%$mc%'");
	}
	else{
		$resultat = $con->query("SELECT SELECT ENS.GENREENSEIGNANT, ENS.MATRICULEENSEIGNANT, ARR.DATEARRIVEE, ARR.HEUREARRIVEE, ENS.NOMENSEIGNANT, ENS.TELENSEIGNANT
								FROM ENSEIGNANT ENS, CLASSE CLASS, ARRIVEE ARR
								WHERE ENS.MATRICULEENSEIGNANT = ARR.MATRICULEENSEIGNANT
								AND (ENS.MATRICULEENSEIGNANT like '%$mc%' OR ENS.NOMENSEIGNANT like '%$mc%')
								And ARR.DATEARRIVEE=$idf
								ORDER BY ARR.HEUREARRIVEE
								LIMIT $size
								OFFSET $offset");

		$resultat2 = $con->query("select count(*) as nbrARRIV 
								from ARRIVEE 
								where (MATRICULEENSEIGNANT like '%$mc%')
								And DATEARRIVEE=$idf");
	}
	
	
	$nbr=$resultat2->fetch();
	
	$nbrPro=$nbr['nbrARRIV'];
	
	$reste=$nbrPro % $size; //l'operateur % (modulo) retourne le reste de la 
						// devision euclidienne de $nbrPro sur $size
	if($reste==0)
		$nbrPage=$nbrPro/$size;
	else
		$nbrPage=floor($nbrPro/$size)+1;// floor retourne la partie entière d'un nombre 
										// decimale
										
	$requetef="select * from ENSEIGNANT";
	$resultatf = $con->query($requetef);
										
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Page Gestion Présences</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
	</head>
	<body background="Img08.JPG">
		 <div id="wrapper">
			<?php include('entete.php');?>
			
			<div class="container">
				<div class="panel panel-success espace60">
					<div class="panel-heading">Rechercher des Présences Quotidiennnes</div>
					<div class="panel-body">
						<form method="get" action="ListingPresence.php" class="form-inline">
						<div class="form-group">						
								<select name="MATRICULEENSEIGNANT" id="MATRICULEENSEIGNANT" class="form-control"
									onChange="this.form.submit();">
									<option value="0" >Choix de L'Enseignant</option>
									<?php while($filiere=$resultatf->fetch()){ ?>
										<option value="<?php echo $filiere['MATRICULEENSEIGNANT']?>" 
											<?php echo $idf==$filiere['MATRICULEENSEIGNANT']?"selected":"" ?>>
											<?php echo $filiere['NOMENSEIGNANT']?>
										</option>									
									<?php } ?>
								</select>
								
								<input type="date" name="motCle" 
										placeholder="Indiquer Une Date Pour Filtrer"
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
									<a class="btn btn-success" href="NouvellePresence.php">Nouvelle Présence</a>
								<?php } ?>	
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
					
					Liste des Présences (<?php echo $nbrPro ?>&nbspPrésence(s)) 
					
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>GENRE</th>
									<th>ENSEIGNANT</th>
									<th>DATE CONCERNEE</th>
									<th>HEURE ARRIVEE</th>
									 <?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?> 
										<th>ACTIONS</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php while($STAGIAIRE=$resultat->fetch()){?>
									<tr>
										<td><?php echo $STAGIAIRE['IDARRIVEE'] ?></td>
										<td><?php echo $STAGIAIRE['GENREENSEIGNANT'] ?></td>
										<td><?php echo $STAGIAIRE['NOMENSEIGNANT'] ?></td>
										<td><?php echo $STAGIAIRE['DATEARRIVEE'] ?></td>	
										<td><?php echo $STAGIAIRE['HEUREARRIVEE'] ?></td>		
										<td>
											<?php if($_SESSION['utilisateur']['ROLE']=="ADMIN") {?>
												<!--  Action Editer un stagiaire -->
												<a href="EditerPresence.php?IDARRIVEE=<?php echo $STAGIAIRE['IDARRIVEE'] ?>">
													<span class="glyphicon glyphicon-pencil"></span>
												</a>
												
												&nbsp &nbsp
												<!--  Action Supprimer un stagiaire -->
												<a Onclick="return confirm('VOULEZ - VOUS VRAIMENT SUPPRIMER CETTE ARRIVEE ?')" 
													href="SupprimerPresence.php?IDARRIVEE=<?php echo $STAGIAIRE['IDARRIVEE'] ?>">
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
											<input type="hidden" name="MATRICULEENSEIGNANT" 
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
											<a href="Inscriptions.php?page=<?php echo $i ?>
											&motCle=<?php echo $mc ?>
											&MATRICULEENSEIGNANT=<?php echo $idf ?>
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